<!DOCTYPE html>
<html lang="ro">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/slideshow.css">
        <link rel="stylesheet" href="css/seriale.css">
        <link rel="stylesheet" href="css/listamea.css">
        <title>SOnline</title>
    </head>
    <body>
        <?php 
            $navbar = array(0, 0, 1, 0);
            require 'componente/navbar.php';
            $conn = new mysqli('localhost', 'root', '1997', 'fsonline');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            $ip = $_SERVER['REMOTE_ADDR'];
            if(!isset($_GET['serial'])){
                $sql = "SELECT count(*) as nr from utilizator_serial where ip='".$ip."'";
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
            ?>

            <div id="pageContent" class="contentBox">
                <div class="gridSeriale">
                <?php
                    $start = ($pagina - 1) * 30;
                    $end = ($pagina) * 30;
                    $sql = "select s.id, s.imagine, s.nume, s.an, us.id as idReg from seriale s, utilizator_serial us where 
                    s.id = us.id_serial and us.ip = '".$ip."'  
                    limit ".$start.",".$end.";";
                    if(isset($_SESSION['id_user'])){
                        $sql = "select s.id, s.imagine, s.nume, s.an, us.id as idReg from seriale s, utilizator_serial us where 
                                s.id = us.id_serial and us.id_utilizator = ".$_SESSION["id_user"]."  
                                limit ".$start.",".$end.";";
                    }
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="boxSerial" onclick="arataModalSerial('.$row['idReg'].', \''.$row['nume'].'\', this)">
                                    <figure class="imagineSerial">
                                    <img src="'.$row['imagine'].'"  alt="'.$row['nume'].'"/>
                                    <figcaption class="textSerial">'.$row['nume'].'</figcaption>
                                    </figure>
                                </div>';

                        }
                    }
                ?>
                </div>
                <footer class="containerNrPagina1">
                    <div class="containerNrPagina">
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
                    </div>
                </footer>

            
            
            <?php
            }
            else{
                echo '<div id="pageContent" class="contentBox">';
                $idSerial = $_GET['serial'];
                $sql = 'select id_serial from utilizator_serial where id='.$idSerial;
                $result = $conn->query($sql);
                $nrOfShows = 0;
                $serialID = '';
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $serialID = $row['id_serial'];
                        break;
                    }
                }
                $sql = "select imagine, descriere, nume, an, durata, gen, episoade, sezoane from seriale where id=".$serialID;
                
                $result = $conn->query($sql);
                $nrOfShows = 0;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $nrOfShows++;
                        ?>
                            <div class="slideshow-box" >
                                <figure class="slideshow-imagine">
                                    <img src="<?=$row["imagine"]?>" alt="<?=$row["nume"]?>"/>
                                </figure>
                                <div class="slideshow-descriere">
                                    <h2><?=$row["nume"]?></h2>
                                    <p><?=$row["descriere"]?></p>
                                </div>
                                <div class="slideshow-info1">
                                    <span>
                                        <b>Nume: </b>
                                        <span><?=$row["nume"]?></span>
                                    <span> <br>
                                    <span>
                                        <b>Sezoane: </b>
                                        <span><?=$row["sezoane"]?></span>
                                    <span> <br>
                                    <span>
                                        <b>Episoade: </b>
                                        <span><?=$row["episoade"]?></span>
                                    <span>
                                </div>
                                <div class="slideshow-info2">
                                    <span>
                                        <b>An: </b>
                                        <span><?=$row["an"]?></span>
                                    <span> <br>
                                    <span>
                                        <b>Durata: </b>
                                        <span><?=$row["durata"]?></span>
                                    <span> <br>
                                    <span>
                                        <b>Gen: </b>
                                        <span><?=$row["gen"]?></span>
                                    <span>
                                </div>
                            </div>
                        <?php
                    }
                } 
                
                $idSerial = $_GET['serial'];
                $sql = "select id,vizionat,id_episod from utilizator_episod where id_us=".$idSerial." and ip='".$ip."'";
                if(isset($_SESSION['id_user'])){
                    $sql = "select id,vizionat,id_episod from utilizator_episod where id_us=".$idSerial." and id_utilizator=".$_SESSION['id_user'];
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $sezoane = array();
                    while($row = $result->fetch_assoc()) {
                        $getEp = "select id, nume, sezon, data, durata, numar from episoade where id=".$row['id_episod'];
                        $r2 = $conn->query($getEp);
                        if ($r2->num_rows > 0) {
                            while($row2 = $r2->fetch_assoc()) {
                                if (array_key_exists($row2['sezon'], $sezoane)) {
                                    array_push($sezoane[$row2['sezon']], [
                                        "nume" => $row2['nume'],
                                        "data" => $row2['data'],
                                        "durata" => $row2["durata"],
                                        "numar" => $row2["numar"],
                                        "idReg" => $row["id"],
                                        "vizionat" => $row["vizionat"]
                                    ]);
                                }
                                else{
                                    $sezoane[$row2['sezon']] = array([
                                    "nume" => $row2['nume'],
                                    "data" => $row2['data'],
                                    "durata" => $row2["durata"],
                                    "numar" => $row2["numar"],
                                    "idReg" => $row["id"],
                                    "vizionat" => $row["vizionat"]
                                    ]);
                                }
                            }
                        }
                    }
                    echo "<ul>";
                    $nrSezon = 1;


                    foreach ($sezoane as $key => $value) {
                        echo "<li class='li-sezon'>
                              <section>
                              <h2 style='display:inline-block' >".$key."</h2>";
                        echo "<button onclick='collapseLiSezon(\"".$nrSezon."\", this)' class='collapseBtn'>
                        ".($nrSezon==1?'-':'+')."</button>";
                        
                        echo "<div id='tabelSezon_".$nrSezon."' style='display: ".($nrSezon==1?'table':'none').";width:100%;'>
                                <table class='table-serial'><tbody>";
                        echo "<tr>
                                <th>Numar</th>
                                <th>Denumire</th>
                                <th class='hiddenColumn'>Data</th>
                                <th class='hiddenColumn'>Durata</th>
                                <th>Vizionat</th>
                            </tr>";
                            $nrSezon++;
                        foreach ($value as $val) {
                            echo "<tr>
                            <td>".$val["numar"]."</td>
                            <td>".$val["nume"]."</td>
                            <td class='hiddenColumn'>".$val["data"]."</td>
                            <td class='hiddenColumn'>".$val["durata"]."</td>";
                            if($val["vizionat"] == 0){
                                echo '<td><input type="checkbox" onclick="checkBoxClick('.$val['idReg'].', this)"/></td>';
                            }
                            else{
                                echo '<td><input type="checkbox" checked onclick="checkBoxClick('.$val['idReg'].', this)"/></td>';
                            }
                            echo "</tr>";
                        }
                        echo '</tbody></table></div></section></li>';
                    }
                    echo '</ul>';
                }
                echo '</div>';
            }
            ?>
        </div>
        <script src="js/listamea.js"></script>
    </body>
</html>