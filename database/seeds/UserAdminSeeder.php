<?php

use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      =>  'Administrador',
            'phone'     =>  3273412528,
            'cedula'    =>  3223412548,
            'fecha_nac' =>  '1991/03/19',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('Pass1234.'),
        ]);
    }
}
