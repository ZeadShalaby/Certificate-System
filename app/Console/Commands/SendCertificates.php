<?php

namespace App\Console\Commands;

use App\Traits\CertficateTrait;
use Illuminate\Console\Command;

class SendCertificates extends Command
{
    use CertficateTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-certificates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Certificate to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->generateQrCode();
    }
}
