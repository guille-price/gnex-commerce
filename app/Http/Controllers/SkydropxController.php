<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class SkydropxController extends Controller
{
    protected $token;

    public function __construct()
    {
        $this->token = config('services.skydropx.token');
    }

    public function carriers(){
        $token = $this->token;

        
        //$response = Http::withToken($token)->get('https://api-demo.skydropx.com/v1/carriers');

        //$response = Http::withToken($token)->get('https://api.skydropx.com/v1/carriers');
        
        $response = Http::withToken($token)->withHeaders([
            'Content-Type: application/json'
        ])->get('https://api-demo.skydropx.com/v1/carriers');

        $carriers = json_decode($response, true);

        dd($carriers);

        //$carriers = $response['data'];
        
    }

    public function quote(){
        $token = $this->token;

        $body = [
            "zip_from" => "31120",
            "zip_to" => "07300",
            "parcel" => [
                "weight" => "1",
                "height" => "15",
                "width" => "15",
                "length" => "15"
            ],
            "carriers" => [
                [ "name" => "Fedex" ], 
                [ "name" => "Estafeta" ], 
                [ "name" => "Redpack" ], 
                [ "name" => "UPS" ],
                [ "name" => "Paquetexpress" ],
                [ "name" => "DHL" ]
            ]
        ];

        $response = Http::withToken($token)->withHeaders([
            'Content-Type: application/json'
        ])->post('https://api-demo.skydropx.com/v1/quotations', $body);

        $quote = json_decode($response, true);

        //dd($quote);

        $carriers = $quote;

        return view('envios.quote', compact('carriers'));
    }
}
