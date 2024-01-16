<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\State;
use App\Models\Address;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use App\Services\EnviaService;
use App\Services\Shipp1Service;
use Illuminate\Support\Facades\Http;
use App\Resolvers\ApiPlatformResolver;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CreateOrder extends Component
{
    protected $token;
    protected $listeners = ['render'];

    public int $addressesCount = 0;
    public $addresses;
    public $address;

    public $confirmed_address;

    public $envio_type = 2;
    public $contact, $phone, $city, $address_1, $number_address, $address_2, $reference, $shipping_cost = 0;
    public $postcode = 78037;

    public $states, $provider, $service, $total_shipping, $peso;
    public $state_id = "";

    public $carriers;

    public $rules = [
        'contact' => 'required',
        'phone' => 'required'
    ];

    public function mount()
    {
        $this->states = State::all();

        if(session('email_guest')){
            $this->addresses = Address::where('email', session('email_guest'))->get();
            //$this->addresses->loadCount('addresses');

            $this->addressesCount = $this->addresses->count();
        }

        $this->token = config('services.skydropx.token');
        //$this->chooseShipping();
    }

    // #[On('shipping-option')]
    // public function updateShipping($total_shipping, $provider, $service)
    // {
    //     if ($total_shipping === null || $total_shipping == 0) {
    //         $this->shipping_cost = 0;
    //     } else {
    //         $this->shipping_cost = $total_shipping;
    //         $this->provider = $provider;
    //         $this->service = $service;
    //     }
    // }

    #[On('address-added')]
    public function addressAdded(): void
    {

    }

    #[On('confirm-address')]
    public function confirmAddress($address, $confirmed): void
    {
        //$this->address = Address::where('id', $address)->firstOrFail();
        $this->address = $address;

        $this->confirmed_address = $confirmed;

    }

    #[On('add-shipping-cost')]
    public function addShippingCost($shipping_cost, $provider, $service): void{
        $this->shipping_cost = $shipping_cost;
        $this->provider = $provider;
        $this->service = $service;
    }

    public function updatedEnvioType($value)
    {
        if ($value == 1) {
            $this->shipping_cost = 0;

            $this->resetValidation([
                'state_id', 'city', 'address_2', 'address_1', 'number_address', 'postcode', 'reference'
            ]);
        } else {
            $this->shipping_cost = 105;

            if (Cart::subtotal() > 1250) {
                $this->shipping_cost = 0;
            }
        }
    }

    // public function shippingCost($value, $value2, $value3)
    // {
    //     $this->shipping_cost = $value;
    //     $this->provider = "Paqueteria " . $value2;
    //     $this->service = "Servicio " . $value3;
    //     //$this->dispatch('render')->self();
    // }

    public function chooseShipping()
    {
        // if ($this->envio_type === 2) {
        if (strlen(trim($this->postcode)) == 5 && ctype_digit(trim($this->postcode))) {

            //Carga los Metodos de envio

            $peso = 0;
            $token = $this->token;

            foreach(Cart::content() as $item){
                $peso = $item->options->weight + $peso;
            }
            
            $this->peso = $peso;

            $body = [
                "zip_from" => "31120",
                "zip_to" => $this->postcode,
                "parcel" => [
                    "weight" => $peso,
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

            //dd($response);

            //dd($response);

            //$quotes = json_decode($response, true);

            $coleccion = collect($response);
            $this->carriers = $coleccion;

           
            // foreach ($quotes as $quote) {
            //     $opt = array(
            //         'provider' => $quote['provider'],
            //         'service_level_name' => $quote['service_level_name'],
            //         'days' => $quote['days'],
            //         'extra_dimension_price' => $quote['extra_dimension_price'],
            //         'out_of_area_pricing' => $quote['out_of_area_pricing'],
            //         'amount_local' => $quote['amount_local'],
            //         'total_pricing' => $quote['total_pricing'],
            //     );
            //     array_push($this->carriers, $opt);
            // }
        }
        // }
    }

    public function updatedPostcode()
    {
    }

    public function create_order()
    {

        /* $rules = $this->rules;

        if($this->envio_type == 2){
            $rules['state_id'] = 'required';
            $rules['city'] = 'required';
            $rules['address_2'] = 'required';
            $rules['number_address'] = 'required';
            $rules['address_1'] = 'required';
            $rules['postcode'] = 'required';
            $rules['reference'] = 'required';
        }

        $this->validate($rules);

        $address = new Address();

        $address->user_id = auth()->user()->id;
        $address->state_id = $this->state_id;
        $address->address_1 = $this->address_1;
        $address->number_address = $this->number_address;
        $address->address_2 = $this->address_2;
        $address->city = $this->city;
        $address->postcode = $this->postcode;
        $address->phone = $this->phone;
        $address->reference = $this->reference;

        $address->save();

        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->envio_type = $this->envio_type;
        $order->shipping_cost = 0;
        $order->total = $this->shipping_cost + Cart::subtotal();
        $order->content = Cart::content();

        if ($this->envio_type == 2) {
            //$order->shipping_cost = $this->shipping_cost;
            
            // $order->envio = json_encode([
            //     'state_id' => $this->state_id,
            //     'city' => $this->city,
            //     'address_2' => $this->address_2,
            //     'address_1' => $this->address,
            //     'postcode' => $this->postcode,
            //     'references' => $this->references
            // ]);

            $order->envio = json_encode([
                'state_id' => $this->state_id,
                'city' => $this->city,
                'address_2' => $this->address_2,
                'address_1' => $this->address,
                'number_address' => $this->number_address,
                'postcode' => $this->postcode,
                'references' => $this->references
            ]);
        }

        $order->save();

        // foreach (Cart::content() as $item) {
        //     discount($item);
        // }

        Cart::destroy();

        return redirect()->route('orders.payment', $order); */
    }

    public function render()
    {
        // $peso = 1;
        // $token = $this->token;

        // foreach (Cart::content() as $item) {
        //     $peso = $item->options->weight + $peso;
        // }

        // $this->peso = $peso;

        // if($this->confirmed_address){
        //     $addressID = Address::where('id', $this->address)->firstOrFail();
        //     $zip_code = $addressID->postcode;
        // }else{
        //     $zip_code = "20255";
        // }

        // $body = [
        //     "zip_from" => "31120",
        //     "zip_to" => "20255",
        //     "parcel" => [
        //         "weight" => $peso,
        //         "height" => "15",
        //         "width" => "15",
        //         "length" => "15"
        //     ],
        //     "carriers" => [
        //         ["name" => "Fedex"],
        //         ["name" => "Estafeta"],
        //         ["name" => "Redpack"],
        //         ["name" => "UPS"],
        //         ["name" => "Paquetexpress"],
        //         ["name" => "DHL"]
        //     ]
        // ];

        // $response = Http::withToken($this->token)->withHeaders([
        //     'Content-Type: application/json'
        // ])->post('https://api-demo.skydropx.com/v1/quotations', $body)->json();

        // $coleccion = collect($response);
        // $this->carriers = $coleccion;

        return view('livewire.create-order');
    }
}
