<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>


<nav class="navbar" id="navigationBar">
  <span class="navbar-toggle" id="js-navbar-toggle">
    <i class="fa fa-bars"></i>
  </span>
  <a href="#" class="logo">SOnline</a>
  <ul class="main-nav" id="js-menu">
    <li>
      <a href="index.php" <?=$navbar[0]==1?'class="tabActiv"':'class="nav-links"'?>>Acasa</a>
    </li>

    <li>
      <a href="seriale.php" <?=$navbar[1]==1?'class="tabActiv"':'class="nav-links"'?>>Seriale</a>
    </li>

    <li>
      <a href="listamea.php" <?=$navbar[2]==1?'class="tabActiv"':'class="nav-links"'?>>Lista mea</a>
    </li>
    <?php
    if(isset($_SESSION["id_user"])){
    ?>
      <li>
        <a href="index.php?logout=1" <?=$navbar[3]==1?'class="tabActiv"':'class="nav-links"'?>>
        Bun venit <?=$_SESSION["nume_user"]?> | Log out
      </a>
    </li>
    <?php 
    }
    else{
    ?>
      <li>
        <a href="login.php" <?=$navbar[3]==1?'class="tabActiv"':'class="nav-links"'?>>Intra in Cont</a>
      </li>
    <?php
    }
    ?>
  </ul>
<script src="js/necesare.js"></script>
</nav>
