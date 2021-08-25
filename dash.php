<?php 
session_start();
if(isset($_SESSION['user']) && isset($_SESSION["password"])){

define("MYHOST","localhost");
define("MYUSER","root");
define("MYPASS","");
$base="visitor";
$idcom=mysqli_connect(MYHOST,MYUSER,MYPASS);
$idbase=mysqli_select_db($idcom,$base);
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	  <script src="https://kit.fontawesome.com/7a1877b7ec.js" crossorigin="anonymous"></script>
	  <link rel="stylesheet" type="text/css" href="dash.css">
	<title></title>
</head>
<body>
	<div class="barre">systeme de gestion de visiteurs</div>
	<div id="mynavbar" class="navbar" >
		<a href="dash.php" id="dash"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;&nbsp;Dashboard</a>
		
		<a href="division.php"><i class="fas fa-building"></i>&nbsp;&nbsp;&nbsp;Division</a>
		<a href="visitor.php"><i class="fas fa-hospital-user"></i>&nbsp;&nbsp;&nbsp;Visiteur</a>
		<a href="profil.php"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;&nbsp;Profile</a>
		<a href="password.php"><i class="fas fa-key"></i>&nbsp;&nbsp;&nbsp;Changer mot de passe</a>
		<a href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;Déconnexion</a>
	</div>
	<div class="stat">
	<div class="jour"><p>visiteur total ce jour</p><hr>
			<?php 

	$requete2="SELECT * FROM `visiteur` WHERE datein < ADDDATE(CURRENT_DATE(), INTERVAL 1 DAY) AND datein > ADDDATE(CURRENT_DATE(), INTERVAL -1 DAY)";

$result2=mysqli_query($idcom,$requete2) ;
$num2=mysqli_num_rows($result2);
	echo $num2;
			?>
	</div>
	<div class="semaine"><p>visiteur total  cette semaine</p><hr>
		<?php 

	$requete3="SELECT * FROM `visiteur` WHERE datein <= ADDDATE(CURRENT_DATE(), INTERVAL 7-WEEKDAY(CURRENT_DATE()) DAY) AND datein >= ADDDATE(CURRENT_DATE(), INTERVAL -WEEKDAY(CURRENT_DATE()) DAY)";

$result3=mysqli_query($idcom,$requete3) ;
$num3=mysqli_num_rows($result3);
	echo $num3;
			?>
	</div>
	<div class="mois"><p>visiteur total ce mois</p><hr>
<?php 

	$requete="SELECT * FROM `visiteur` WHERE datein <= ADDDATE(LAST_DAY(CURRENT_DATE()), INTERVAL 1 DAY) AND datein > LAST_DAY(ADDDATE(CURRENT_DATE(), INTERVAL -1 MONTH))";
  
$result=mysqli_query($idcom,$requete) ;
$num=mysqli_num_rows($result);
	echo $num;
			?>
		
	</div>
</div>
	
</body>
<?php
}
?>
</html>