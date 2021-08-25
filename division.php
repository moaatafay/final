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
	 <link rel="stylesheet" type="text/css" href="div.css">
	 
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="container" id="blur">
	<div class="barre">systeme de gestion de visiteurs</div>
		<div id="mynavbar" class="navbar" >
			<a href="dash.php"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;&nbsp;Dashboard</a>
			
			<a href="division.php" id="divv"><i class="fas fa-building"></i>&nbsp;&nbsp;&nbsp;Division</a>
			<a href="visitor.php" ><i class="fas fa-hospital-user"></i>&nbsp;&nbsp;&nbsp;Visiteur</a>
			<a href="profil.php"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;&nbsp;Profile</a>
			<a href="password.php" ><i class="fas fa-key"></i>&nbsp;&nbsp;&nbsp;Changer mot de passe</a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;Déconnexion</a>
	</div>
	
	<div class="header">
		<div style="background-color: #F7F6F6;height: 50px ;border:1px solid black ; height: 60px;margin-right: 10px;" >
				<p>Divisions</p>
				<button type="button" class="add" onclick="toggle()"><i class="fas fa-plus-circle"></i></button > </div>
			
			<div class="search"><form method ="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
				<input type="text" size="20" name="cherche" 
				<?php
					if(!empty($_POST['cherche'])){
						$valeur=$_POST['cherche'];
						echo " value=".$valeur."";}
					?>>
				<input type="submit" value="chercher" name="found"></form></div>
			<table  id="visiteur">
				<tr>
					<th>nom</th>
					<th>visiteur max</th>
					<th>date de creation</th>
					<th>Statut</th>
					<th>Action</th>
					
				</tr>
				<form method ="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
				<?php 
						$base="visitor";
						$idcom=mysqli_connect(MYHOST,MYUSER,MYPASS);
						$idbase=mysqli_select_db($idcom,$base);
						if( !empty($_POST['cherche']) && !empty($_POST['found']) ){
							$lol=mysqli_escape_string($idcom,$_POST['cherche']);
								$requete2= "SELECT * FROM divisiontable WHERE divname='$lol' ORDER BY datecreation DESC";
								$result2=mysqli_query($idcom,$requete2);
								$num=mysqli_num_rows($result2);
								if($num==0){
									echo "<tr>";
									echo "<td COLSPAN=5><center>aucune division avec ce nom là</center></td>";
									echo "</tr>";
								}
								else{
								while($tab=mysqli_fetch_row($result2)){	
									
										
									
						
					echo "<tr>";
					echo "<td>".$tab[1]."</td>";
					echo "<td>".$tab[2]."</td>";
					echo "<td>".$tab[3]."</td>";
					$reqq="SELECT * FROM visiteur where division='$tab[1]' AND dateout IS NULL ";
					$ress=mysqli_query($idcom,$reqq);
					$numero=mysqli_num_rows($ress);
					if($numero==$tab[2])
					echo "<td><center><label style=\"background-color: #dc3545;color:white;padding-left:15px;padding-right:15px;padding-top:7px;padding-bottom:7px;border-radius: 50%\">full</label></center></td>";
				else
					 echo "<td><center><label style=\"background-color: #198754;color:white;padding:7px;border-radius: 50%\">empty</label></center></td>";
					echo"<td> <center><button type=\"submit\" class=\"effet\" name=".$tab[1]."  value=".$tab[1]."><i class=\"fas fa-trash\"></i></button> </center></td>";
					if(isset($_POST[$tab[1]])    ){
						
						$requete3="DELETE FROM `divisiontable` WHERE divname like '$tab[1]'";
						$result3=mysqli_query($idcom,$requete3) ;
						echo "<script type=\"text/javascript\">window.location=\"division.php\"</script>";
						

					}
					echo "</tr>";
				
				
					}}
						}

							else{
						
						
						$requete2= 'SELECT * FROM `divisiontable` ORDER BY datecreation DESC'  ;
						$result2=mysqli_query($idcom,$requete2);

						while($tab=mysqli_fetch_row($result2)){			
					echo "<tr>";
					echo "<td>".$tab[1]."</td>";
					echo "<td>".$tab[2]."</td>";
					echo "<td>".$tab[3]."</td>";
					$reqq="SELECT * FROM visiteur where division='$tab[1]' AND dateout IS NULL ";
					$ress=mysqli_query($idcom,$reqq);
					$numero=mysqli_num_rows($ress);
					if($numero==$tab[2])
					  echo "<td><center><label style=\"background-color: #dc3545;color:white;padding-left:15px;padding-right:15px;padding-top:7px;padding-bottom:7px;border-radius: 50%\">full</label></center></td>";
				else
					 echo "<td><center><label style=\"background-color: #198754;color:white;padding:7px;border-radius: 50%\">empty</label></center></td>";

					echo"<td> <center><button type=\"submit\" class=\"effet\"  name=".$tab[1]." value=".$tab[1]." ><i class=\"fas fa-trash\"></i></button></center> </td>";

					if(isset($_POST[$tab[1]])    ){
						
						$requete3="DELETE FROM `divisiontable` WHERE divname like '$tab[1]'";
						$result3=mysqli_query($idcom,$requete3) ;
						echo "<script type=\"text/javascript\">window.location=\"division.php\"</script>";
						
					}
					echo "</tr>";
				}}
				
			
				?>
			</form>
				
			</table>
		</div>
	</div>
	<div id="popup">
		<form method ="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<br><label>Ajouter une division</label><button type="button" onclick="toggle()"><i class="fas fa-times"></i></button>

		<hr style="margin-top:20px">
		<table width="100%" >
			<tr><td >nom</td><td ><input type="text" name="nom" size="40" required></td></tr>
			<tr><td >visiteur max</td><td ><input type="text" name="maximum" size="40" required></td></tr>
			<tr><td ></td><td style="text-align: right;"><input type="submit" value="sauvegarder" class="save"> <input type="button" value="fermer" class="out" onclick="toggle()"></td></tr>
		</table>

		</form>
		<?php
		

$base="visitor";
$idcom=mysqli_connect(MYHOST,MYUSER,MYPASS);
$idbase=mysqli_select_db($idcom,$base);


	
	if(!empty($_POST['maximum']) && !empty($_POST['nom'])  ){
	$max=$_POST['maximum'];
	$nom=$_POST['nom'];
	
	$date=date("Y-m-d ");
	
$requete="INSERT INTO divisiontable( `divname`, `visiteurmax`, `datecreation`) VALUES('$nom','$max','$date')";

$result=mysqli_query($idcom,$requete) ;

if(!$result){
	echo "<script type=\"text/javascript\">alert(\"erreur\")</script>";
		
}
else{
	echo "<script type=\"text/javascript\">alert(\"enregistrer\")</script>";
	echo "<script type=\"text/javascript\">window.location=\"division.php\"</script>";
	
	 
}}
 ?>
	</div>
			
</body>
<script type="text/javascript" src="visitor.js"></script>
<?php
}
?>
</html>