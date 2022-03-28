<?php
  include_once './connection.php';

  $sql = 'SELECT * FROM users WHERE id = ?;';
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../singlechat.php?error=statementFail");
  } else {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($resultData);

    echo $row["username"];
    
    mysqli_stmt_close($stmt);
  }
?>