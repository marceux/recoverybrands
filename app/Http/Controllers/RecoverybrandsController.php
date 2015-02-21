<?php namespace App\Http\Controllers;

use JsonRPC\Client;
use Cache;

class RecoverybrandsController extends Controller {

	private $client;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Set JSON-RPC Client
		$this->client = new Client(env('TARGETURL'));
		$this->client->authentication(env('JSONUSER'), env('JSONPASS'));
		$this->client->debug = true;
	}

	/**
	 * Used for calculating the distance from one long/lat to another
	 * @param  float $lat1 
	 * @param  float $lon1 
	 * @param  float $lat2 
	 * @param  float $lon2 
	 * @param  string $unit The type of unit distance
	 * @return float       The distance
	 */
	private function distance($lat1, $lon1, $lat2, $lon2, $unit = 'M') {
  		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  		$dist = acos($dist);
  		$dist = rad2deg($dist);
  		$miles = $dist * 60 * 1.1515;
  		$unit = strtoupper($unit);
  
  		if ($unit == "K")
  		{
    		return ($miles * 1.609344);
  		} 

  		else if ($unit == "N")
  		{
  			return ($miles * 0.8684);
  		}

  		else
  		{
        	return $miles;
        }
	}

	public function index()
	{
		Cache::add('Home', 'Sweet Home', 30);
		return view('home');
	}

	/**
	 * Show nearby location listings.
	 *
	 * @return Response
	 */
	public function listing($state, $city, $day)
	{
		// Final Query
		$jsonQuery = [[["state_abbr" => "$state", "city" => "$city"]]];

		// Execute JSON-RPC Method
		$response = $this->client->byLocals($jsonQuery);

		// Set Temporary Results Array for Storage...
		$results = array();

		// If response came up empty or NULL
		if ($response == NULL ||
			count($response) == 0)
		{
			$results["0"] = array(
				"meeting_name" => "Not Available",
				"raw_address" => "Not Available"
			);
		}

		else {
			// Iterate over responses
			foreach ($response as $result)
			{
				// Set Day Variable to check for day...
				$queryDay = $result['time']['day'];
				// Check if Monday
				if ($queryDay == $day)
				{
					// Set latitude and longitude
					$lat = $result['address']['lat'];
					$lng = $result['address']['lng'];
					
					// Calculate distance and round it
					$distance = $this->distance(env('HOMELAT'), env('HOMELNG'), $lat, $lng);
					$distance = round($distance, 2);

					// Append result to $results and use distance as key
					$results["$distance"] = $result;

					// Caching Individual Results
					$dataStore = array(
						'distance' => $distance,
						'name' => $result['meeting_name'],
						'address' => $result['raw_address']
					);

					foreach ($dataStore as $key => $value) {
						$cacheKey = $result['id'] . ":$key";
						Cache::add($cacheKey, $value, 30);
					}
				}
			}

			// Sort results according to key
			ksort($results);			
		}

		// Set view data
		$data = array(
			'results' => $results
		);

		// Return view
		// ... View found in /resources/views/listings.blade.php
		return view('listings', $data);
	}

}