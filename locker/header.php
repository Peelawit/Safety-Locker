<?
session_start();
ini_set('display_errors', 0);
?>
<header class="app-bar fixed-top orange Kanit" data-role="appbar">
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <div class="container">
        <img class="app-bar-element" src="images/nanotec.png" style="height: 55px; margin-right: 10px;">
		<a href="index.php"><div align="right" style="color:#fff;"><?php echo $_SESSION['empid']." ".$_SESSION["empname"]; ?></div>
        <div align="right" class="uilogout">Logout</div></a>
        <!-- <ul class="app-bar-menu small-dropdown logout">
            <li>
                <a href="#" class="dropdown-toggle"><h2>
                  <?php echo $_SESSION['empid']." ".$_SESSION["empname"]; ?>
                </h2></a>
                <ul class="d-menu" id="non" data-role="dropdown" data-no-close="true">
                  <li>
                        <div class=""><a href="index.php">Logout</a></div>
                  </li>
                </ul>
            </li>
        </ul>-->

<!--<ul class="app-bar-menu small-dropdown">
  <li>
<div class="logout dropdown-toggle">
  <h2>
    <?php
    session_start();
    echo $_SESSION['empid'];
    ?>
  </h2>
</div>
<ul class="d=menu" data-role="dropdown" data-no-close="true">
  <li>test</li>
</ul>
</li>
</ul>-->
        <span class="app-bar-pull"></span>

    </div>
</header>
