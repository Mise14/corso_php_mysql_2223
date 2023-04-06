<?php

use PHPUnit\Framework\TestCase;


class UserApiCreateTest extends TestCase{

    public function test_create_user_api()
    {
        $payload = [
    "first_name" => "Leonardo",
    "last_name" => "Da Api JSON",
    "birthday" => "2023-03-10",
    "birth_city" => "Napoli",
    "regione_id" => 7,
    "provincia_id" => 8,
    "gender" => "M",
    "username" => "ew8882324234348dsdddrrrrrdd@laaa.t",
    "password" => "ciccio",
                ];

    $response = $this->post("http://localhost/corso_php_mysql_2223/form_in_php/rest_api/users.php", $payload);
        
    //$this->assertNull($response);

    fwrite(STDERR, print_r($response, TRUE));
    }

    public function post(string $url, array $body)
    {
      //Curl -> chiamata HTTP in linea di comando
        $curl = curl_init();
        
        curl_setopt_array($curl, [
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($body),
          CURLOPT_HTTPHEADER => [
            "Accept: */*",
            "Content-Type: application/json",
            "User-Agent: Thunder Client (https://www.thunderclient.com)"
          ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }


}