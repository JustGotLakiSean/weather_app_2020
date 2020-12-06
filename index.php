<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weather App 2020</title>
</head>
<body>
  <!-- Weather form -->
  <form action="" method="POST" id="weather_form">
    <input type="text" name="city_name" id="txt_location" />
    <input type="submit" name="get_weather" id="get_weather" />
  </form>

  <?php

  if(isset($_POST['get_weather'])){
    $city_name = '';
    $weather_request = '';
    if(isset($_POST['city_name'])){
      $city_name = $_POST['city_name'];
      $api_key = "c7f8e92990d0d095596be9a4dea86104";

      $curl = curl_init();
      curl_setopt($curl, CURLOPT_HEADER, 0);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($curl, CURLOPT_URL, "api.openweathermap.org/data/2.5/weather?q={$city_name}&appid={$api_key}");
      $weather_response = curl_exec($curl);
      $data = json_decode($weather_response);
      curl_close($curl);

      echo $data->weather[0]->description;

    } else{

    }
  } else {
    
  }

  ?>
  <!-- End weather form -->

  <!-- Weather result -->
  <!-- <section id="result_weather">
    <label id="city_name"></label>
    <p id="temp"></p>
  </section> -->
  <!-- End Weather result -->
  
</body>
</html>