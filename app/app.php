<?php

const BASE_PATH = __DIR__.'/../';
$DEV_MODE = false;
$API_KEY = "your_api_key";
$city = "Eldoret";
$lat = -0.48;
$lon = 36.55;

$city = isset($_POST['city']) ? $_POST['city'] : $city;

// $url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$API_KEY}";
$url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&lang=en&units=metric&appid={$API_KEY}";

require './app/functions.php';

$errors = [];
$data = [];


if ($DEV_MODE) {
    try
    {
        $data = getSavedWeather();
        
        if (empty($data)) {
            $data  = connect($url);

            saveWeather($data);
        }
    } catch(Exception $e)
    {
        http_response_code(500);
        $errors['message'] = $e->getMessage();
        $errors['exception'] = $e;
        $errors['code'] = http_response_code(500);
        $errors['status'] = "Error";
    }
} else {
    $data = connect($url);
}

$failed = isset($data->cod); // city not found error

// echo "<p>Rain past 1 hour: ".$data->rain['1h'] ?? 'N/A'." mm</p>".PHP_EOL;
// echo "<p>Rain past 3 hours: ".$data->rain['3h'] ?? 'N/A'." mm</p>".PHP_EOL;

view('weather.php', [
    "data" => $data,
    "errors" => $errors,
    "currentTime" => time(),
    "failed" => $failed
]);

die;