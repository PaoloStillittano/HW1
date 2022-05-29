<?php
    //echo ($_GET["titolo"]);
    session_start();
    echo "INSERT INTO likes values('".$_SESSION["_ThePath_username"]."' ,'".$_GET['titolo']."' )";
    if(isset($_SESSION["_ThePath_username"])){
        $conn =mysqli_connect("localhost", "root", "", "gym") or die ("Errore: " .mysqli_connect_error());
    
        $liked="INSERT INTO likes values('".$_SESSION["_ThePath_username"]."' ,'".$_GET['titolo']."' ) ";
        mysqli_query($conn,$liked);

        //mysqli_free_result($like);
        mysqli_close($conn);
    }
?>