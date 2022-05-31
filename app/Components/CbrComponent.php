<?php

namespace App\Components;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Utils;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class CbrComponent implements ApiCheckCbrInterface
{

    public $baseUrl = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * @param Carbon $date
     * @return bool
     * @throws \Exception
     */
    public function checkCbrFromApi($date): \Illuminate\Http\JsonResponse
    {
        $response = Http::get($this->baseUrl, [
            'date_req' => $date,
        ]);
        $xml = simplexml_load_string($response->body());
        if($xml->count()){
            return response()->json($xml);
        }else{
            abort(404);
        }
    }
}
