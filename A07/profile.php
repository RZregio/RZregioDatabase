<?php
include('connect.php');
session_start();



$updateFailed = false;
$updateSuccess = false;
$deleteFailed = false;
$deleteSuccess = false;
$passwordMismatch = false;

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
}
$userID = $_SESSION['userID'];



//Update Function
if (isset($_POST['btnUpdate'])) {
    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $email = !empty($_POST['email']) ? $_POST['email'] : null;
    $phonenumber = !empty($_POST['phonenumber']) ? $_POST['phonenumber'] : null;
    $firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : null;
    $lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : null;
    $birthdate = !empty($_POST['birthDay']) ? $_POST['birthDay'] : null;

    $updateFields = [];
    if ($username)
        $updateFields[] = "userName = '$username'";
    if ($email)
        $updateFields[] = "email = '$email'";
    if ($phonenumber)
        $updateFields[] = "phoneNumber = '$phonenumber'";
    if ($firstname)
        $updateFields[] = "firstName = '$firstname'";
    if ($lastname)
        $updateFields[] = "lastName = '$lastname'";
    if ($birthdate)
        $updateFields[] = "birthDay = '$birthdate'";

    if (!empty($updateFields)) {
        $updateQuery = "UPDATE users u 
                        JOIN userinfo ui ON u.userInfoID = ui.userInfoID
                        SET " . implode(", ", $updateFields) . " 
                        WHERE u.userID = '$userID'";
        $updateResult = executeQuery($updateQuery);

        if ($updateResult) {
            $updateSuccess = true;
            // Update session variables if needed
            if ($username)
                $_SESSION['userName'] = $username;
            if ($email)
                $_SESSION['email'] = $email;
            if ($phonenumber)
                $_SESSION['phoneNumber'] = $phonenumber;
            if ($firstname)
                $_SESSION['firstName'] = $firstname;
            if ($lastname)
                $_SESSION['lastName'] = $lastname;
            if ($birthdate)
                $_SESSION['birthDay'] = $birthdate;
        } else {
            $updateFailed = true;
        }
    } else {
        $updateFailed = true;
    }
}



//Delete Function
if (isset($_POST['btnDel'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password == $confirmPassword) {
        if (!empty($email) && !empty($password)) {
            $userQuery = "SELECT userID, userInfoID FROM users WHERE email = '$email' AND password = '$password'";
            $userResult = executeQuery($userQuery);

            if (mysqli_num_rows($userResult) > 0) {
                $user = mysqli_fetch_assoc($userResult);
                $userID = $user['userID'];
                $userInfoID = $user['userInfoID'];

                $deleteUserInfoQuery = "DELETE FROM userinfo WHERE userInfoID = '$userInfoID'";
                $deleteUserInfoResult = executeQuery($deleteUserInfoQuery);

                if ($deleteUserInfoResult) {
                    $deleteUserQuery = "DELETE FROM users WHERE userID = '$userID'";
                    $deleteUserResult = executeQuery($deleteUserQuery);

                    if ($deleteUserResult) {
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
                } else {
                    $deleteFailed = true;
                }
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
                    Update your account details
                </div>
            </div>
        </div>
    </div>



    <div class="container mt-1">
        <div class="row">
            <div class="col">
                <div class="card p-5">
                    <form method="POST">
                        <?php if ($updateFailed): ?>
                            <div class="alert alert-danger" role="alert">
                                Update failed. Please try again.
                            </div>
                        <?php elseif ($updateSuccess): ?>
                            <div class="alert alert-success" role="alert">
                                Account updated successfully!
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <div id="userName">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                            aria-expanded="false" aria-controls="collapseOne">
                                            <label for="username" class="form-label">UserName:
                                                <?php echo $_SESSION['userName'] ?>
                                            </label>
                                            <p class="edit-data d-flex justify-content-end">EDIT</p>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#userName">
                                        <div class="accordion-body">
                                            <input type="text" name="username" class="form-control frm-sign"
                                                id="username">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div id="email">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            <label for="email" class="form-label">Email:
                                                <?php echo $_SESSION['email'] ?>
                                            </label>
                                            <p class="edit-data">EDIT</p>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#email">
                                        <div class="accordion-body">
                                            <input type="email" name="email" class="form-control frm-sign" id="email">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div id="phoneNumber">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            <label for="phonenumber" class="form-label">PhoneNumber:
                                                <?php echo $_SESSION['phoneNumber'] ?>
                                            </label>
                                            <p class="edit-data">EDIT</p>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#phoneNumber">
                                        <div class="accordion-body">
                                            <input type="text" name="phonenumber" class="form-control frm-sign"
                                                id="phonenumber">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div id="firstName">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            <label for="firstname" class="form-label">FirstName:
                                                <?php echo $_SESSION['firstName'] ?>
                                            </label>
                                            <p class="edit-data">EDIT</p>
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        data-bs-parent="#firstName">
                                        <div class="accordion-body">
                                            <input type="text" name="firstname" class="form-control frm-sign"
                                                id="firstname">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div id="lastName">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                            aria-expanded="false" aria-controls="collapseFive">
                                            <label for="lastname" class="form-label">LastName:
                                                <?php echo $_SESSION['lastName'] ?>
                                            </label>
                                            <p class="edit-data">EDIT</p>
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse"
                                        data-bs-parent="#lastName">
                                        <div class="accordion-body">
                                            <input type="text" name="lastname" class="form-control frm-sign"
                                                id="lastname">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div id="birthDay">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                            aria-expanded="false" aria-controls="collapseSix">
                                            <label for="birthDay" class="form-label">BirthDate:
                                                <?php echo $_SESSION['birthDay'] ?>
                                            </label>
                                            <p class="edit-data">EDIT</p>
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse"
                                        data-bs-parent="#birthDay">
                                        <div class="accordion-body">
                                            <input type="date" name="birthDay" class="form-control frm-sign"
                                                id="birthDay">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button name="btnUpdate" type="submit" class="btn btn-sign">Update Information!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div id="header" class="container">
        <div class="row mt-5">
            <div class="head col">
                <div class="login-head">
                    Delete your account
                </div>
            </div>
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
                            <button name="btnDel" type="submit" class="btn btn-sign">Delete Forever!</button>
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