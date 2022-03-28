<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G-Message</title>
</head>

<body>
  <form action="includes/login.inc.php" method="POST">
    <h2>Log In</h2>
    <label for="usermail">Username or Email</label>  
    <input name="usermail" type="text">
    <br>
    <label for="password">Password</label>
    <input name="password" type="password">
    <br>
    <button name='submit' type="submit">Log In</button>
    <a href="index.php">Or sign up here</a>  
  </form>  

  <?php
    if (isset($_GET['error'])) {
      if ($_GET['error'] == "emptyInput") {
        echo "<p>Fields can't be empty!</p>";
      }
      elseif ($_GET['error'] == "noUser") {
        echo "<p>No user with this username!</p>";
      }
      elseif ($_GET['error'] == "invalidCred") {
        echo "<p>Invalid Credentials!</p>";
      }
    }
  ?>
</body>
</html>