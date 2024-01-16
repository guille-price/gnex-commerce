<?php

namespace App\Resolvers;

use App\Models\ApiPlatform;
use Exception;

class ApiPlatformResolver {
	protected $paymentPlatforms;

	public function __construct() {
		$this->paymentPlatforms = ApiPlatform::all();
	}

	public function resolveService($paymentPlatformId) {
		$name = strtolower($this->paymentPlatforms->firstWhere('id', $paymentPlatformId)->name);
        //dd($name);
		$service = config("services.{$name}.class");
        //dd($service);
		if ($service) {
			return resolve($service);
		}

		throw new Exception('The selected API platform is not in the configuration');
	}
}