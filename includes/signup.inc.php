<?php
  if (isset($_POST['submit'])) {
    require_once './connection.php';
    require_once './functions.inc.php';

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $passwordRepeat = mysqli_real_escape_string($conn, $_POST['passwordRepeat']);

    if (emptyInputSignup($email, $username, $password, $passwordRepeat) !== false) {
      header("location: ../index.php?error=emptyInput");
      exit();
    }
    if (userExists($conn, $username, $email) !== false) {
      header("location: ../index.php?error=userExists");
      exit();
    }
    if (invalidEmail($email) !== false) {
      header("location: ../index.php?error=invalidEmail");
      exit();
    }
    if (passwordMatch($password, $passwordRepeat) !== false) {
      header("location: ../index.php?error=passwordMatch");
      exit();
    }

    createUser($conn, $email, $username, $password);

  } else {
    header("location: ../index.php");
    exit();
  }
?>