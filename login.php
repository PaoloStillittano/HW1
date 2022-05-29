<?php
    session_start();
    //verifica accesso
    if(isset($_SESSION['username']) )
    {
      header("Location: home.php");
      exit;
    }

  if (!empty($_POST["username"]) && !empty($_POST["password"]))
  {
      $conn = mysqli_connect("localhost", "root", "", "gym") or die(mysqli_error($conn));
 
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      // Permette l'accesso tramite email o username in modo intercambiabile
      $searchField = filter_var($username, FILTER_VALIDATE_EMAIL) ? "email" : "username";
      // ID e Username per sessione, password per controllo
      $query = "SELECT id, username, password FROM users WHERE $searchField = '$username'";

      $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
      if (mysqli_num_rows($res) > 0) {

          $entry = mysqli_fetch_assoc($res);
          if (password_verify($_POST['password'], $entry['password'])) {
              $_SESSION["_ThePath_username"] = $entry['username'];
              $_SESSION["_ThePath_user_id"] = $entry['id'];
              header("Location: home.php");
              mysqli_free_result($res);
              mysqli_close($conn);
              exit;
          }
      }
      // Errore nel caso in cui username o password non siano verificati
      $error = "Username e/o password errati.";
  }
  else if (isset($_POST["username"]) || isset($_POST["password"])) {
      // Errore nel caso in cui solo uno dei due sia verificato
      $error = "Inserisci username e password.";
  }
?>

<html>
  <head>
    <link rel="stylesheet" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Path - Login</title>
  </head>

    <body>
      <div class="menu">
        <main>

             <img src="images/manubrio.png" alt="">
             <h2>|Login|</h2>
           <form name='form_login' method='post'>
             <div>
                <label>Username <input type='text' name='username' class="username"
                <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></label></br>
             </div>
             <div>
                <label>Password <input type='password' name='password' class="password"
                <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></label></br>
             </div>
             <div class="login"><input type='submit' value="Login" class="invio"></div>
            </form>
          <?php
            if (isset($error)) {
               echo "<span class='error'>$error</span>";
            }
          ?>
            <p>Sei nuovo? <a href="http://localhost/HW1/signup.php">Signup</a></p>
        </main>
      </div>
    </body>

</html>