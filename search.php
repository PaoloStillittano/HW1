<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Open+Sans:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="css/search.css">
        <script src="js/spotify.js" defer="true"></script>
        <title>The Path - Search</title>
    </head>

    <body>
        <section>
            <div class="menu">
                <p><a href="Home.php">Home</a></p></br>
                <p><a href='logout.php'> Esci dalla sessione</a></p></br>
            </div>
                <form id="Spotify">
                    <p>
                        | Cerca la tua canzone preferita |</br>
                        | Riproducila durante i tuoi allenamenti! |</br>
                    </p>
                    <input type="text" id="song" class="ricerca"/></br>
                    <input type="submit" value="cerca" class="button">
                    <div id="view"></div>
                </form>
        </section>
    </body>
</html>