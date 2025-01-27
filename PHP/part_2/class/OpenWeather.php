<?php

namespace App;

use App\Exceptions\CurlException;
use App\Exceptions\HTTPException;
use App\Exceptions\UnauthorizedHTTPException;
use DateTime;

require_once 'CurlException.php';
require_once 'HTTPException.php';
require_once 'UnauthorizedHTTPException.php';
/**
 * Gère l'API d'OpenWeather
 * 
 * @author Jonathan Boyer <john@doe.fr>
 * 
 */
class OpenWeather
{

    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
    
    /**
     * Récupère les informations météorologique du jour
     *
     * @param  mixed $city Ville (ex : Montepllier,fr)
     * @return array
     */
    public function getToday(string $city): ?array
    {
        $data = $this->callAPI("weather?q={$city}");
        return
        [
            'temp' => $data['main']['temp'],
            'description' => $data['weather'][0]['description'],
            'date' => new DateTime()
        ];                
    }
    
    /**
     * Récupère les prévisions sur plusieurs jours
     *
     * @param  string $city
     * @return array
     */
    public function getForecast(string $city): ?array
    {
        $data = $this->callAPI("forecast/daily?q={$city}");
            foreach($data['list'] as $day)
            {
                $results[] = 
                [
                    'temp' => $day['temp']['day'],
                    'description' => $day['weather'][0]['description'],
                    'date' => new DateTime('@' . $day['dt'])
                ];
            }

    return $results;
    }
    
    /**
     * Appelle l'API Open weather
     *
     * @param  string $endpoint Action à appeler (weather, weather/forecast)
     * 
     * @throws CurlException CUrl a rencontré une erreur
     * @throws UnauthorizedHTTPException L'api est interdite
     * @throws HTTPException
     * @return array
     */
    private function callAPI(string $endpoint): ?array
    {
        $curl = curl_init("https://api.openweathermap.org/data/2.5/{$endpoint}&units=metric&lang=fr");
        curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CAINFO => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'cert.crt',           
                CURLOPT_TIMEOUT_MS => 10
            ]);
            $data = curl_exec($curl);
            if ($data === false){
                throw new CurlException($curl);
            }
            $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($code !== 200)
            {
                curl_close($curl);
                if ($code === 401){
                    $data = json_decode($data, true);
                    throw new UnauthorizedHTTPException($data['message'], 401);
                }
                throw new HTTPException($data, curl_getinfo($curl, $code));
            }
            curl_close($curl);
            return json_decode($data, true);
    }
}
