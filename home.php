<?php 
    require_once 'credentials.php';
    if (!$userid = checkCredentials()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <?php 
        $conn = mysqli_connect("localhost", "root", "", "gym");
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   
    ?>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Open+Sans:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="css/home.css">
        <script src="js/posts.js" defer="true"></script>
        
        <title>The Path - Home</title>
    </head>
    <body>
        <header>
            <h1><strong>|CrossFit: The Path|</strong></br></h1>
        </header>
      
        <section>
            <div class="menu">
                <h2>Benvenuto <?php echo $userinfo['username']?>!</h2>
                <p><a href="search.php">Search</a></p></br>
                <p><a href='logout.php'> Esci dalla sessione</a></p></br>
            </div>
            <h1>I nostri corsi !</h1>
             <div class='posts'>
                
             </div>
        </section>
    </body>

    <footer>
        <h1>Corso di Web Programming 2022</h1>
        <p>Paolo Stillittano - MATRICOLA: 1000001637</p>
    </footer>
</html>