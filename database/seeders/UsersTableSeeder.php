<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use DB;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        User::factory()->count(1)->create([
            'name' => 'Lucas Lima',
            'email' => 'admin@user.com',
            'password' => Hash::make('secret')
        ]);
        User::factory()->count(20)->create();
    }
}
