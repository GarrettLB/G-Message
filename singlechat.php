<?php
  include './includes/header.inc.php';
?>

<body class="bod">
  <div class="head">
    <button id="back-button" onclick="location.href='convolist.php'">Back</button>  
    <h2 id="chatName"></h2>
  </div>
  
  <div id="chat-box"></div>

  <div id="type-area">
    <form id="messageForm" action="#">
      <input type="text" name="senderId" value="<?php echo $_SESSION['id']; ?>" style="display: none;">
      <input type="text" name="receiverId" value="<?php echo $_GET['user']; ?>" style="display: none;">
      <input id="messageInput" type="text" name="message" placeholder="Type message here">
      <button id="subBtn" type="submit" name="submit" >Send</button>
    </form>
  </div>
  
  
  <?php
    include_once './includes/footer.inc.php'
  ?>
  <script src="./src/singlechat.js"></script>
</body>
</html>