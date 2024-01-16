<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class SkydropxService {
	use ConsumesExternalServices;

	protected $baseUri;

	protected $token;

	public function __construct() {
		$this->baseUri = config('services.skydropx.base_uri');
		$this->token = config('services.skydropx.token');
	}

	public function resolveAuthorization(&$queryParams, &$formParams, &$headers) {
		//$headers['Authorization'] = $this->resolveAccessToken();
		$queryParams['token'] = $this->resolveAccessToken();
	}

	public function decodeResponse($response) {
		return json_decode($response);
	}

	public function resolveAccessToken() {
		//return "Token token {$this->token}";
		return "{$this->token}";
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

    public function carriersCompanies() {
		return $this->makeRequest(
			'POST',
			'/v1/carriers',
			[],
			[],
			[
				'Content-Type: application/json'
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