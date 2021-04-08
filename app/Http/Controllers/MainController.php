<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    private $_url;
    private $_ch;
    private $_endpoint  = '/TripPinRESTierService/(S(3jgtctz5a2wyzb0gi3pxikvb))/People';
    private $_direction = ['asc', 'desc' ,''];

    public function __construct()
    {
        $this->_url = env('ODATA_URL');
        $this->_ch  = curl_init();
    }

    public function index()
    {
        $this->_url .= $this->_endpoint;
        $people       = $this->curl();
        if(!$people) return response()->json(['error' => 'No data from API'], 404);

        return view('welcome', ['people' => $people->value]);
    }

    public function fetchData(Request $request) {
        $param      = preg_replace('/\s+/', '', $request->input('param'));
        $direction  = $this->_direction[$request->input('direction')];

        if($direction) {
            $this->_endpoint .= '?$orderby=' . $param . "%20$direction";
        }

        $this->_url .= $this->_endpoint;
        $people      = $this->curl();

        if(!$people) return response()->json(['error' => 'No data from API'], 404);

        return view('partial/table', ['people' => $people->value]);
    }

    private function curl()
    {
        curl_setopt($this->_ch, CURLOPT_URL, $this->_url);
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->_ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $res  = curl_exec($this->_ch);
        $code = curl_getinfo($this->_ch, CURLINFO_RESPONSE_CODE);

        if ($code !== 200) {
            Log::error(['Error with API request', curl_error($this->_ch)]);
            return null;
        }

        return json_decode($res);
    }
}
