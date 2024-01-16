<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;
use Illuminate\Http\Request;

class Shipp1Service {
	use ConsumesExternalServices;

	protected $baseUri;

	protected $token;

	public function __construct() {
		$this->baseUri = config('services.shipp1.base_uri');
		$this->token = config('services.shipp1.token');;
	}

	public function resolveAuthorization(&$queryParams, &$formParams, &$headers) {
		$queryParams['Authorization'] = $this->resolveAccessToken();
	}

	public function decodeResponse($response) {
		return json_decode($response);
	}

	public function resolveAccessToken() {
		return "Token {$this->token}";
	}

	public function testQuate(){
        $cotiza = array(
            'address_from' => array(
            'province' =>"Ciudad de Mexico",
            'city' =>"Ciudad de Mexico",
            'name' =>"Envios Transversal",
            'zip' =>"14370",
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
        
        curl_setopt($ch, CURLOPT_URL, 'https://api-demo.skydropx.com/v1/shipments');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
        $headers = array();
        $headers[] = 'Authorization: Token token=HvinL9nchGMBBNCoe4ajji9LXvMSnRbMoZk5gkljQwwt';
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

    public function testCarriers(){
       
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, 'https://api-demo.skydropx.com/v1/carriers');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 0);
        
        $headers = array();
        $headers[] = 'Authorization: Token token=HvinL9nchGMBBNCoe4ajji9LXvMSnRbMoZk5gkljQwwt';
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

	public function ShippQuotation($zip_to, $weight, $height, $width, $length) {
		return $this->makeRequest(
			'POST',
			'/v1/quotations',
			[],
			[
                'zip_from' => '31120',
                'zip_to' => $zip_to,
                'parcel' => [
                    'weight' => 2,
                    'height' => 15,
                    'width' => 15,
                    'length' => 15
                ],
                'carriers' => [ 'name' => 'DHL', 'name' => 'Fedex', 'name' => 'Estafeta' ]
            ],
			[
				'Content-Type' => 'application/json',
			],
		);
	}

    public function ShippQTest($zip_to) {
		return $this->makeRequest(
			'POST',
			'/v1/quotations',
			[],
			[
                'zip_from' => '31120',
                'zip_to' => $zip_to,
                'parcel' => [
                    'weight' => 2,
                    'height' => 15,
                    'width' => 15,
                    'length' => 15
                ],
                'carriers' => [
                    ['name' => 'Fedex']
                    ]
            ],
			[
				'Content-Type' => 'application/json',
			],
		);
	}

    public function carriersCompanies() {
		return $this->makeRequest(
			'GET',
			'v1/carriers',
			[],
			[],
			[
                'Content-Type' => 'application/json'
            ],
		);
	}

	public function resolveFactor($currency) {
		$zeroDecimalCurrencies = ['JPY'];

		if (in_array(strtoupper($currency), $zeroDecimalCurrencies)) {
			return 1;
		}

		return 100;
	}
}