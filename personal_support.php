<?php

$curl = curl_init("https://randomuser.me/api/");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
$data = json_decode($response, true);
if (isset($data['results'])) {
    $html = "";
    foreach ($data['results'] as $result) {
        $title = $result['name']['title'];
        $firstName = $result['name']['first'];
        $lastName = $result['name']['last'];
        $email = $result['email'];
        $phone = $result['phone'];
        $picture = $result['picture']['large'];


        $html .= "<div>";
        $html .= "<div><img src='{$picture}'></div>";
        $html .= "<div class='name'>{$title} {$firstName} {$lastName}</div>";
        $html .= "<div class='email'>{$email}</div>";
        $html .= "<div class='phone'>{$phone}</div>";
        $html .= "</div>";
    }

    echo $html;
}
