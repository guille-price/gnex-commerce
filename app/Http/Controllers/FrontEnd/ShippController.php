<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ShippController extends Controller
{
  protected $base_uri;
  protected $query_uri;
  protected $token;
  protected $tokenSkydrop;

  public function __construct()
  {
    $this->base_uri = config('services.envia.base_uri');
    $this->query_uri = config('services.envia.query_uri');
    $this->token = config('services.envia.token');
    $this->tokenSkydrop = config('services.skydropx.token');
  }

  public function allCarriers()
  {
    $token = $this->token;

    $response = Http::withToken($token)->get('https://queries-test.envia.com/available-service/MX/0/1');
    //$response = Http::withToken($token)->get('https://queries-test.envia.com/available-service/MX/0/1')->throw()->json();

    //return $carries;
    //dd($response);

    //$response = Http::get('https://queries.envia.com/available-service/MX/0/1');

    //return json_decode($response);
    //dd(json_decode($response));

    //$carriers = json_decode($response);
    //$carriers = json_decode($response);

    $carriers = json_decode($response, true);
    //dd(json_encode($carriers));
    //dd($carriers);

    $carriers = $response['data'];

    if ($response->unauthorized()) {
      return "No tienes Autorizacion";
    } elseif ($response->ok()) {
      return view('envios.todas', compact('carriers'));
    } else {
      return "Error de algun tipo";
    }
  }

  public function rate()
  {
    $peso = 1;
    $token = $this->token;
    $dataCarriers = [];

    /* $body = '{
        "origin": {
          "name": "Mexico",
          "company": "Yeonhy Beauty",
          "email": "contacto@yeonhi.com",
          "phone": "5532384954",
          "street": "tito guizar",
          "number": "7513",
          "district": "churubusco",
          "city": "chihuahua",
          "state": "ch",
          "country": "MX",
          "postalCode": "31120",
          "reference": "",
          "coordinates": {
            "latitude": "",
            "longitude": ""
          }
        },
        "destination": {
          "name": "Mexico",
          "company": "Envia",
          "email": "mexico@envia.com",
          "phone": "8180100135",
          "street": "belisario dominguez",
          "number": "2470 of 310",
          "district": "obispado",
          "city": "monterrey",
          "state": "nl",
          "country": "MX",
          "postalCode": "64060",
          "reference": "",
          "coordinates": {
            "latitude": "",
            "longitude": ""
          }
        },
        "packages": [
          {
            "content": "champu",
            "amount": 1,
            "type": "box",
            "weight": 6,
            "insurance": 0,
            "declaredValue": 0,
            "weightUnit": "KG",
            "lengthUnit": "CM",
            "dimensions": {
              "length": 11,
              "width": 15,
              "height": 20
            }
          }
        ],
        "shipment": {
          "carrier": "redpack",
          "type": 1
        },
        "settings": {
          "printFormat": "PDF",
          "printSize": "STOCK_4X6",
          "currency": "MXN",
          "cashOnDelivery": "500.00",
          "comments": ""
        }
      }'; */


    /* $body = [
        "origin" => [
          "name" => "Mexico",
          "company" => "Yeonhy Beauty",
          "email" => "contacto@yeonhi.com",
          "phone" => "5532384954",
          "street" => "tito guizar",
          "number" => "7513",
          "district" => "churubusco",
          "city" => "chihuahua",
          "state" => "ch",
          "country" => "MX",
          "postalCode" => "31120",
          "reference" => "",
          "coordinates" => [
            "latitude" => "",
            "longitude" => ""
        ]
    ],
        "destination" => [
          "name" => "Mexico",
          "company" => "Envia",
          "email" => "mexico@envia.com",
          "phone" => "8180100135",
          "street" => "belisario dominguez",
          "number" => "2470 of 310",
          "district" => "obispado",
          "city" => "monterrey",
          "state" => "nl",
          "country" => "MX",
          "postalCode" => "64060",
          "reference" => "",
          "coordinates" => [
            "latitude" => "",
            "longitude" => ""
    ]
    ],
        "packages" => [
          [
            "content" => "champu",
            "amount" => 1,
            "type" => "box",
            "weight" => $peso,
            "insurance" => 0,
            "declaredValue" => 0,
            "weightUnit" => "KG",
            "lengthUnit" => "CM",
            "dimensions" => [
              "length" => 11,
              "width" => 15,
              "height" => 20
            ]
          ]
        ],
        "shipment" => [
          "carrier" => "dhl",
          "type" => 1
        ],
        "settings" => [
          "printFormat" => "PDF",
          "printSize" => "STOCK_4X6",
          "currency" => "MXN",
          "cashOnDelivery" => "500.00",
          "comments" => ""
        ]
      ]; */

      // $response = Http::withToken($token)->withBody($body)->post('https://api-test.envia.com/ship/rate/');


      //inicia Redpack
    $bodyRedpack = [
      "origin" => [
        "name" => "Mexico",
        "company" => "Yeonhy Beauty",
        "email" => "contacto@yeonhi.com",
        "phone" => "5532384954",
        "street" => "tito guizar",
        "number" => "7513",
        "district" => "churubusco",
        "city" => "chihuahua",
        "state" => "ch",
        "country" => "MX",
        "postalCode" => "31120",
        "reference" => ""
      ],
      "destination" => [
        "name" => "Mexico",
        "street" => "malbec",
        "number" => "110",
        "district" => "Hacienda De Los Morales",
        "city" => "Soledad de Graciano Sánchez, San Luis Potosí",
        "state" => "sl",
        "country" => "MX",
        "postalCode" => "78438",
        "reference" => ""
      ],
      "packages" => [
        [
          "content" => "champu",
          "amount" => 1,
          "type" => "box",
          "weight" => $peso,
          "insurance" => 0,
          "declaredValue" => 0,
          "weightUnit" => "KG",
          "lengthUnit" => "CM",
          "dimensions" => [
            "length" => 11,
            "width" => 15,
            "height" => 20
          ]
        ]
      ],
      "shipment" => [
        "carrier" => "redpack",
        "type" => 1
      ]
    ];

    $responseRedpack = Http::withToken($token)->post('https://api-test.envia.com/ship/rate/', $bodyRedpack);

    $redpacks = $responseRedpack['data'];

    //dd($redpacks);

    //inicia Fedex
    $bodyFedex = [
      "origin" => [
        "name" => "Mexico",
        "company" => "Yeonhy Beauty",
        "email" => "contacto@yeonhi.com",
        "phone" => "5532384954",
        "street" => "tito guizar",
        "number" => "7513",
        "district" => "churubusco",
        "city" => "chihuahua",
        "state" => "ch",
        "country" => "MX",
        "postalCode" => "31120",
        "reference" => ""
      ],
      "destination" => [
        "name" => "Mexico",
        "street" => "malbec",
        "number" => "110",
        "district" => "Hacienda De Los Morales",
        "city" => "Soledad de Graciano Sánchez, San Luis Potosí",
        "state" => "sl",
        "country" => "MX",
        "postalCode" => "78438",
        "reference" => ""
      ],
      "packages" => [
        [
          "content" => "champu",
          "amount" => 1,
          "type" => "box",
          "weight" => $peso,
          "insurance" => 0,
          "declaredValue" => 0,
          "weightUnit" => "KG",
          "lengthUnit" => "CM",
          "dimensions" => [
            "length" => 11,
            "width" => 15,
            "height" => 20
          ]
        ]
      ],
      "shipment" => [
        "carrier" => "fedex",
        "type" => 1
      ]
    ];

    $responseFedex = Http::withToken($token)->post('https://api-test.envia.com/ship/rate/', $bodyFedex);

    $fedexs = $responseFedex['data'];

    //dd($fedexs);

    //inicia DHL
    $bodyDHL = [
      "origin" => [
        "name" => "Mexico",
        "company" => "Yeonhy Beauty",
        "email" => "contacto@yeonhi.com",
        "phone" => "5532384954",
        "street" => "tito guizar",
        "number" => "7513",
        "district" => "churubusco",
        "city" => "chihuahua",
        "state" => "ch",
        "country" => "MX",
        "postalCode" => "31120",
        "reference" => ""
      ],
      "destination" => [
        "name" => "Mexico",
        "street" => "malbec",
        "number" => "110",
        "district" => "Hacienda De Los Morales",
        "city" => "Soledad de Graciano Sánchez, San Luis Potosí",
        "state" => "sl",
        "country" => "MX",
        "postalCode" => "78438",
        "reference" => ""
      ],
      "packages" => [
        [
          "content" => "champu",
          "amount" => 1,
          "type" => "box",
          "weight" => $peso,
          "insurance" => 0,
          "declaredValue" => 0,
          "weightUnit" => "KG",
          "lengthUnit" => "CM",
          "dimensions" => [
            "length" => 11,
            "width" => 15,
            "height" => 20
          ]
        ]
      ],
      "shipment" => [
        "carrier" => "dhl",
        "type" => 1
      ]
    ];

    $responseDHL = Http::withToken($token)->post('https://api-test.envia.com/ship/rate/', $bodyDHL);

    $dhls = $responseDHL['data'];

    //dd($dhls);

    //inicia Estafeta
    $bodyEstafeta = [
      "origin" => [
        "name" => "Mexico",
        "company" => "Yeonhy Beauty",
        "email" => "contacto@yeonhi.com",
        "phone" => "5532384954",
        "street" => "tito guizar",
        "number" => "7513",
        "district" => "churubusco",
        "city" => "chihuahua",
        "state" => "ch",
        "country" => "MX",
        "postalCode" => "31120",
        "reference" => ""
      ],
      "destination" => [
        "name" => "Mexico",
        "street" => "malbec",
        "number" => "110",
        "district" => "Hacienda De Los Morales",
        "city" => "Soledad de Graciano Sánchez, San Luis Potosí",
        "state" => "sl",
        "country" => "MX",
        "postalCode" => "78438",
        "reference" => ""
      ],
      "packages" => [
        [
          "content" => "champu",
          "amount" => 1,
          "type" => "box",
          "weight" => $peso,
          "insurance" => 0,
          "declaredValue" => 0,
          "weightUnit" => "KG",
          "lengthUnit" => "CM",
          "dimensions" => [
            "length" => 11,
            "width" => 15,
            "height" => 20
          ]
        ]
      ],
      "shipment" => [
        "carrier" => "estafeta",
        "type" => 1
      ]
    ];

    $responseEstafeta = Http::withToken($token)->post('https://api-test.envia.com/ship/rate/', $bodyEstafeta);

    $estafetas = $responseEstafeta['data'];

    foreach($redpacks as $paqueteria){
      $dataCarriers[] = [
          'carrier' => $paqueteria['carrier'],
          'serviceDescription' => $paqueteria['serviceDescription'],
          'deliveryEstimate' => $paqueteria['deliveryEstimate'],
          'basePrice' => $paqueteria['basePrice'],
          'additionalCharges' => $paqueteria['additionalCharges'],
          'extendedFare' => $paqueteria['extendedFare'],
          'totalPrice' => $paqueteria['totalPrice']
      ];
    }
    
    foreach($fedexs as $paqueteria){
      $dataCarriers[] = [
          'carrier' => $paqueteria['carrier'],
          'serviceDescription' => $paqueteria['serviceDescription'],
          'deliveryEstimate' => $paqueteria['deliveryEstimate'],
          'basePrice' => $paqueteria['basePrice'],
          'additionalCharges' => $paqueteria['additionalCharges'],
          'extendedFare' => $paqueteria['extendedFare'],
          'totalPrice' => $paqueteria['totalPrice']
      ];
    }

    foreach($dhls as $paqueteria){
      $dataCarriers[] = [
          'carrier' => $paqueteria['carrier'],
          'serviceDescription' => $paqueteria['serviceDescription'],
          'deliveryEstimate' => $paqueteria['deliveryEstimate'],
          'basePrice' => $paqueteria['basePrice'],
          'additionalCharges' => $paqueteria['additionalCharges'],
          'extendedFare' => $paqueteria['extendedFare'],
          'totalPrice' => $paqueteria['totalPrice']
      ];
    }

    foreach($estafetas as $paqueteria){
      $dataCarriers[] = [
          'carrier' => $paqueteria['carrier'],
          'serviceDescription' => $paqueteria['serviceDescription'],
          'deliveryEstimate' => $paqueteria['deliveryEstimate'],
          'basePrice' => $paqueteria['basePrice'],
          'additionalCharges' => $paqueteria['additionalCharges'],
          'extendedFare' => $paqueteria['extendedFare'],
          'totalPrice' => $paqueteria['totalPrice']
      ];
    }

     //dd($dataCarriers);

    // $carriers = json_decode($responseRedpack, true);
    // dd($carriers);

    $carriers = $dataCarriers;

    return view('envios.rate', compact('carriers'));
  }

  public function track(){
    $token = $this->token;

    $body = [
      "trackingNumbers" => [
      "#95207431",
      "#392991163716"
      ]
    ];

    $response = Http::withToken($token)->post('https://api.envia.com/ship/generaltrack/', $body);

    $tracking = json_decode($response, true);
    dd($tracking);
  }
}
