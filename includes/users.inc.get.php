<?php
  require_once './connection.php';

  $sql = 'SELECT * FROM users WHERE username = ?;';
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../convolist.php?error=statementFail");
  } else {
    $userSearch = mysqli_real_escape_string($conn, $_POST['userSearch']);

    if (!empty($userSearch)) {
      mysqli_stmt_bind_param($stmt, 's', $userSearch);
      mysqli_stmt_execute($stmt);
    }

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
      echo "".$row['username']."-".$row['id']."";
    } else {
      echo "No user with that name!";
    }
    
    mysqli_stmt_close($stmt);
  }
?>