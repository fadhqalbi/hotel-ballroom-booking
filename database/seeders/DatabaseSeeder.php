<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function(){
            $user = User::create([
                'nama_user' => 'user1',
                'email' => 'user1@citygarden.com',
                'password' => Hash::make('user1'),
                'hp' => '012345678910'
            ]);
            // $customer = Customer::create([
            //     'no_customer' => 'C0001',
            //     'nama_customer' => 'Customer Satu',
            //     'alamat' => 'Ketintang',
            //     'kota' => 'Surabaya',
            //     'email' => 'cust1@citygarden.com',
            //     'hp' => '014785236963'
            // ]);
        });
    }
}
