<?php
  if (isset($_POST['submit'])) {
    require_once './connection.php';
    require_once './functions.inc.php';

    $usermail = mysqli_real_escape_string($conn, $_POST['usermail']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (emptyInputLogin($usermail, $password) !== false) {
      header("location: ../login.php?error=emptyInput");
      exit();
    }

    loginUser($conn, $usermail, $password);

    $template = 'INSERT INTO users (username, password) VALUES (?,?);';
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $template)) {
      echo "Something went wrong";
    } else {
      mysqli_stmt_bind_param($stmt, "ss", $usermail, $password);
      mysqli_stmt_execute($stmt);  
    };
  } else {
    header("location: ../index.php");
  }
?>