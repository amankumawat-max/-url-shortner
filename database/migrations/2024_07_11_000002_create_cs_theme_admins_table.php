<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cs_theme_admins', function (Blueprint $table) {
            $table->id();
            $table->string('admin_name', 200)->nullable();
            $table->string('admin_lastname', 200)->nullable();
            $table->string('admin_email', 200)->nullable();
            $table->string('admin_mobile', 15)->nullable();
            $table->tinyInteger('admin_status')->default(0);
            $table->text('admin_password')->nullable();
            $table->string('site_title', 255)->nullable();
            $table->text('site_address')->nullable();
            $table->text('site_other_address')->nullable();
            $table->string('administration_email', 255)->nullable();
            $table->text('facebook_url')->nullable();
            $table->text('instagram_url')->nullable();
            $table->text('twitter_url')->nullable();
            $table->text('youtube_url')->nullable();
            $table->text('linkedin_url')->nullable();
            $table->text('address')->nullable();
            $table->string('office_address', 255)->nullable();
            $table->string('address_2', 255)->nullable();
            $table->string('city', 250)->nullable();
            $table->string('state', 250)->nullable();
            $table->string('postcode', 250)->nullable();
            $table->string('admin_hours', 255)->nullable();
            $table->text('favicon')->nullable();
            $table->text('logo')->nullable();
            $table->text('white_logo')->nullable();
            $table->string('admin_support_email', 200)->nullable();
            $table->string('admin_support_mobile', 100)->nullable();
            $table->text('admin_playstore_user')->nullable();
            $table->text('admin_appstore_user')->nullable();
            $table->text('admin_header_script')->nullable();
            $table->text('admin_footer_script')->nullable();
            $table->string('admin_refer_message', 200)->nullable();
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cs_theme_admins');
    }
};
