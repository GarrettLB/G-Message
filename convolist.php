<?php
  include './includes/header.inc.php';
?>

<body class="bod">
  <div id="convoHead">
    <button class="mr-5" onclick="location.href='includes/logout.inc.php'">Logout</button>
    <h2 id="convoHTwo" >Your Convos</h2>
  </div>
  
  <div id="userListDiv">
    <form id="userForm" action="#">
      <input id="userSearch" type="text" name="userSearch" placeholder="Search for a user">
    </form>

    <ul id="user-list">
      
    </ul>
  </div>

  <script src="./src/convolist.js"></script>
</body>
</html>