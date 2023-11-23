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
            $finalResult = [];
        } else {
            $mergedData = [];
            $offers = Offer::all();

            // Add all items from the API
            foreach ($data as $externalItem) {
                $mergedData[$externalItem['OfferId']] = [
                    'flight_code' => $externalItem['OfferId'],
                    'caree' => $externalItem['Caree'],
                    'total_price' => $externalItem['TotalFare'] . ' ' . $externalItem['Currency'],
                    'cabin_class' => $externalItem['CabinClass'],
                    'dep_from' => $externalItem['Segments'][0],
                    'arr_to' => $externalItem['Segments'][0],
                ];
            }

            // Add items from the database that don't have a matching ID in the API data
            foreach ($offers as $offer) {
                if (!isset($mergedData[$offer->flight_code])) {
                    $mergedData[$offer->flight_code] = $offer->toArray();
                }
            }

            // Convert the associative array to a sequential array if needed
            $finalResult = array_values($mergedData);
        }
        return view('main', compact('finalResult'));
    }
}
