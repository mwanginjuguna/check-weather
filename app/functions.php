<?php

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

function connect($url)
{
    // connect - initialize curl
    $ch = curl_init(url:$url);

    // call the api
    $response = call(ch:$ch, url:$url);

    // close curl connection
    curl_close($ch);

    // decode response
    $data = json_decode($response);

    return $data;
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

