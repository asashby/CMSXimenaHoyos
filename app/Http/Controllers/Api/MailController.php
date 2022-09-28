<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ClientContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function clientContact(Request $request)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'email',
            ],
            'message' => [
                'required',
            ],
        ]);
        $mailResult = Mail::to(config('custom.contact_email'))
            ->send((new ClientContactMail($validatedData))
                ->subject("Consulta de {$validatedData['name']}"));
        return response()->json([
            'status' => 200,
            'message' => 'Correo enviado',
        ], 200);
    }

    public function clientConsultation(Request $request)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
            ],
            'last_name' => [
                'required',
                'string',
            ],
            'phone' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
            ],
            'consultation_date' => [
                'required',
                'date'
            ],
        ]);
        $mailResult = Mail::to(config('custom.contact_email'))
            ->send((new ClientContactMail($validatedData))
                ->subject("Reseva de consulta nutricional de {$validatedData['name']} {$validatedData['last_name']}"));
        return response()->json([
            'status' => 200,
            'message' => 'Correo enviado',
        ], 200);
    }
}
