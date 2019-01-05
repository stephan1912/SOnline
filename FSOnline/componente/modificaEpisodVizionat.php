<?php

if (isset($_SERVER['REQUEST_METHOD']))
{
  switch ($_SERVER['REQUEST_METHOD'])
  {
    case 'PUT':
        if(isset($_GET['id']) && isset($_GET['vizionat'])){
            $id = $_GET['id'];
            $vizionat = $_GET['vizionat'];
            $conn = new mysqli('localhost', 'root', '1997', 'fsonline');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            $sql = 'update utilizator_episod set vizionat='.$vizionat.' where id='.$id;
            if($conn->query($sql) == TRUE){
                echo 'good';
            }
            else echo 'b2';
        }
      break;
  }
}
?>