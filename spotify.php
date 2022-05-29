<?php
    $client_id = "5f7a75439d5a4be9b034b9ed3137d765";
    $client_secret = "fa215063a3cd4a1b989b08d1667e3aa6";

    //RICHIESTA
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    curl_setopt($curl, CURLOPT_POST, 1);
   
    curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
  
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 

    $token =json_decode(curl_exec($curl), true);

    curl_close($curl);
    
    //TRACCIA
    $track=urlencode($_GET["track"]);
    $urlSpotify="https://api.spotify.com/v1/search?type=track&q=";
    $url=$urlSpotify .$track;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token["access_token"])); 
    $result=curl_exec($curl);
    echo $result;

    curl_close($curl);
?>