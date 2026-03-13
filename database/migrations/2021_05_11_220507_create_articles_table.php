<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('release_id')->nullable();
            $table->string('name',1000);
            $table->string('path',1000)->nullable(true);
            $table->text('authors')->nullable(true);
            $table->text('resume')->nullable(true);
            $table->text('abstract')->nullable(true);
            $table->integer('pages')->default(0);
            $table->text('keywords')->nullable(true);
            $table->text('image')->nullable(true);
            $table->bigInteger('access_count')->default(0);
            $table->bigInteger('download_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('release_id')
                ->references('id')
                ->on('releases')
                ->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
