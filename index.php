<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G-Message</title>
</head>

<body>
  <form action="includes/signup.inc.php" method="POST">
    <h2>Sign Up</h2>
    <label for="email">Email</label>  
    <input name="email" type="text">
    <br>
    <label for="username">Username</label>  
    <input name="username" type="text">
    <br>
    <label for="password">Password</label>
    <input name="password" type="password">
    <br>
    <label for="passwordRepeat">Re-Enter Password</label>
    <input name="passwordRepeat" type="password">
    <br>
    <button name='submit' type="submit">Sign Up</button>
    <a href="login.php">Or log in here</a>
  </form>  

  <?php
    if (isset($_GET['error'])) {
      if ($_GET['error'] == "emptyInput") {
        echo "<p>Fields can't be empty!</p>";
      }
      elseif ($_GET['error'] == "userExists") {
        echo "<p>That username is already taken!</p>";
      }
      elseif ($_GET['error'] == "invalidEmail") {
        echo "<p>Invalide email!</p>";
      }
      elseif ($_GET['error'] == "passwordMatch") {
        echo "<p>Passwords do not match!</p>";
      }
    }
  ?>
  
</body>
</html>