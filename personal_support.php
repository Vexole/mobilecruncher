<?php
session_start();
?>
<!doctype html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>
    <?php include_once('components/header.php') ?>
    <div class="container-fluid">
        <h1 class="text-center my-4">MobileCrunchers - Personal Support</h1>
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


                $html .= "<div class='card p-3 col-md-4 mx-auto d-flex flex-column align-items-center my-4'>";
                $html .= "<div><img src='{$picture}' alt='{$firstName} {$lastName}'></div>";
                $html .= "<h3 class='name mc-color-primary my-3'>{$title} {$firstName} {$lastName}</h3>";
                $html .= "<h5 class='email'>{$email}</h5>";
                $html .= "<h5 class='phone'>Phone: {$phone}</h5>";
                $html .= "</div>";
            }
            echo $html;
        }
        ?>
    </div>
    <?php include_once('components/footer.php') ?>
</body>

</html>