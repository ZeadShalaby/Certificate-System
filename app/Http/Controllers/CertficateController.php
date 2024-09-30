<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Traits\QrCodeTrait;
use App\Traits\CertficateTrait;
use App\Http\Controllers\Controller;



class CertficateController extends Controller
{
    use QrCodeTrait, CertficateTrait;

    // ?todo return content of certficate by groupid
    public function index($groupId)
    {
        $certficate = Certificate::where('group_id', $groupId)->get();
        return $certficate;
    }


    // ! show info user QrCode
    public function show(Certificate $certificate)
    {
        $data = env('BASE_URL') . route('certificate.show', $certificate->id, false);
        $dompdf = $this->CreateDemo($data, $certificate);
        //?todo Output the PDF as a download
        return $dompdf->stream('qrcode.pdf', ['Attachment' => 0]); // Attachment = 0 to view in the browser, 1 to download
    }



    // ?todo  delete user certficate
    public function destroy(Certificate $certficate)
    {
        try {
            $certficate->delete();
            return back()->with('status', "Remove User Successfully...");
        } catch (\Exception $e) {

        }
    }





    // public function generateQrCode($userId)
    // {
    //     $data = env('BASE_URL') . route('user.show', $userId, false);

    //     $writer = new PngWriter();
    //     $qrCode = $this->createQrCode($data);
    //     $logo = $this->createLogo();

    //     // ?todo result QR code
    //     $result = $writer->write($qrCode, $logo);

    //     //?todo return response QR code 
    //     return response($result->getString())
    //         ->header('Content-Type', $result->getMimeType())
    //         ->header('Content-Disposition', 'inline; filename="qrcode.png"');

    // }
}
