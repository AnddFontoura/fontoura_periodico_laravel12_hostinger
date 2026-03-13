<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('releases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('publication_id')->nullable();
            $table->string('name', 200);
            $table->text('description')->nullable(true);
            $table->text('image')->nullable(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('publication_id')
                ->references('id')
                ->on('publications')
                ->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
