<?php
include('connect.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
  // Redirect to login page or show an error
  header("Location: login.php");
  exit();
}

// Fetch user information from session
$user = $_SESSION['user'];
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BuzzIT Teleco | Homepage</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="assets/bt.ico"> 
  <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Inline+One:ital@0;1&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <?php include('assets/navbar.php') ?>
  <div id="header" class="container">
    <div class="row mt-5 pt-5">
      <div class="head col">
        <div class="title-head">
          B.T
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="head col">
        <div class="login-head">
          Welcome to BuzzIT Teleco
        </div>
        <div class="welcome-user-head">
          <?php echo  htmlspecialchars(strtoupper($user['userName']));
          ?>
        </div>
      </div>
    </div>
    <div class="p-5">

    </div>
  </div>

  <?php include('assets/footer.php') ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
</body>

</html>