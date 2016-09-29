<?php

namespace App\Jobs;

use App\Mail\ImportMail;

/**
 * Class MailJob
 * @package App\Jobs
 */
class MailJob extends Job
{
    private $email;
    private $fileName;
    private $timeStart;
    private $rowCount;

    /**
     * MailJob constructor.
     * @param $email
     * @param $fileName
     * @param $timeStart
     * @param $rowCount
     */
    public function __construct($email, $fileName, $timeStart, $rowCount)
    {
        $this->email = $email;
        $this->fileName = $fileName;
        $this->timeStart = $timeStart;
        $this->rowCount = $rowCount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mailer = app('mailer');
        $mailer->to($this->email)->send(new ImportMail(
            "Your import of $this->fileName file is finished",
            gmdate("H:i:s", round((microtime(true) - $this->timeStart), 3)),
            $this->rowCount
        ));
    }
}
