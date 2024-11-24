<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaborationsTable extends Migration
{
    public function up()
    {
        Schema::create('collaborations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('invitation_id')->nullable()->constrained('invitations')->onDelete('set null');
            $table->enum('role', ['Editor', 'Viewer']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('collaborations');
    }
}
