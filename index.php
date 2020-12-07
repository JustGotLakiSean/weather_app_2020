<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weather App 2020</title>
  <style>
    <?php include 'styles.css'; ?>
  </style>
</head>

<body>
  <!-- Weather form -->
  <main id="main">
    <form action="" method="POST" id="weather_form">
      <input type="text" name="city_name" id="city_name" placeholder="Type city..." required />
      <input type="submit" name="get_weather" id="get_weather" value="GO" />
    </form>

    <?php

    if (isset($_POST['get_weather'])) {
      $city_name = '';
      $weather_response = '';
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
        $weather_city_name = strtoupper($data->name);

        echo <<<WEATHER_RESULT
      <section id="weather_result" >
        <div id="btn_container">
          <button type="button" onclick="window.location.href='index.php'" id="btn_done">DONE</button>
        </div>
        <div id="inner_weather" align="center">
          <p id="data_temperature">{$data->main->temp}°C</p>
          <p id="_city_name">{$weather_city_name}, {$data->sys->country}</p>
          <p id="data_country"></p>
          <img src="http://openweathermap.org/img/w/{$data->weather[0]->icon}.png" id = "weather_icon"/>
          <p id="weather_description">{$weather_description}</p>
        </div>
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