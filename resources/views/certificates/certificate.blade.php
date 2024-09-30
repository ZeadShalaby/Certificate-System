<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <link rel="stylesheet" href="{{ asset('css/certificates.css') }}">
</head>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .certificate-container {
            margin-left: -40px;
            width: 100%;
            padding: 40px;
            background: none;
        }

        .outer-border {
            border: 10px solid #003366;
            padding: 20px;
            border-radius: 15px;
        }

        .inner-border {
            border: 5px solid #ffcc00;
            padding: 20px;
            border-radius: 10px;
        }

        .university-logo {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .university-name {
            color: #003366;
            font-size: 40px;
            margin-bottom: 10px;
        }

        .certificate-title {
            color: #ffcc00;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .student-info {
            font-size: 20px;
            color: #333;
            margin-bottom: 40px;
        }

        .student-name,
        .course-name,
        .completion-date {
            font-weight: bold;
            color: #003366;
        }

        .student-name {
            font-size: 26px;
        }

        .course-name,
        .completion-date {
            font-size: 22px;
        }

        .qr-code {
            max-width: 150px;
            margin-top: 20px;
        }

        .signature {
            margin-top: 40px;
            color: #333;
            font-size: 16px;
        }

        .signature-line {
            display: inline-block;
            width: 200px;
            height: 1px;
            background-color: #003366;
            margin: 20px 0;
        }
    </style>
    <div class="certificate-container">
        <div class="outer-border">
            <div class="inner-border">
                <img src="{{ $logo }}" alt="Lusail University Logo" class="university-logo">
                <h1 class="university-name">{{ $universityName }}</h1>
                <h2 class="certificate-title">Certificate of Completion</h2>
                <p class="student-info">This is to certify that<br><span
                        class="student-name">{{ $studentName }}</span><br>
                    <span class="student-name">{{ $acdemic_number }}</span>
                    <br>has successfully completed the
                    course<br><span class="course-name">{{ $courseName }}</span><br>on <span
                        class="completion-date">{{ $completionDate }}</span>
                </p>
                <p class="student-info"><img src="{{ $qrCode }}" alt="QR Code" class="qr-code"><br>Scan this QR
                    code to verify the certificate. or click <a
                        href="{{ $links . '/certificate/' . $certificateId }}"target="_blank">View Certificate</a>
                </p>
                <p class="signature"><strong>Authorized Signature</strong><br><span class="signature-line"></span></p>
            </div>
        </div>
    </div>
</body>

</html>
