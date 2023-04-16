<?php
session_start();
require_once('db/Database.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $connection = Database::initializeDatabase();
    header("location: index.php");
}
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
        <h1 class="text-center my-4">MobileCrunchers - Database Initialization</h1>
        
        <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="d-flex justify-content-center flex-column mb-5">
            <button type="submit" class="btn btn-primary mt-4 col-md-2 mx-auto">Initialize Database</button>
        </form>
    </div>
    <?php include_once('components/footer.php') ?>
</body>

</html>