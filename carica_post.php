<?php
    session_start();
    //  echo ($_SESSION["_ThePath_username"]);
    
    if(isset($_SESSION["_ThePath_username"])){
        
        $user=$_SESSION["_ThePath_username"];
        $conn =mysqli_connect("localhost", "root", "", "gym") or die ("Errore: " .mysqli_connect_error());
        $query="SELECT *,
         EXISTS(SELECT * FROM likes WHERE post = Posts.titolo AND user = '$user') as liked from posts ";
        $esec=mysqli_query($conn,$query);
        $json=array();
        while($row=mysqli_fetch_assoc($esec)){
            array_push($json,$row); //aggiungo riga da passare
        }
        mysqli_free_result($esec);
        mysqli_close($conn);
        echo json_encode($json); //restituisco un json
    }
?>