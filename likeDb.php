<?php
    session_start();

    if(isset($_SESSION["_ThePath_username"])){
        $conn =mysqli_connect("localhost", "root", "", "gym") or die ("Errore: " .mysqli_connect_error());
        $query="SELECT * from likes where user='".$_SESSION["_ThePath_username"]"'"; 
        $esec=mysqli_query($conn,$query);
        if(mysqli_num_rows($esec) > 0){
            $json=true;
        }
        else{
            $json=false;
        }

        mysqli_free_result($esec);
        mysqli_close($conn);

        echo json_encode($json); 
    }
?>