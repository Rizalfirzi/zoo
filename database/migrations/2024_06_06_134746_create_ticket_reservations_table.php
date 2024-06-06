<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('ticket_reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('total_price');
            $table->text('ticket_data');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket_reservations');
    }
}


