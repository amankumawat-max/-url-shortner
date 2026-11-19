<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('url_hits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('short_url_id')->unsigned();
            $table->datetime('hit_at')->useCurrent();
            $table->index(['short_url_id', 'hit_at'], 'idx_url_time');
            $table->foreign('short_url_id')->references('id')->on('short_urls');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('url_hits');
    }
};
