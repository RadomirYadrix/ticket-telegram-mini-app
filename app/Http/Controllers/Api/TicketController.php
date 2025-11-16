<?php

namespace App\Http\Controllers\Api;

use App\Models\Ticket;
use App\Models\Transport;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TicketController
{
    public function create(Request $request): JsonResponse
    {
        $user = $request->attributes->get('telegram_user');
        $transport = Transport::findOrFail($request->transport_id);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'transport_id' => $transport->id,
            'status' => 'pending',
        ]);

        $paymentService = new \App\Services\PaymentService();
        $payment = $paymentService->createPayment($ticket->id, $transport->price);

        $ticket->payment_id = $payment['id'];
        $ticket->save();

        return response()->json([
            'ticket_id' => $ticket->id,
            'payment_url' => $payment['confirmation']['confirmation_url'],
        ]);
    }
}
