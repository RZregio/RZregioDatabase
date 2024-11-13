<?php
include('connect.php');
session_start();

// Initialize variables for error handling and form submission status
$deleteFailed = false;
$deleteSuccess = false;
$passwordMismatch = false;

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Fetch user information from session
$user = $_SESSION['user'];

// Delete Method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if the password and confirm password match
    if ($password === $confirmPassword) {
        if (!empty($email) && !empty($password)) {


            // Verify if the user exists by email and password before proceeding with delete
            $stmt = $conn->prepare("SELECT userID, userInfoID FROM users WHERE email = ? AND password = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $userData = $result->fetch_assoc();
                $userID = $userData['userID'];
                $userInfoID = $userData['userInfoID'];

                $stmtDeleteUserInfo = $conn->prepare("DELETE FROM userinfo WHERE userInfoID = ?");
                $stmtDeleteUserInfo->bind_param("i", $userInfoID);

                if ($stmtDeleteUserInfo->execute()) {
                    $stmtDeleteUser = $conn->prepare("DELETE FROM users WHERE userID = ?");
                    $stmtDeleteUser->bind_param("i", $userID);

                    if ($stmtDeleteUser->execute()) {
                        $deleteSuccess = true;
                        session_destroy();  
                        echo "<script>
                        window.location.href = 'index.php';
                        alert('Account deleted successfully!');
                        </script>";
                        exit();
                    } else {
                        $deleteFailed = true;
                    }

                    $stmtDeleteUser->close();
                } else {
                    $deleteFailed = true;
                }

                $stmtDeleteUserInfo->close();
            } else {
                $deleteFailed = true;
            }
        } else {
            $deleteFailed = true;
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
                    B.T PROFILE
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="head col">
                <div class="login-head">
                    Delete your account
                </div>
            </div>
        </div>
        <div class="p-5">
        </div>
    </div>



    <div class="container mt-1">
        <div class="row">
            <div class="col">
                <div class="card p-5">
                    <form method="POST" onsubmit="return validatePassword()">
                        <?php if ($deleteFailed): ?>
                            <div class="alert alert-danger" role="alert">
                                Sign up failed. Please try again.
                            </div>
                        <?php elseif ($passwordMismatch): ?>
                            <div class="alert alert-danger" role="alert">
                                Passwords do not match. Please try again.
                            </div>
                        <?php endif; ?>
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
                            <input type="password" name="confirmPassword" class="form-control frm-sign"
                                id="confirmPassword" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sign">Delete Forever!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    =

    <?php include('assets/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

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