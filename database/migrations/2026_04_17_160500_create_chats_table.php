<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id('id_chat');
            $table->string('session_id');
            $table->text('message');
            $table->enum('sender', ['user', 'admin']);
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->index('session_id');
            $table->index(['sender', 'is_read']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
};
