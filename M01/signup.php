<?php
include('connect.php');

// Initialize variables for error handling and form submission status
$signupFailed = false;
$signupSuccess = false;
$passwordMismatch = false;

// Sign-up Method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $phoneNumber = $_POST['phoneNumber'];

  // Check if the password and confirm password match
  if ($password === $confirmPassword) {
    if (!empty($username) && !empty($email) && !empty($password) && !empty($phoneNumber)) {

      $stmt = $conn->prepare("INSERT INTO userinfo () VALUES ()"); 
      if ($stmt->execute()) {
        $userInfoId = $stmt->insert_id;
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO users (userName, email, password, phoneNumber, userInfoId) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $username, $email, $password, $phoneNumber, $userInfoId);

        if ($stmt->execute()) {
          $signupSuccess = true;  
        } else {
          $signupFailed = true; 
        }

        $stmt->close();
      } else {
        $signupFailed = true;  
      }
    } else {
      $signupFailed = true;  
    }
  } else {
    $passwordMismatch = true;  
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BuzzIT Teleco | Signup Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="assets/bt.ico"> 
  <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Inline+One:ital@0;1&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body class="mt-5">
  <?php include('assets/navbar.php') ?>
  <div id="header" class="container">
    <div class="row mt-5">
      <div class="head col">
        <div class="title-head">
          Sign Up
        </div>
      </div>
    </div>
    <div class="row mt-1">
      <div class="head col">
        <div class="login-head">
          Create a New Account
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-1">
    <div class="row">
      <div class="col">
        <div class="card p-5">
          <form method="POST" onsubmit="return validatePassword()">
            <?php if ($signupSuccess): ?>
              <div class="alert alert-success" role="alert">
                Account created successfully! Click the Login in here below.
              </div>
            <?php elseif ($signupFailed): ?>
              <div class="alert alert-danger" role="alert">
                Sign up failed. Please try again.
              </div>
            <?php elseif ($passwordMismatch): ?>
              <div class="alert alert-danger" role="alert">
                Passwords do not match. Please try again.
              </div>
            <?php endif; ?>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control frm-sign" id="username" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control frm-sign" id="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control frm-sign" id="password" required>
            </div>
            <div class="mb-3">
              <label for="confirmPassword" class="form-label">Confirm Password</label>
              <input type="password" name="confirmPassword" class="form-control frm-sign" id="confirmPassword"
                required>
            </div>
            <div class="mb-3">
              <label for="phoneNumber" class="form-label">Phone Number</label>
              <input type="tel" name="phoneNumber" class="form-control frm-sign" id="phoneNumber" required>
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-sign">Sign Up</button>
            </div>
          </form>
          <a class="log-here" href="index.php">Log in here</a>
        </div>
      </div>
    </div>
  </div>

  <?php include('assets/footer.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script>
    function validatePassword() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;
      if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
      }
      return true;
    }
  </script>
</body>

</html>