<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CsThemeAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cs_theme_admins')->insertOrIgnore([
            'id' => 1,
            'admin_name' => 'URL SHORTNER',
            'admin_lastname' => null,
            'admin_email' => 'info@admin.com',
            'admin_mobile' => '+91 9999999999',
            'admin_status' => 0,
            'admin_password' => '$2y$12$cZtCE98wKTSkUaoSJMaSBO5xKfwePq97s6i3Ezv7VbuuQsq79gTlm',
            'site_title' => 'URL SHORTNER',
            'site_address' => 'info@admin.com',
            'site_other_address' => '#',
            'administration_email' => 'info@admin.com',
            'facebook_url' => '#',
            'instagram_url' => '#',
            'twitter_url' => '#',
            'youtube_url' => '#',
            'linkedin_url' => '#',
            'address' => null,
            'office_address' => null,
            'address_2' => null,
            'city' => null,
            'state' => null,
            'postcode' => null,
            'admin_hours' => null,
            'favicon' => '1795021289.png',
            'logo' => '1795020595.png', 
            'white_logo' => '1795020595.png',
            'admin_support_email' => 'info@admin.com',
            'admin_support_mobile' => '9999999999',
            'admin_playstore_user' => null,
            'admin_appstore_user' => null,
            'admin_header_script' => '',
            'admin_footer_script' => 'test',
            'admin_refer_message' => null,
            'created_at' => '2022-04-14 09:00:23',
            'updated_at' => '2024-03-27 15:36:18',
        ]);
    }
}
