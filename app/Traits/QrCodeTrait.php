<?php

namespace App\Traits;

use App\Models\Role;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Dompdf\Dompdf;
use Dompdf\Options;
trait QrCodeTrait
{

    // ?todo create qrcode
    public function createQrCode($data)
    {
        //? create QR code
        $qrCode = QrCode::create($data)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        return $qrCode;
    }



    // ?todo add logo to image 
    public function createLogo()
    {
        //? create logo
        $logoPath = public_path('LusailUN.png');
        if (!file_exists($logoPath)) {
            throw new \Exception("Logo image not found at: " . $logoPath);
        }
        $logo = Logo::create($logoPath)
            ->setResizeToWidth(50)
            ->setPunchoutBackground(true);

        return $logo;
    }

    // ?todo create pdf
    public function CreateDemoPDF($pdfContent)
    {
        //? Initialize dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true); // Enable if you want to use external images or resources
        $dompdf = new Dompdf($options);

        //? Load HTML content into dompdf
        $dompdf->loadHtml($pdfContent);
        //? (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        //? Render the PDF
        $dompdf->render();

        return $dompdf;
    }


}





