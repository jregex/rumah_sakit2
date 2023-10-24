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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama',256)->default('Smart 99 Solution');
            $table->string('email',256)->unique()->default('sanmawa99@gmail.com');
            $table->string('long',256)->nullable();
            $table->string('lat',256)->nullable();
            $table->text('alamat')->nullable();
            $table->text('desc')->nullable();
            $table->string('profile',256)->default('default.webp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
