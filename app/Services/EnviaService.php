<?php

namespace App\Services;

use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Traits\ConsumesExternalServices;
use Illuminate\Support\Facades\Http;

class EnviaService {
	use ConsumesExternalServices;

	protected $token;

	protected $baseUri;

	public function __construct() {
		$this->baseUri = config('services.envia.base_uri');
		$this->token = config('services.envia.key');
	}

	public function resolveAuthorization(&$queryParams, &$formParams, &$headers) {
		$headers['Authorization'] = $this->resolveAccessToken();
	}

	public function decodeResponse($response) {
		return json_decode($response);
	}

	public function resolveAccessToken() {
		return "Bearer {$this->token}";
	}

	public function allCarriers(){

		//$response = Http::withToken('token')->get('https://queries.envia.com/available-service/MX/0/1');		

		$response = Http::get('https://queries.envia.com/available-service/MX/0/1');

		return $response->getBody();
	}

    public function testQuate(){
        $cotiza = array(
            'origin' => array(
            'name' =>"Ciudad de Mexico",
            'company' =>"Ciudad de Mexico",
            'email' =>"Envios Transversal",
            'phone' =>"14370",
            'country' =>"Mexico",
            'address1' =>"Avenida Acuducto 115",
            'company' =>"Grupo Transversal",
            'address2' =>"San Lorenzo Huipulco",
            'phone' =>"44358915",
            'email' =>"envios1@grupotransversal.mx",
        ),
        'parcels' => array(
            array(
            'weight' =>5,
            'distance_unit' =>"CM",
            'mass_unit' =>"KG",
            'height' =>10,
            'width' =>26,
            'length' =>21
            )
        ),
        'address_to' => array(
            'province' =>'estado',
            'city' =>'ciudad',
            'name' => 'algun nombre',
            'zip' => '30640',
            'country' =>"Mexico",
            'address1' => 'calle zarco',
            'company' => "casa",
            'address2' => 'colonia centro por ejemplo',
            'phone' => '1231231231',
            'email' => 'email@gmail.com',
            'references' => 'asdfasdfasdf',
            'contents' =>"Productos Promocionales"
          ),
        );
        $data = json_encode($cotiza);
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, 'https://api-test.envia.com/ship/rate/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
        $headers = array();
        $headers[] = 'Authorization: Bearer 87274beb115f05f0437c74a6ddad72767e6ad98b2e0a7389c6cd8a0ab3b81d90';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
           echo 'Error:' . curl_error($ch);
        }else{
           echo $result;
        }
        curl_close($ch);

        return $result;
    }

}