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
	<link rel="stylesheet" type="text/css" href="profil.css">
	 <script src="https://kit.fontawesome.com/7a1877b7ec.js" crossorigin="anonymous"></script>

	<title></title>
</head>
<body>
	<div class="barre">systeme de gestion de visiteurs</div>
	<div id="mynavbar" class="navbar" >
		<a href="dash.php"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;&nbsp;Dashboard</a>
		
		<a href="division.php"><i class="fas fa-building"></i>&nbsp;&nbsp;&nbsp;Division</a>
		<a href="visitor.php"><i class="fas fa-hospital-user"></i>&nbsp;&nbsp;&nbsp;Visiteur</a>
		<a href="profil.php" id="profile"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;&nbsp;Profile</a>
		<a href="password.php"><i class="fas fa-key"></i>&nbsp;&nbsp;&nbsp;Changer mot de passe</a>
		<a href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;Déconnexion</a>
	</div>
	<form method ="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
	<table border="1"  width="100%">
	
		
			<tr style="background-color: #F7F6F6;" >
				<td height= "10px"><p>profile</p></td>
			</tr>

			<tr>
				<td height= "250px"><label>Nom de Compte Actuel</label><input type="text" size="40" name="actuel" 
					<?php
					if(isset($_SESSION['user']))
						echo "value =".$_SESSION['user']."";
					?>





					><br>
				<label>Nouveau Nom de Compte </label><input type="text" size="40" name="nouveau" style="margin-left: 47px;"><br>
				<center><input type="submit" value="sauvegarder" class="btn" ></center></td>
			</tr>
			
		</table>
	</form>
	<?php

$base="visitor";
$idcom=mysqli_connect(MYHOST,MYUSER,MYPASS);
$idbase=mysqli_select_db($idcom,$base);

		if(!empty($_POST['actuel']) && !empty($_POST['nouveau'])){
			$actuel=$_POST['actuel'];
			$nouveau=$_POST['nouveau'];

			$requete="UPDATE `utilisateur` SET `cin`='$nouveau' WHERE cin like '$actuel' ";
			$result=mysqli_query($idcom,$requete) ;
			if (!$result) {
				echo "<script type=\"text/javascript\">alert(\"Erreur . Veuillez repeter  \")</script>";
				echo "<script type=\"text/javascript\">window.location=\"profil.php\"</script>";
				
			}
			else{
				echo "<script type=\"text/javascript\">alert(\"Enregistrer  \")</script>";
				echo "<script type=\"text/javascript\">window.location=\"logout.php\"</script>";}
		}


	?>

</body>
<?php
}
?>
</html>