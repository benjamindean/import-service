<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            array(
                'name' => 'User 1',
                'age' => 20,
                'address' => 'Some St.',
                'team' => 'Team 1'
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'User 2',
                'age' => 20,
                'address' => 'Some St.',
                'team' => 'Team 2'
            )
        );
    }
}
