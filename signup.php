<?php
    require_once 'credentials.php';

    if (checkCredentials()) {
      header("Location: home.php");
      exit;
    }   

  if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["nome"]) && 
  !empty($_POST["cognome"]) && !empty($_POST["confirm_password"]))
  {
    $error = array();
    $conn = mysqli_connect("localhost", "root", "", "gym") or die(mysqli_error($conn));

    # USERNAME
    // Controlla che l'username rispetti il pattern specificato
    if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
      $error[] = "Username non valido";
    } else {
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      // Cerco se l'username esiste già o se appartiene a una delle 3 parole chiave indicate
      $query = "SELECT username FROM users WHERE username = '$username'";
      $res = mysqli_query($conn, $query);
      if (mysqli_num_rows($res) > 0) {
            $error[] = "Username già in uso";
        }
    }
    #nome
    $nome=mysqli_real_escape_string($conn,$_POST["nome"]);
    if(!preg_match('/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', $nome)){ 
      $errore=true;
    }
    #cognome
    $cognome=mysqli_real_escape_string($conn,$_POST["cognome"]);
    if(!preg_match('/^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/', $cognome)){ 
      $errore=true;
    }
    # PASSWORD
    if (strlen($_POST["password"]) < 8) {
      $error[] = "Caratteri insufficienti";
    } 
    # CONFERMA PASSWORD
    if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
      $error[] = "Le password non coincidono";
  }
    # EMAIL
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error[] = "Email non valida";
    } else {
      $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
        $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
      if (mysqli_num_rows($res) > 0) {
        $error[] = "Email già in uso";
      }
    }

    # REGISTRAZIONE NEL DATABASE
    if (count($error) == 0) {
      $name = mysqli_real_escape_string($conn, $_POST['nome']);
      $surname = mysqli_real_escape_string($conn, $_POST['cognome']);

      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $password = password_hash($password, PASSWORD_BCRYPT);

      $query = "INSERT INTO users(username, nome, cognome, email, password) VALUES('$username', '$nome', '$congome', '$email', '$password')";
      
      if (mysqli_query($conn, $query)) {
          $_SESSION["_ThePath_username"] = $_POST["username"];
          $_SESSION["_ThePath_user_id"] = mysqli_insert_id($conn);
          mysqli_close($conn);
          header("Location: home.php");
          exit;
      } else {
          $error[] = "Errore di connessione al Database";
      }
    }

  mysqli_close($conn);
  }
?>

<html>
  <head>
    <link rel="stylesheet" href="css/signup.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='./js/signup.js' defer></script>

    <title>The Path - Signup</title>
  </head>

    <body>
      <div class="menu">
        <main>
             <img src="images/manubrio.png" alt="">
             <h2>|Signup|</h2>
          <form name='form_signup' method='post'>
            <div>
              <label>Nome <input type='text' name='nome' class="nome"
              <?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?>></label>
              <span id="nome_span">Inserisci un nome valido</span></br>
            </div>
            <div>
              <label>Cognome <input type='text' name='cognome' class="cognome"
              <?php if(isset($_POST["cognome"])){echo "value=".$_POST["cognome"];} ?>></label>
              <span id="cognome_span">Inserisci un cognome valido</span></br>
            </div>
            <div>
              <label>Username <input type='text' name='username' class="username"
              <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></label>
              <span id="username_span">Inserisci un valido username</span></br>
            </div>
            <div>
              <label>E-mail <input type='text' name='email' class="email"
              <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>></label>
              <span id="email_span"> Inserisci la tua email</span></br>
            </div>
            <div>
              <label>Password <input type='password' name='password' class="password"
              <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></label>
              <span id="password_span">Inserisci una password valida</span></br>
            </div>
            <div>
              <label> Conferma Password <input type='password' name='confirm_password' class="confirm_password"
              <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>></label>
              <span id="confirm_password_span">Le password non coincidono</span>
            <div class="submit">
              <label>&nbsp;<input type='submit' value="Signup" id="invio"></label></br>
            </div>
          </form>
           <div><p>Sei già registrato? <a href="login.php"> Login</a></p></div>
        </main>
      </div>
    </body>
</html>