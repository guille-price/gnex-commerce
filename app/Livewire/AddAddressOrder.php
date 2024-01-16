<?php

namespace App\Livewire;

use App\Models\State;
use App\Models\Address;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Session;

class AddAddressOrder extends Component
{
    public $states, $reference;
    public $state_id = "";
    public $add_new = false;
    public $address_id = [];

    public bool $showModal = false;
    public bool $confirmAddress = false;

    public $addresses;

    #[Rule('required')]
    public $contact;

    #[Rule('required|string|email')]
    public $email;

    #[Rule('required|numeric')]
    public $phone;

    #[Rule('required')]
    public $city;

    #[Rule('required')]
    public $address_1;

    #[Rule('required')]
    public $number_address;

    #[Rule('required')]
    public $address_2;

    #[Rule('required|numeric')]
    public $postcode;

    public function mount()
    {
        //Session::flush();
        //$this->states = State::all();
        //$this->addresses = Address::where('email', $this->email)->get();
    }

    public function create_address(): void
    {
        if (session('email_guest') === null) {
            session()->put('email_guest', $this->email);
        }

        sleep(1);

        //dd("Agregando Direccion");
        $this->validate();

        Address::create($this->only(['contact', 'email', 'phone', 'state_id', 'city', 'address_1', 'number_address', 'address_2', 'postcode', 'reference']));

        $this->email = session('email_guest');
        $this->showModal = false;

        $this->add_new = false;

        $this->dispatch('address-added');

        $this->reset();
    }

    public function add_new_address($email = null)
    {
        //sleep(1);
        $this->email = $email;
        $this->add_new = true;
        $this->showModal = true;
    }

    public function back_addresses()
    {
        $this->add_new = false;
    }

    public function confirm_address($address_id){
        $this->confirmAddress = true;
        $this->address_id = $address_id;

        $this->dispatch('confirm-address', address: $this->address_id, confirmed: $this->confirmAddress);

        $this->dispatch('confirm-address')->self();
    }

    public function render()
    {
        $this->addresses = Address::where('email', session('email_guest'))->get();
        $this->states = State::all();

        //dd($this->addresses);

        return view('livewire.add-address-order');
    }
}
