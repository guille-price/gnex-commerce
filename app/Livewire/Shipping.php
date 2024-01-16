<?php

namespace App\Livewire;

use App\Models\Address;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Gloudemans\Shoppingcart\Facades\Cart;

class Shipping extends Component
{
    protected $token;
    protected $listeners = ['render'];

    public $shipping_cost, $provider, $service;

    public $zip_code, $peso, $shippings, $address;

    public $address_id;

    public $carriers = [];

    // public function mount($postcode, $peso)
    // {
    //     $this->token = config('services.skydropx.token');
    //     $this->zip_code = $postcode;
    //     $this->peso = $peso;
    //     $this->rate();
    // }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="flex justify-center">
            <div class="w-16 h-16 animate-spin rounded-full bg-gradient-to-r from-yeonhi via-yeonhi-st to-yeonhi-gl">
                <div
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-gray-200 rounded-full border-2 border-white">
                    <img src="url('storage/img/logo.png')">
                </div>
            </div>
            <div>
                <p class="text-gray-700 text-center text-md"><br>Cargando Opciones de Envio... </p>
            </div>
        </div>
        HTML;
    }

    // public function rate()
    // {
    //     $quotes = null;
    //     $response = null;
    //     $peso = 2;
    //     $token = $this->token;

    //     $body = [
    //         "zip_from" => "31120",
    //         "zip_to" => "52500",
    //         "parcel" => [
    //             "weight" => $peso,
    //             "height" => "15",
    //             "width" => "15",
    //             "length" => "15"
    //         ],
    //         "carriers" => [
    //             ["name" => "Fedex"],
    //             ["name" => "Estafeta"],
    //             ["name" => "Redpack"],
    //             ["name" => "UPS"],
    //             ["name" => "Paquetexpress"],
    //             ["name" => "DHL"]
    //         ]
    //     ];

    //     $response = Http::withToken($this->token)->withHeaders([
    //         'Content-Type: application/json'
    //     ])->post('https://api-demo.skydropx.com/v1/quotations', $body)->json();

    //     $coleccion = collect($response);
    //     $this->carriers = $coleccion;

    // }

    public function shippingCost($value, $value2, $value3)
    {
        $this->shipping_cost = $value;
        // $this->provider = "Paqueteria " . $value2;
        // $this->service = "Servicio " . $value3;
        $this->provider = $value2;
        $this->service = $value3;
        $this->dispatch('add-shipping-cost', shipping_cost: $this->shipping_cost, provider: $this->provider, service: $this->service);
    }

    public function render()
    {
        $this->token = config('services.skydropx.token');
        $peso = 0;
        //$token = $this->token;

        $addressID = Address::where('id', $this->address)->firstOrFail();

        $this->zip_code = $addressID->postcode;

        foreach (Cart::content() as $item) {
            $peso = $item->options->weight + $peso;
        }

        $this->peso = $peso;

        $body = [
            "zip_from" => "31120",
            "zip_to" => $this->zip_code,
            "parcel" => [
                "weight" => $this->peso,
                "height" => "15",
                "width" => "15",
                "length" => "15"
            ],
            "carriers" => [
                ["name" => "Fedex"],
                ["name" => "Estafeta"],
                ["name" => "Redpack"],
                ["name" => "UPS"],
                ["name" => "Paquetexpress"],
                ["name" => "DHL"]
            ]
        ];

        $response = Http::withToken($this->token)->withHeaders([
            'Content-Type: application/json'
        ])->post('https://api-demo.skydropx.com/v1/quotations', $body)->json();

        $coleccion = collect($response);
        $this->carriers = $coleccion;

        return view('livewire.shipping');
    }
}
