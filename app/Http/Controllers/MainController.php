<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class MainController extends Controller
{
    public function fetch()
    {
        $client = new \GuzzleHttp\Client();

        $headers = [

            'Content-Type' => 'application/json',

        ];

        $body = '{

        "Segment": [

            {

                "DepFrom": "AMM",

                "ArrTo": "DXB",

                "DepDate": "2023-12-31"

            }

        ],

        "tripType": "oneway",

        "Adult": 1,

        "Child": 0,

        "Infant": 0,

        "Class": "Economy"

    }';

        $request = new \GuzzleHttp\Psr7\Request('POST', 'https://gallpax.flyjatt.com/v1/Duffel/AirSearch.php', $headers, $body);

        $res = $client->sendAsync($request)->wait();

        $data = json_decode($res->getBody(), true);

        if (array_key_exists('message', $data)) {
            $data = [];
        }
        return view('main', compact('data'));
    }
}
