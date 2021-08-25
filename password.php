<?php 
session_start();
if(isset($_SESSION['user']) && isset($_SESSION["password"])){
	define("MYHOST","localhost");
define("MYUSER","root");
define("MYPASS","");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	 <script src="https://kit.fontawesome.com/7a1877b7ec.js" crossorigin="anonymous"></script>
	 <link rel="stylesheet" type="text/css" href="password.css">
	<title></title>
</head>
<body>
	<div class="barre">systeme de gestion de visiteurs</div>
	<div id="mynavbar" class="navbar" >
		<a href="dash.php"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;&nbsp;Dashboard</a>
		<a href="division.php"><i class="fas fa-building"></i>&nbsp;&nbsp;&nbsp;Division</a>
		<a href="visitor.php"><i class="fas fa-hospital-user"></i>&nbsp;&nbsp;&nbsp;Visiteur</a>
		<a href="profil.php"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;&nbsp;Profile</a>
		<a href="password.php" id="pwd"><i class="fas fa-key"></i>&nbsp;&nbsp;&nbsp;Changer mot de passe</a>
		<a href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;Déconnexion</a>
	</div>
	<form method ="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
	<table border="1"  width="100%">
	
		
			<tr style="background-color: #F7F6F6;" >
				<td height= "10px"><p>Changer le mot de passe</p></td>
			</tr>

			<tr>
				<td height= "300px"><label> Actuel</label><input type="password" size="50" name="old" style="margin-left: 88px;">
					<br>
					
					<label>Nouveau </label><input type="password" size="50" name="new" style="margin-left: 65px;"><br>
					<label>Confirmer</label><input type="password" size="50" name="confirm" style="margin-left: 54px;"><br>
				
				<center><input type="submit" value="sauvegarder" class="btn" ></center></td>
			</tr>
			
		</table>
	</form>
	<?php

$base="visitor";
$idcom=mysqli_connect(MYHOST,MYUSER,MYPASS);
$idbase=mysqli_select_db($idcom,$base);

		if(!empty($_POST['old']) && !empty($_POST['new']) && !empty($_POST['confirm'])){
			$actuel=$_POST['old'];
			$nouveau=$_POST['new'];
			$confirme=$_POST['confirm'];
			if($confirme == $nouveau ){

			$requete="UPDATE `utilisateur` SET `password`='$nouveau' WHERE password like '$actuel' ";
			$result=mysqli_query($idcom,$requete) ;
			if (!$result) {
				echo "<script type=\"text/javascript\">alert(\"Erreur . Veuillez repeter  \")</script>";
				echo "<script type=\"text/javascript\">window.location=\"profil.php\"</script>";
				
			}
			else{
				echo "<script type=\"text/javascript\">alert(\"Enregistrer  \")</script>";
				echo "<script type=\"text/javascript\">window.location=\"logout.php\"</script>";}
			}
			else{
				echo "<script type=\"text/javascript\">alert(\"Erreur . Veuillez repeter  \")</script>";
				echo "<script type=\"text/javascript\">window.location=\"profil.php\"</script>";
			}
		}


	?>
</body>
<?php
}
?>
</html>
