<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->string('name', 150);
            $table->string('email', 190)->unique();
            $table->string('password_hash', 255)->nullable();
            $table->enum('role', ['super_admin', 'admin', 'member'])->default('member');
            $table->enum('status', ['invited', 'active'])->default('invited');
            $table->char('invite_token', 64)->nullable()->unique();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->index('client_id', 'idx_users_client');
            $table->foreign('client_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
