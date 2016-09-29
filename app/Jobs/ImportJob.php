<?php

namespace App\Jobs;

use App\Models\User;


class ImportJob extends Job
{
    private $chunk;

    /**
     * Create a new ImportJob instance.
     * This job pushed to the queue by background worker.
     * In case of failure, worker will retry this job 3 times.
     *
     * @return void
     */
    public function __construct($chunk)
    {
        $this->chunk = $chunk;
    }

    /**
     * Create User in DB.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->chunk as $user) {
            User::create(array(
                'user_id' => $user[0],
                'name' => $user[1],
                'age' => $user[2],
                'address' => $user[3] . ', ' . $user[4],
                'team' => $user[5]
            ));
        }
    }
}
