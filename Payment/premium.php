<?php
  session_start();

  include("../db/connection.php");
  include("../db/functions.php");  

  $user_data = check_login($con);


  $post_field = json_encode(
      [
          "amount" => 50,
          "currency" => "ETB",
          "email" => $user_data ['Email'],
          "first_name" => $user_data ['FirstName'],
          "last_name" =>$user_data ['LastName'],
          "tx_ref" => rand(10,100000),
          "callback_url" =>  "https://webhook.site/077164d6-29cb-40df-ba29-8a00e59a7e60",
          "return_url" => "http://localhost/Web-Project/mainpremium.php",
          "customization[title]" => "Payment for premium membership for TaskMate",
      ]
  );

  $curl = curl_init();
  curl_setopt_array(
      $curl,
      array(
          CURLOPT_URL => 'https://api.chapa.co/v1/transaction/initialize',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $post_field,
          CURLOPT_HTTPHEADER => array(
              'Authorization: Bearer CHASECK_TEST-QcLHLjqUFrEBf8rmR6SAh8pPqxy9UxPm',
              'Content-Type: application/json'
          ),
      )
  );

  $response = curl_exec($curl);
  curl_close($curl);
  echo $response;
  $response = json_decode($response);

  if ($response->status == "success") {
    $prid = $user_data ['id'];
    $query = "insert into premium_accounts (ID) values ('$prid')";
    mysqli_query($con, $query);
    header("Location: " . $response->data->checkout_url);


   } else {
    header("Location: ../main.php");
   }

?>