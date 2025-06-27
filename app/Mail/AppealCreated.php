<?php

namespace App\Mail;

use App\Models\Appeal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class AppealCreated extends Mailable
{
    use Queueable, SerializesModels;

    public Appeal $appeal;
    public $attachments;

    public function __construct(Appeal $appeal, array $attachments = [])
    {
        $this->appeal     = $appeal;
        $this->attachments = $attachments;
    }

    public function build()
    {
        $mail = $this
            ->subject("Ваше обращение №{$this->appeal->id} принято")
            ->view('emails.appeal-created', ['appeal' => $this->appeal]);

        foreach ($this->attachments as $file) {
            $mail->attach(
                Storage::disk('public')->path($file['path']),
                ['as' => $file['name'], 'mime' => $file['mime']]
            );
        }

        return $mail;
    }
}
