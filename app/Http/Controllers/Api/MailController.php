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
            'email' => [
                'required',
                'email',
            ],
            'name' => [
                'required',
                'string',
            ],
            'message' => [
                'required',
            ],
        ]);
        $mailResult = Mail::to('ximenaconsultas@gmail.com')
            ->send(new ClientContactMail($validatedData));
        return response()->json([
            'status' => 200,
            'message' => 'Correo enviado',
        ], 200);
    }
}
