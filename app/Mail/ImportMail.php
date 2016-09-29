<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ImportMail.
 * Mailable model foe email view.
 * @package App\Mail
 */
class ImportMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $subject;
    protected $time;
    protected $rowCount;

    /**
     * ImportMail constructor.
     * @param $subject
     * @param $time
     * @param $rowsCount
     */
    public function __construct($subject, $time, $rowsCount)
    {
        $this->subject = $subject;
        $this->time = $time;
        $this->rowCount = $rowsCount;
    }


    /**
     * Pass data to the email view.
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.import')
            ->subject($this->subject)
            ->with('title', $this->subject)
            ->with('time', $this->time)
            ->with('rows', $this->rowCount);
    }
}