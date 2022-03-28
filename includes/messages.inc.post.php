<?php
  if (isset($_POST['submit'])) {
    require_once './connection.php';

    $sql = 'INSERT INTO messages (senderId, receiverId, content) VALUES (?,?,?);';
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../singlechat.php?error=statementFail");
    } else {
      $senderId = mysqli_real_escape_string($conn, $_POST['senderId']);
      $receiverId = mysqli_real_escape_string($conn, $_POST['receiverId']);
      $message = mysqli_real_escape_string($conn, $_POST['message']);

      if (!empty($message)) {
        mysqli_stmt_bind_param($stmt, 'iis', $senderId, $receiverId, $message);
        mysqli_stmt_execute($stmt);
      
        mysqli_stmt_close($stmt);
      }
    }
  } else {
    header("location: ../convolist.php?error");
  }
?>