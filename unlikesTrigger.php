<?php
    session_start();
    //echo ($_GET["nome"]);
    if(isset($_SESSION["_ThePath_username"])){
        $conn =mysqli_connect("localhost", "root", "", "gym") or die ("Errore: " .mysqli_connect_error());
        
        $liked="DELETE from likes where user='".$_SESSION["_ThePath_username"]."' and post='".$_GET["titolo"]."' ";
        mysqli_query($conn,$liked);

        //mysqli_free_result($like);
       // echo ($_GET["nome"]);
        mysqli_close($conn);
    }

?>