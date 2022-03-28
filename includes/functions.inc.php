<?php
  include_once './connection.php';

  function emptyInputSignup($email, $username, $password, $passwordRepeat) {
    $result = null;

    if (empty($email) || empty($username) || empty($password) || empty($passwordRepeat)) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  };

  function emptyInputLogin($usermail, $password) {
    $result = null;

    if (empty($usermail) || empty($password)) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  };

  function invalidEmail($email) {
    $result = null;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  };

  function passwordMatch($password, $passwordRepeat) {
    $result = null;

    if ($password !== $passwordRepeat) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  };

  function userExists($conn, $username, $email) {
    $sql = 'SELECT * FROM users WHERE username = ? OR email = ?;';
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../index.php?error=statementFail");
    } else {
      mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
      mysqli_stmt_execute($stmt);

      $resultData = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
      } else {
        $result = false;
        return $result;
      }

      mysqli_stmt_close($stmt);
    }
  };

  function createUser($conn, $email, $username, $password) {
    $sql = 'INSERT INTO users (email, username, password) VALUES (?,?,?);';
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../index.php?error=statementFail");
    } else {
      $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

      mysqli_stmt_bind_param($stmt, "sss", $email, $username, $hashedPwd);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

      loginUser($conn, $username, $password);
    }
  };

  function loginUser($conn, $usermail, $password) {
    $userCheck = userExists($conn, $usermail, $usermail);

    if ($userCheck === false) {
      header("location: ../login.php?error=noUser");
      exit();
    }

    $pwdHashed = $userCheck["password"];
    $checkPwd = password_verify($password, $pwdHashed);

    if ($checkPwd === false) {
      header("location: ../login.php?error=invalidCred");
      exit();
    } elseif ($checkPwd === true) {
      session_start();
      $_SESSION['id'] = $userCheck["id"];
      header('location: ../convolist.php');
    }
  };
  
?>