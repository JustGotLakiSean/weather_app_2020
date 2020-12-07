<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weather App 2020</title>
</head>

<body>
  <!-- Weather form -->
  <main id="main">
    <form action="" method="POST" id="weather_form">
      <input type="text" name="city_name" id="city_name" />
      <input type="submit" name="get_weather" id="get_weather" required />
    </form>

    <?php

    if (isset($_POST['get_weather'])) {
      $city_name = '';
      $weather_request = '';
      $api_key = '';
      if (isset($_POST['city_name'])) {
        $city_name = htmlentities($_POST['city_name'], ENT_QUOTES, 'UTF-8');
        $api_key = "c7f8e92990d0d095596be9a4dea86104";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_URL, "api.openweathermap.org/data/2.5/weather?q={$city_name}&units=metric&appid={$api_key}");
        $weather_response = curl_exec($curl);
        $data = json_decode($weather_response);
        curl_close($curl);

        $weather_description = ucwords($data->weather[0]->description);

        echo <<<WEATHER_RESULT
      <section id="weather_result">
        <p id="_city_name">{$data->name}</p>
        <p id="data_country">{$data->sys->country}</p>
        <img src="http://openweathermap.org/img/w/{$data->weather[0]->icon}.png" id = "weather_icon"/>
        <p id="data_temperature">{$data->main->temp}°C</p>
        <p id="weather_description">{$weather_description}</p>
      </section>
WEATHER_RESULT;
      } else {
      }
    } else {
    }

    ?>
  </main>
</body>

</html>