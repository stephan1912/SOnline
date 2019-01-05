<?php

if (isset($_SERVER['REQUEST_METHOD']))
{
  switch ($_SERVER['REQUEST_METHOD'])
  {
    case 'DELETE':
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $conn = new mysqli('localhost', 'root', '1997', 'fsonline');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            $sql = 'delete from utilizator_episod where id_us='.$id;
            if($conn->query($sql) == TRUE){
                $sql = 'delete from utilizator_serial where id='.$id;
                if($conn->query($sql) == TRUE){
                    echo 'good';
                }
                else echo 'b1';
            }
            else echo 'b2';
        }
      break;
  }
}
?>