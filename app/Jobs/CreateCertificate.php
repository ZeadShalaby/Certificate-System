<?php

namespace App\Jobs;


use App\Models\Certificate;
use App\Mail\CertificateMail;
use Illuminate\Bus\Queueable;
use App\Traits\CertficateTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateCertificate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, CertficateTrait;

    protected $CertificateData;

    /**
     * Create a new job instance.
     *
     * @param array $CertificateData
     */
    public function __construct(array $CertificateData)
    {
        $this->CertificateData = $CertificateData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Certificate::create($this->CertificateData);

    }
}




