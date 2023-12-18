<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $location = $_GET['location']; // Get the location from the user input

    $apiKey = 'd2a4c1778036f27d7120d53014070c17'; // Replace with your API key
    $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q=$location&appid=$apiKey&units=metric";

    $weatherData = @file_get_contents($apiUrl); // Use @ to suppress warnings
    if ($weatherData === false) {
        echo 'Failed to fetch weather data. Please try again later.';
    } else {
        $decodedData = json_decode($weatherData, true); // Decode JSON to associative array
        if ($decodedData !== null) {
            $country = $decodedData['sys']['country'];
            $weatherMain = $decodedData['weather'][0]['main'];
            $weatherDescription = $decodedData['weather'][0]['description'];
            $temperature = $decodedData['main']['temp'];
            $humidity = $decodedData['main']['humidity'];
            $windSpeed = $decodedData['wind']['speed'];

            echo "<h2>Weather in $location, $country</h2>";
            echo "<p><strong>Description:</strong> $weatherDescription</p>";
            echo "<p><strong>Temperature:</strong> $temperature °C</p>";
            echo "<p><strong>Humidity:</strong> $humidity%</p>";
            echo "<p><strong>Wind Speed:</strong> $windSpeed m/s</p>";
        } else {
            echo 'Error decoding weather data.';
        }
    }
}
?>
