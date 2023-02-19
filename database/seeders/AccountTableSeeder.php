<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create([
            'id'=>0,
            'user_id' => 0,
             'user_type' => 'App\Models\User',
            'status' =>'approved',
            'balance' =>0 ,
        ]);
    }
}
