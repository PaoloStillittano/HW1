<?php
    /********************************************************
       Controlla che l'utente sia già autenticato, per non 
       dover chiedere il login ad ogni volta               
    *********************************************************/
    session_start();

    function checkCredentials() {
        // Se esiste già una sessione, la ritorno, altrimenti ritorno 0
        if(isset($_SESSION['_ThePath_user_id'])) {
            return $_SESSION['_ThePath_user_id'];
        } else 
            return 0;
    }
?>