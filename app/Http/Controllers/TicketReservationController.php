<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketReservation;
use PDF;

class TicketReservationController extends Controller{


public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'categories' => 'required|array',
        'categories.*' => 'integer|min:0',
    ]);

    $ticketData = [];
    $totalPrice = 0;

    foreach ($data['categories'] as $category => $quantity) {
        if ($quantity > 0) {
            $ticketPrice = 0;

            switch ($category) {
                case 'baby':
                    // Baby (0 - 11 months) - Free
                    $ticketPrice = 0;
                    break;
                case 'child':
                    // Child (1 - 10 years) - $40
                    $ticketPrice = 40000;
                    break;
                case 'teen':
                    // Teen (11 - 19 years) - $50
                    $ticketPrice = 50000;
                    break;
                case 'adult':
                    // Adult (20+ years) - $60
                    $ticketPrice = 60000;
                    break;
            }

            $totalPrice += $ticketPrice * $quantity;

            $ticketData[] = [
                'category' => $category,
                'quantity' => $quantity,
                'price' => $ticketPrice,
            ];
        }
    }

    $reservation = TicketReservation::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'total_price' => $totalPrice,
        'ticket_data' => json_encode($ticketData),
    ]);

    // Generate PDF ticket
    $pdf = PDF::loadView('ticket', compact('reservation'));
    $pdf->setPaper('a4', 'landscape');

    // Download the PDF file
    return $pdf->download('ticket.pdf');
    }

}