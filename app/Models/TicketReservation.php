<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketReservation extends Model
{
    protected $fillable = ['name', 'email', 'total_price', 'ticket_data'];
}


