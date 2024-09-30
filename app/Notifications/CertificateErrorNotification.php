<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CertificateErrorNotification extends Notification
{
    use Queueable;

    protected $errorMessage;
    protected $name;
    protected $academicNum;

    public function __construct($errorMessage, $name, $academicNum)
    {
        $this->errorMessage = $errorMessage;
        $this->name = $name;
        $this->academicNum = $academicNum;
    }

    public function via($notifiable)
    {
        return ['database']; //? Change to the appropriate channels (like 'slack') | mail if needed  'mail'
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Certificate Creation Error')
            ->line('An error occurred while creating a certificate.')
            ->line('Error Message: ' . $this->errorMessage)
            ->line('Name: ' . $this->name)
            ->line('Academic Number: ' . $this->academicNum)
            ->action('View Error', url('/')); // Change the URL as needed
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'An error occurred while creating a certificate for ' . $this->name . ' Academic Number: ' . $this->academicNum,
            'academic_number' => $this->academicNum,
            'error' => $this->errorMessage,
        ];
    }
}
