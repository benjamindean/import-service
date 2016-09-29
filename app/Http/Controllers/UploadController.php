<?php

namespace App\Http\Controllers;

use App\Jobs\ImportJob;
use App\Jobs\MailJob;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;


class UploadController extends Controller
{
    private $rowCount;
    private $timeStart;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->rowCount = 0;
        $this->timeStart = microtime(true);
    }

    public function store(Request $request)
    {
        // Validating Email and File inputs
        $this->validate($request, [
            'csv_file' => 'required|mimes:text/csv,csv,txt',
            'email' => 'required|email'
        ]);

        //Checking if file is actually there
        if ($request->hasFile('csv_file')) {
            $this->parse(
                $request->file('csv_file'),
                $request->get('email'),
                $request->file('csv_file')->getClientOriginalName()
            );
        }

        return array('success' => true);
    }


    /**
     * Overriding formatValidationErrors to wrap them
     * into 'errors" array and add actual 'success' status
     *
     * @param Validator $validator
     * @return array
     */
    protected function formatValidationErrors(Validator $validator)
    {
        return array(
            'errors' => array(
                $validator->errors()->getMessages()
            ),
            'success' => false
        );
    }


    /**
     * Parsing imported CSV
     *
     * @param $csvFile
     * @param $email
     * @param string $fileName
     */
    public function parse($csvFile, $email, $fileName = 'csv')
    {
        $rows = array_map('str_getcsv', file($csvFile, FILE_SKIP_EMPTY_LINES));
        $this->rowCount = count($rows);

        /**
         * Divide data into equal chunks of 500 elements.
         * If there is less than 500 elements - we can do it anyway.
         */
        $chucked = array_chunk($rows, 500);
        foreach ($chucked as $chunk) {
            // Dispatching ImportJob to avoid memory issues
            $this->dispatch(new ImportJob($chunk));
        }

        // Sending email from the MailJob pushed to the end of queue
        $this->dispatch(new MailJob(
            $email,
            $fileName,
            $this->timeStart,
            $this->rowCount
        ));
    }
}
