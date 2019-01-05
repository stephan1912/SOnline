<div class="slideshow-container">
<?php
$conn = new mysqli('localhost', 'root', '1997', 'fsonline');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "select count(*) as nr from seriale";
$result = $conn->query($sql);
$nrOfShows = 0;
$totalSeriale = 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $totalSeriale = $row['nr'];
        break;
    }
}
$randNrs = '('.rand(1, $totalSeriale).','.rand(1, $totalSeriale).','.rand(1, $totalSeriale).','.rand(1, $totalSeriale).','.rand(1, $totalSeriale).')';
$sql = "select imagine, descriere, nume, an, durata, gen, episoade, sezoane from seriale where id in ".$randNrs;
$result = $conn->query($sql);
$nrOfShows = 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nrOfShows++;
        ?>
        <div class="slideshow-slide fade">
            <div class="slideshow-box">
                <figure class="slideshow-imagine">
                    <img src="<?=$row["imagine"]?>" alt="<?=$row["nume"]?>" />
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
        </div>
        <?php
    }
} else {
}
$conn->close();

?>
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>

<div style="text-align:center">
    <?php 
    for($i = 1; $i <= $nrOfShows; $i++){
       // echo '<span class="dot" onclick="currentSlide('.$i.')"></span> ';
    }
    ?>
</div>
<script src="js/slideshow.js"></script>