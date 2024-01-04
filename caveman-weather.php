<?php

const BASE_PATH = __DIR__.'/';
$DEV_MODE = true;
$API_KEY = "d9516830de1019272f895b90e50eee4a";
$city = "Eldoret";
$lat = -0.48;
$lon = 36.55;

$city = isset($_POST['city']) ? $_POST['city'] : "$city";


// $url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$API_KEY}";
$url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&lang=en&units=metric&appid={$API_KEY}";

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die;
}

function saveWeather(mixed $data) : int | false
{
    return file_put_contents("./data/weather.json", json_encode($data));
}

function getSavedWeather(string $filePath = "./data/weather.json") : mixed
{
    return json_decode(file_get_contents($filePath));
}

function call(CurlHandle $ch, string $url) : string|bool
{
    // set options
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    // get response
    return curl_exec($ch);
}

function basePath(string $path):string
{
    return BASE_PATH.$path;
}

function view(string $path, array $attributes = [])
{
    extract($attributes);

    require basePath('views/'.$path);
}

$errors = [];


if ($DEV_MODE) {
    try
    {
        $data = getSavedWeather();
        
        if (empty($data)) {
            // connect - initialize curl
            $ch = curl_init(url:$url);

            // call the api
            $response = call(ch:$ch, url:$url);

            // close curl connection
            curl_close($ch);

            // decode response
            $data = json_decode($response);

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
}


// echo "<p>Rain past 1 hour: ".$data->rain['1h'] ?? 'N/A'." mm</p>".PHP_EOL;
// echo "<p>Rain past 3 hours: ".$data->rain['3h'] ?? 'N/A'." mm</p>".PHP_EOL;

view('weather.php', [
    "data" => $data,
    "errors" => $errors,
    "currentTime" => time()
]);

die;