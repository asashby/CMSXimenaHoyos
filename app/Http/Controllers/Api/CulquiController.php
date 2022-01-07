<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;

class CulquiController extends Controller
{
    public function createCharge(Request $request)
    {
        try {
            $data = $request->all();
            $client = new Client(['base_uri' => env('CULQUI_API_URL')]);
            $options = [
                'headers' => [
                    'authorization' => 'Bearer ' . env('API_KEY_CULQUI'),
                    'Content-Type' => 'application/json'
                ],
                'json' => $data,
            ];
            $response = $client->request('POST', 'charges', $options);
            return $response->getBody()->getContents();
        } catch (BadResponseException $e) {
            return $e->getResponse();
        }
    }
}
