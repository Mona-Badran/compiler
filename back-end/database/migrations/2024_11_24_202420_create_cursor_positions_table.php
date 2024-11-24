<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursorPositionsTable extends Migration
{
    public function up()
    {
        Schema::create('cursor_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('line');
            $table->integer('column');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cursor_positions');
    }
}
