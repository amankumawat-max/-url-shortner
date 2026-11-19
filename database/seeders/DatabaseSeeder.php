<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Database\Seeders\CsThemeAdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insertOrIgnore([
            'id' => 1,
            'client_id' => null,
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password_hash' => Hash::make('password'),
            'role' => 'super_admin',
            'status' => 'active',
            'invite_token' => null,
            'created_at' => now(),
        ]);

        DB::table('users')->insertOrIgnore([
            'id' => 2,
            'client_id' => null,
            'name' => 'Sembark Tech',
            'email' => 'sembark@example.com',
            'password_hash' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'invite_token' => null,
            'created_at' => now(),
        ]);

        DB::table('users')->insertOrIgnore([
            'id' => 3,
            'client_id' => 2,
            'name' => 'User 2',
            'email' => 'user2@example.com',
            'password_hash' => Hash::make('password'),
            'role' => 'member',
            'status' => 'active',
            'invite_token' => null,
            'created_at' => now(),
        ]);

        DB::table('short_urls')->insertOrIgnore([
            'user_id' => 2,
            'short_code' => '1j7hsjs',
            'long_url' => 'https://google.com/',
            'hits' => 0,
            'created_at' => '2025-01-07 00:00:00',
        ]);

        DB::table('short_urls')->insertOrIgnore([
            'user_id' => 3,
            'short_code' => '12123',
            'long_url' => 'https://sembark.com/',
            'hits' => 100,
            'created_at' => '2025-01-01 00:00:00',
        ]);

        $this->call(CsThemeAdminSeeder::class);
    }
}
