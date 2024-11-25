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
            $table->string('role', 45);
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('workspaces_id')->constrained('workspaces')->onDelete('cascade');
            $table->foreignId('invitations_id')->nullable()->constrained('invitations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('collaborations');
    }
}
