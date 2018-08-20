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
        if (
            !DB::table('users')->where('email', 'ben@example.com')->first() and
            !DB::table('users')->where('email', 'admin@example.com')->first()
        
        ) {
            DB::table('users')->insert([
                'name' => 'el duderino',
                'email' => 'dude@example.com',
                'password' => app('hash')->make('secret'),
            ]);

            DB::table('users')->insert([
                'name' => 'administrator',
                'email' => 'admin@example.com',
                'password' => app('hash')->make('password'),
            ]);
          }
    }
}
