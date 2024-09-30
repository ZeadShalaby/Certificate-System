<?php

namespace App\Traits;


use App\Models\Certificate;
use App\Traits\QrCodeTrait;
use App\Mail\CertificateMail;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Notifications\SuccessNotification;
use Illuminate\Support\Facades\Notification;

trait CertficateTrait
{
    use QrCodeTrait;
    // ?todo create certficate
    public function ContentCertficate($qrCode, $certificate)
    {
        $path = public_path('images/LusailUN.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $universityName = 'Lusail University';
        $studentName = $certificate->name;
        $certificateId = $certificate->id;
        $acdemic_number = $certificate->acdemic_number;
        $links = env('BASE_URL');
        $courseName = 'Bachelor of Science in' . $certificate->courses;
        $completionDate = \Carbon\Carbon::parse($certificate->end_at)->format('F j, Y');

        // ?todo Prepare the PDF content with enhanced design
        // ?todoPass data to the view
        $pdfContent = View::make('certificates.certificate', compact('qrCode', 'universityName', 'studentName', 'courseName', 'completionDate', 'logo', 'acdemic_number', 'links', 'certificateId'))->render();
        return $pdfContent;
    }


    // ?todo create pdf & return dompdf
    public function CreateDemo($data, $certificate)
    {
        $writer = new PngWriter();
        $qrCode = $this->createQrCode($data);
        $logo = $this->createLogo();
        $result = $writer->write($qrCode, $logo);

        //?todo Convert the QR code to base64
        $qrCodeBase64 = 'data:' . $result->getMimeType() . ';base64,' . base64_encode($result->getString());
        $pdfContent = $this->ContentCertficate($qrCodeBase64, $certificate);
        $dompdf = $this->CreateDemoPDF($pdfContent);
        return $dompdf;
    }

    // ! generate QrCode and send it via gmail
    public function generateQrCode()
    {
        $certificates = Certificate::get();
        foreach ($certificates as $certificate) {
            if ($certificate->send_at == null) {
                //?todo Generate the QR code
                $data = env('BASE_URL') . route('certificate.show', $certificate->id, false);
                $dompdf = $this->CreateDemo($data, $certificate);
                $pdfOutput = $dompdf->output(); //? Get the generated PDF content as a string
                // ?todo Send the PDF via email
                Mail::to($certificate->gmail)->send(new CertificateMail($pdfOutput));
                $certificate->send();
            }
        }
    }

    //?todo create successful notification
    public function successNotification($msg)
    {
        return Notification::send(auth()->user(), new SuccessNotification($msg));
    }


}





