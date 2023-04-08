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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->softDeletes();

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('text')->nullable();
            $table->string('hash');
            $table->foreign('created_user_id')->references('id')->on('users');

            $table->json('options')->nullable();

            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
};
