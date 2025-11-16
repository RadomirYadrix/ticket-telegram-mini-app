<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['train', 'bus', 'river']);
            $table->string('name');
            $table->string('route');
            $table->string('from_location');
            $table->string('to_location');
            $table->dateTime('departure_at');
            $table->dateTime('arrival_at');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transports');
    }
};
