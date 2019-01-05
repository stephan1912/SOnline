<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_POST["id"])){
    $conn = new mysqli('localhost', 'root', '1997', 'fsonline');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $idSerial = $_POST["id"];
    $idUser = 'null';
    $ip = $_SERVER['REMOTE_ADDR'];
    if(isset($_SESSION["id_user"])){
        $idUser = $_SESSION["id_user"];
    }
    $sql = "SELECT count(*) as nr from utilizator_serial where id_serial=".$idSerial." and ip='".$ip."'";
   
    if($idUser != 'null'){
        $sql = "SELECT count(*) as nr from utilizator_serial where id_serial=".$idSerial." and id_utilizator=".$idUser;
    }
    $result = $conn->query($sql);
    $total = 0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $total = $row['nr'];
            break;
        }
    }

    if($total > 0){
        echo 'bad';
    }
    else{
        $sql = "INSERT INTO utilizator_serial (id_utilizator, id_serial, ip) VALUES (".$idUser.", ".$idSerial.", '".$ip."')";
        
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $sql = "SELECT id_episod from episod_serial where id_serial=".$idSerial;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $insert = "INSERT INTO utilizator_episod (id_utilizator, id_serial, id_episod, ip, vizionat, id_us) 
                                Values(".$idUser.",".$idSerial.",".$row["id_episod"].", '".$ip."', 0, ".$last_id.")";
                    $conn->query($insert);
                }
            }
            echo $idUser != 'null' ? 'ok_logat' : 'ok';
        } else {
            echo 'bad1';
        }
    }
}
else{
    echo 'bad';
}
?>