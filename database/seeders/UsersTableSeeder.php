<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Ivaylo',
            'last_name' => 'Sholekov',

            'email' => 'sholeka@gmail.com',
            'phone' => '0878871458',
            
            'city' => 'Ruse',
            'region' => 'Ruse',
            'postal_code' => '7000',
            'address' => '',
            
            'password' => bcrypt('786478'),
            'created_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Ivaylo C',
            'last_name' => 'Sholekov C',

            'email' => 'sholekov@yahoo.com',
            'phone' => '0878871458',
            
            'city' => 'Ruse',
            'region' => 'Ruse',
            'postal_code' => '7000',
            'address' => '',
            
            'password' => bcrypt('qwerty'),
            'created_at' => Carbon::now(),
        ]);


        DB::table('users')->insert([
            'first_name' => 'Rumi',
            'last_name' => 'Rumi',
            
            'email' => 'rumibbc@gmail.com',
            'phone' => '0878871458',
            
            'city' => 'Ruse',
            'region' => 'Ruse',
            'postal_code' => '7000',
            'address' => '',
            
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'first_name' => 'Nely',
            'last_name' => 'Nely',
            
            'email' => 'nelysholekova@gmail.com',
            'phone' => '0878871458',
            
            'city' => 'Ruse',
            'region' => 'Ruse',
            'postal_code' => '7000',
            'address' => '',
            
            'password' => bcrypt('nelysholek'),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'first_name' => 'Krasi',
            'last_name' => 'Krasi',
            
            'email' => 'kras9703@gmail.com',
            'phone' => '0877421007',
            
            'city' => 'Ruse',
            'region' => 'Ruse',
            'postal_code' => '7000',
            'address' => '',
            
            'password' => bcrypt('krasTF-2395'),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'first_name' => 'Ivelin',
            'last_name' => 'Ivelin',
            
            'email' => 'i.belchev@gmail.com',
            'phone' => '',
            
            'city' => 'Ruse',
            'region' => 'Ruse',
            'postal_code' => '7000',
            'address' => '',
            
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'first_name' => 'Poly',
            'last_name' => 'Poly',
            
            'email' => 'p.belcheva@gmail.com',
            'phone' => '',
            
            'city' => 'Ruse',
            'region' => 'Ruse',
            'postal_code' => '7000',
            'address' => '',
            
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
        ]);
    }
}
