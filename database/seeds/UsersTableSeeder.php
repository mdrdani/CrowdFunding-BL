<?php

use App\Role;
use Carbon\Carbon;
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
        DB::table('users')->insert([
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => \Hash::make("secret123"),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'role_id' => Role::all()->random()->id,
        ]);

        DB::table('users')->insert([
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => \Hash::make("secret123"),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'role_id' => Role::all()->random()->id,
        ]);
    }
}