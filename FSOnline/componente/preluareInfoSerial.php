<?php
header ('Content-type: text/html; charset=iso8859-15');
$conn = new mysqli('localhost', 'root', '1997', 'fsonline');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "SELECT id, nume as num, descriere as descr, episoade, sezoane, gen, an from seriale where id=".$id;
    $result = $conn->query($sql);
    $totalSeriale = 0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $obj = new stdClass;
            $obj->id = $row['id'];
            $obj->nume = utf8_encode($row['num']);
            $obj->descriere = utf8_encode($row['descr']);
            $obj->episoade = $row['episoade'];
            $obj->sezoane = $row['sezoane'];
            $obj->gen = utf8_encode($row['gen']);
            $obj->an = $row['an'];
            echo json_encode($obj);
            break;
        }
    }
    else{
        echo 'null';
    }
}
else{
    echo 'null';
}
?>