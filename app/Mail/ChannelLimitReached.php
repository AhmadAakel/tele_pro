<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ChannelSetting;

class ChannelLimitReached extends Mailable
{
    use Queueable, SerializesModels;

    public $activeChannel;

    public function __construct($activeChannel)
    {
        $this->activeChannel = $activeChannel;
    }

    public function build()
    {
        return $this->subject('Channel Limit Reached')->view('emails.limit');
    }
}