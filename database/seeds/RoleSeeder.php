<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'id' => Str::uuid(),
            'role_name' => 'Admin'
        ]);

        DB::table('roles')->insert([
            [
            'id' => Str::uuid(),
            'role_name' => 'User',
        ]
        ]);
    }
}