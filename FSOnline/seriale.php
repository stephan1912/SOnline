<!DOCTYPE html>
<html lang="ro">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/seriale.css">
        <title>SOnline</title>
    </head>
    <body>
        <?php 
            $navbar = array(0, 1, 0, 0);
            require 'componente/navbar.php';
            $conn = new mysqli('localhost', 'root', '1997', 'fsonline');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            $cauta = '';
            if(isset($_GET["cauta"])){
                $cauta = $_GET["cauta"];
                $sql = "SELECT count(*) as nr from seriale where nume like '%".$cauta."%'";
                $result = $conn->query($sql);
                $totalSeriale = 0;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $totalSeriale = $row['nr'];
                        break;
                    }
                }
                $nrPagini = round($totalSeriale / 30);
                $matchFound = ( isset($_GET["pagina"]) && trim($_GET["pagina"]) <= $nrPagini );
                $pagina = $matchFound ? trim ($_GET["pagina"]) : 1;
            }
            else{
                $sql = "SELECT count(*) as nr from seriale";
                $result = $conn->query($sql);
                $totalSeriale = 0;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $totalSeriale = $row['nr'];
                        break;
                    }
                }
                $nrPagini = round($totalSeriale / 30);
                $matchFound = ( isset($_GET["pagina"]) && trim($_GET["pagina"]) <= $nrPagini );
                $pagina = $matchFound ? trim ($_GET["pagina"]) : 1;
            }
        ?>

        <div id="pageContent" class="contentBox">
            <div class="searchContainer">
                <input type="text" id="inputSearch" placeholder="Cauta un serial" value="<?=$cauta?>"/>
                <button id="buttonSearch">Cauta</button>
            </div>
            <div class="gridSeriale">
            <?php
            
            if(isset($_GET["cauta"])){
                $start = ($pagina - 1) * 30;
                $end = ($pagina) * 30;
                $sql = "select id, imagine, nume, an from seriale where nume like '%".$cauta."%' limit ".$start.",".$end.";";
                
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="boxSerial" onclick="arataInfoSerial('.$row['id'].')">
                                <figure class="imagineSerial">
                                    <img src="'.$row['imagine'].'" alt="'.$row['nume'].'"/>
                                    <figcaption class="textSerial">'.$row['nume'].'</figcaption>
                                </figure>
                            </div>';

                    }
                }
            }
            else{
                $sql = "select id, imagine, nume, an from seriale where (".$pagina."-1)*30 < id AND id <= ".$pagina."*30;";
            
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="boxSerial" onclick="arataInfoSerial('.$row['id'].')">
                                <figure class="imagineSerial">
                                    <img src="'.$row['imagine'].'"  alt="'.$row['nume'].'"/>
                                    <figcaption class="textSerial">'.$row['nume'].'</figcaption>
                                </figure>
                            </div>';

                    }
                }
            }
            ?>
            </div>
            <footer class="containerNrPagina1">
                <div class="containerNrPagina">
                <?php
                    if(isset($_GET["cauta"])){
                        if($nrPagini > 1){
                        ?>
                        <a href="seriale.php?pagina=1&cauta=<?=$cauta?>"><<</a>
                        <?php if($pagina >= 3){?>
                        <a href="seriale.php?pagina=<?=$pagina - 2?>&cauta=<?=$cauta?>"><?=$pagina - 2?></a>
                        <?php }?>
                        <?php if($pagina >= 2){?>
                        <a href="seriale.php?pagina=<?=$pagina - 1?>&cauta=<?=$cauta?>"><?=$pagina - 1?></a>
                        <?php }?>
                        <a href="seriale.php?pagina=<?=$pagina?>&cauta=<?=$cauta?>" class="paginaCurenta"><?=$pagina?></a>
                        <?php if($pagina <= $nrPagini - 1){?>
                        <a href="seriale.php?pagina=<?=$pagina + 1?>&cauta=<?=$cauta?>"><?=$pagina + 1?></a>
                        <?php }?>
                        <?php if($pagina <= $nrPagini - 2){?>
                        <a href="seriale.php?pagina=<?=$pagina + 2?>&cauta=<?=$cauta?>"><?=$pagina + 2?></a>
                        <?php }?>
                        <a href="seriale.php?pagina=<?=$nrPagini?>&cauta=<?=$cauta?>">>></a>
                <?php
                        }
                    }
                    else{
                ?>
                        <a href="seriale.php?pagina=1"><<</a>
                        <?php if($pagina >= 3){?>
                        <a href="seriale.php?pagina=<?=$pagina - 2?>"><?=$pagina - 2?></a>
                        <?php }?>
                        <?php if($pagina >= 2){?>
                        <a href="seriale.php?pagina=<?=$pagina - 1?>"><?=$pagina - 1?></a>
                        <?php }?>
                        <a href="seriale.php?pagina=<?=$pagina?>" class="paginaCurenta"><?=$pagina?></a>
                        <?php if($pagina <= $nrPagini - 1){?>
                        <a href="seriale.php?pagina=<?=$pagina + 1?>"><?=$pagina + 1?></a>
                        <?php }?>
                        <?php if($pagina <= $nrPagini - 2){?>
                        <a href="seriale.php?pagina=<?=$pagina + 2?>"><?=$pagina + 2?></a>
                        <?php }?>
                        <a href="seriale.php?pagina=<?=$nrPagini?>">>></a>
                <?php
                    }
                ?>
                </div>
            </footer>
        </div>
        <script src="js/seriale.js"></script>
    </body>
</html>