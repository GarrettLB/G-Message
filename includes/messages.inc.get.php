<?php
  session_start();

  require_once './connection.php';

  $sql = 'SELECT * FROM messages WHERE senderId = ? AND receiverId = ? OR senderId = ? AND receiverId = ?;';
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../convolist.php?error=statementFail");
  } else {
    $id1 = $_SESSION['id'];
    $id2 = mysqli_real_escape_string($conn, $_GET['id']);

    mysqli_stmt_bind_param($stmt, 'iiii', $id1, $id2, $id2, $id1);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($resultData)) {
      if ($row['senderId'] == $id1) {
        $output = 
          '<div class="sender-div">
            <p class="sender-p">'.$row['content'].'</p>
          </div>';
      } else {
        $output = 
        '<div class="receiver-div">
          <p class="receiver-p">'.$row['content'].'</p>
        </div>';
      }
      echo $output;
    }
    mysqli_stmt_close($stmt);
  }
?>