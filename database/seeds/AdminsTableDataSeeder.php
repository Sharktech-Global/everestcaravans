<?php

use Illuminate\Database\Seeder;


class AdminsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'developer@netventure.in',
            'password' => bcrypt('developer@netventure.in'),
            'active' => '1',
        ]);
    }
}
