<?php

namespace App\Http\Controllers;

use Shuchkin\SimpleXLSX;
use App\Models\Certificate;
use App\Jobs\SendCertificate;
use App\Jobs\CreateCertificate;
use App\Traits\CertficateTrait;
use App\Http\Requests\RequestExcel;
use Illuminate\Support\Facades\Bus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CertificateErrorNotification;

class ExcelController extends Controller
{
    use CertficateTrait;


    //?todo Check for missing fields
    private function hasMissingFields($row)
    {
        return empty($row[2]) || empty($row[4]);
    }

    //?todo Check for duplicate entry
    private function isDuplicateEntry($email)
    {
        return Certificate::where('gmail', $email)->exists() || empty($email);
    }

    //?todo Prepare certificate data
    private function prepareCertificateData($row)
    {
        return [
            'courses' => $row[0],
            'groups' => $row[1],
            'name' => $row[2],
            'gmail' => $row[3],
            'acdemic_number' => $row[4],
            'title' => $row[5],
            'start_at' => $row[6],
            'end_at' => $row[7],
            'send_at' => null,
        ];
    }

    //?todo Notify user about errors
    private function notifyUser($message, $row)
    {
        Notification::send(auth()->user(), new CertificateErrorNotification(
            $message,
            $row[2] ?? 'N/A',
            $row[4] ?? 'N/A'
        ));
    }

    //?todo Show view with upload form
    public function index()
    {
        return view('Excel.index');
    }

    //?todo Upload Excel and call function to send certificates
    public function uploadExcel(RequestExcel $request)
    {
        try {
            $filePath = $request->file('file')->getRealPath();
            $xlsx = SimpleXLSX::parse($filePath);
            $data = $xlsx->rows();
            array_shift($data); //? Remove header row
            $this->createCertificates($data);
            return back()->with('status', 'File uploaded successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error parsing the Excel file: ' . $e->getMessage());
        }
    }

    //?todo Create certificates and send notification on error
    public function createCertificates($data)
    {
        $count = 0;
        foreach ($data as $index => $row) {
            //? Validate required fields
            if ($this->hasMissingFields($row)) {
                $this->notifyUser('Missing required fields.', $row);
                continue;
            }

            //? Validate Duplicate gmail or academic_number
            if ($this->isDuplicateEntry($row[3]) || Certificate::where('acdemic_number', $row[4])->exists()) {
                $this->notifyUser('Duplicate entry for email: ' . $row[3] . ' or academic number: ' . $row[4], $row);
                continue;
            }

            try {
                Bus::chain([
                    new CreateCertificate($this->prepareCertificateData($row))
                ])->delay(now()->addSeconds($index * 2))->dispatch();
                $count++;
            } catch (\Exception $e) {
                $this->notifyUser($e->getMessage(), $row);
                continue;
            }
        }
        //? return success notification
        $this->successNotification('All certificates created & send successfully.');

    }


}
























