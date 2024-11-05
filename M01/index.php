<?php
include('connect.php');
$login_failed = false;



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Use prepared statements to prevent SQL injection
  $stmt = $conn->prepare("SELECT u.*, ui.firstName, ui.lastName, ui.birthDay 
                           FROM users u 
                           LEFT JOIN userinfo ui ON u.userInfoID = ui.userInfoID 
                           WHERE (u.userName = ? OR u.email = ?) AND u.password = ?");
  $stmt->bind_param("sss", $username, $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    session_start();
    $_SESSION['user'] = $result->fetch_assoc();
    header("Location: home.php");
    exit();
  } else {
    $login_failed = true;
  }

  $stmt->close();
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BuzzIT Teleco | Login Page</title>
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
    <div class="row mt-2">
      <div class="head col">
        <div class="title-head">
          B.T
        </div>
      </div>
    </div>
    <div class="row mt-1">
      <div class="head col">
        <div class="login-head">
          Login to BuzzIT Teleco
        </div>
      </div>
    </div>
  </div>



  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card p-5">
          <form method="POST">
            <div class="login-name mb-3 ">
              <label>Enter your Username or Email</label>
              <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username"
                required aria-describedby="basic-addon1">
            </div>

            <div class="login-password mb-3">
              <label>Enter your password</label>
              <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password"
                required aria-describedby="basic-addon2">
            </div>

            <div class="mb-3">
              <div class="login-auto">
                <input type="checkbox" class="form-check-input form-control" id="stay-signed-in" name="stay-signed-in"
                  aria-describedby="basic-addon3 basic-addon4">
                <label for="stay-signed-in" class="form-check-label">Stay signed in</label>
              </div>
            </div>

            <div class="login-submit mb-3">
              <button type="submit" class="btn">Log In</button>
            </div>

            <div class="sign-up mb-1">
              <label for="" class="sign-up-label">First time here?</label>
              <button type="submit" class="btn sign-up-now" onclick="window.location.href='signup.php'">Create a new
                account</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



  <?php include('assets/footer.php') ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

  <script>
    function showLoginMessage(event) {
      event.preventDefault();
      alert("Please login first.");
    }
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      <?php if ($login_failed): ?>
        setTimeout(function() {
          alert("Wrong username or password.");
        }, 100);  
      <?php endif; ?>
    });
  </script>
</body>

</html>