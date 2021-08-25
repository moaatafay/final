<?php 
session_start();
if(isset($_SESSION['user']) && isset($_SESSION["password"])){
?>

<!DOCTYPE html>
<html>
<head>
	<?php 
define("MYHOST","localhost");
define("MYUSER","root");
define("MYPASS","");
	?>
	<meta charset="utf-8">
	 <script src="https://kit.fontawesome.com/7a1877b7ec.js" crossorigin="anonymous"></script>
	 <link rel="stylesheet" type="text/css" href="vis.css">
	 
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	
	<div class="container" id="blur">
				<div class="barre">systeme de gestion de visiteurs</div>
		<div id="mynavbar" class="navbar" >
			<a href="dash.php"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;&nbsp;Dashboard</a>
			<a href="division.php"><i class="fas fa-building"></i>&nbsp;&nbsp;&nbsp;Division</a>
			<a href="visitor.php" id="vis"><i class="fas fa-hospital-user"></i>&nbsp;&nbsp;&nbsp;Visiteur</a>
			<a href="profil.php"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;&nbsp;Profile</a>
			<a href="password.php" id="pwd"><i class="fas fa-key"></i>&nbsp;&nbsp;&nbsp;Changer mot de passe</a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;Déconnexion</a>
		</div>
	
		<div class="header">
			<div style="background-color: #F7F6F6;height: 50px ;border:1px solid black ; height: 60px;margin-right: 10px;" >
				<p>Visiteurs</p>
				
				<button type="button" class="add" onclick="toggle()"><i class="fas fa-user-plus"></i></button >
				 </div>
			
			<div class="search"><form method ="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
				<input type="text" size="20" name="cherche"
					<?php
					if(!empty($_POST['cherche'])){
						$valeur=$_POST['cherche'];
						echo " value=".$valeur."";}
					?>
				>
				<input type="submit" value="chercher" name="found"></form></div>
			<table  id="visiteur">
				<tr>
					<th>CIN</th>
					<th>Nom et Prenom</th>
					<th>Division</th>
					<th>Raison</th>
					<th>Temps de l'entrée</th>
					<th>Temps de sortie</th>
					<th>Statut</th>
					<th>Action </th>
				</tr>

				<form method ="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
				<?php 
						$base="visitor";
						$idcom=mysqli_connect(MYHOST,MYUSER,MYPASS);
						$idbase=mysqli_select_db($idcom,$base);
						if( !empty($_POST['cherche']) && !empty($_POST['found']) ){
							$lol=mysqli_escape_string($idcom,$_POST['cherche']);
								$requete2= "SELECT * FROM visiteur WHERE cne='$lol' ORDER BY datein DESC";
								$result2=mysqli_query($idcom,$requete2);
								$num=mysqli_num_rows($result2);
								if($num==0){
									echo "<tr>";
									echo "<td COLSPAN=8><center>aucun visiteur avec ce cne saisie</center></td>";
									echo "</tr>";
								}
								else{
								while($tab=mysqli_fetch_row($result2)){	
									
										
									
						
					echo "<tr>";
					echo "<td>".$tab[1]."</td>";
					echo "<td>".$tab[2]."</td>";
					echo "<td>".$tab[5]."</td>";
					echo "<td>".$tab[3]."</td>";
					echo "<td>".$tab[4]."</td>";
					echo "<td>".$tab[6]."</td>";
					if(!isset($tab[6])){
					echo "<td><center><p style=\"background-color: #198754;color:white;border-radius: 50%\">inside</p></center></td>";
				echo "<td><center><button type=\"submit\" class=\"effet\" name=".$tab[1]." value=".$tab[1]." ><i class=\"fas fa-hourglass-end\"></i></button> </center></td>" ;}
				else{
					echo "<td><center><p style=\"background-color: #dc3545;color:white;border-radius: 50%\">leaving</p></center></td>";
				
				echo"<td></td>";}

					
					if(!isset($tab[6] ) && isset($_POST[$tab[1]])){
							$d=strtotime("+1 hour");
						$dateout=date("Y-m-d H:i:s",$d);
						$requete3="UPDATE `visiteur` SET `dateout`='$dateout' WHERE   cne LIKE '$tab[1]' AND datein LIKE '$tab[4]'
						AND nom LIKE '$tab[2]'  AND raison LIKE '$tab[3]' AND division LIKE '$tab[5]'";

						
						$result3=mysqli_query($idcom,$requete3) ;

						
					}
						
					
					echo "</tr>";
				
				
					}}
						}

							else{
						
						
						$requete2= 'SELECT * FROM `visiteur` ORDER BY datein DESC'  ;
						$result2=mysqli_query($idcom,$requete2);

						while($tab=mysqli_fetch_row($result2)){			
					echo "<tr>";
					echo "<td>".$tab[1]."</td>";
					echo "<td>".$tab[2]."</td>";
					echo "<td>".$tab[5]."</td>";
					echo "<td>".$tab[3]."</td>";
					echo "<td>".$tab[4]."</td>";
					echo "<td>".$tab[6]."</td>";
					if(!isset($tab[6])){
					echo "<td><center><p style=\"background-color: #198754;color:white;border-radius: 50%\">inside</p></center></td>";
					echo "<td><center><button type=\"submit\" class=\"effet\" name=".$tab[1]." value=".$tab[1]." ><i class=\"fas fa-hourglass-end\"></i></button> </center></td>" ;}
				else{
					echo "<td><center><p style=\"background-color: #dc3545;color:white;border-radius: 50%\">leaving</p></center></td>";
						echo "<td></td>";}

					
					if(!isset($tab[6] ) && !empty($_POST[$tab[1]])){
						$d=strtotime("+1 hour");
						$dateout=date("Y-m-d H:i:s",$d);
						$requete3="UPDATE `visiteur` SET `dateout`='$dateout' WHERE   cne LIKE '$tab[1]' AND datein LIKE '$tab[4]'
						AND nom LIKE '$tab[2]'  AND raison LIKE '$tab[3]' AND division LIKE '$tab[5]'";
						$result3=mysqli_query($idcom,$requete3) ;

						echo "<script type=\"text/javascript\">window.location=\"visitor.php\"</script>";
					}
						
					
					echo "</tr>";
				}}
				
			
				?>
				</form>
				
			</table>
		</div>
	</div>
	<div id="popup">
		<form method ="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
		<br><label>Ajouter le visiteur</label><button type="button" onclick="toggle()"><i class="fas fa-times"></i></button>

		<hr style="margin-top:40px">
		<table width="100%" >
			<tr><td >CNE</td><td ><input type="text" size="40"  name="cne" required></td></tr>
			<tr><td >Nom et Prenom</td><td ><input type="text"  name="nom" size="40" required></td></tr>
			<tr><td >Division</td><td ><select name="division">
						<?php 
						$base="visitor";
						$idcom=mysqli_connect(MYHOST,MYUSER,MYPASS);
						$idbase=mysqli_select_db($idcom,$base);
						
							
								$requete2= "SELECT `divname` FROM divisiontable  ORDER BY datecreation DESC";
								$result2=mysqli_query($idcom,$requete2);
								
								while($tab=mysqli_fetch_row($result2)){	

				echo"<option >".$tab[0]."</option>";}
				?>
			</td></tr>
			<tr><td >Raison</td><td ><textarea cols="48" rows="5" name="msg"></textarea ></tr>
			<tr><td ></td><td style="text-align: right;"><input type="submit" value="sauvegarder" name="insertion" class="save">    <input type="button" value="fermer" class="out" onclick="toggle()"></td></tr>
		</table>

		</form>
		<?php
		

$base="visitor";
$idcom=mysqli_connect(MYHOST,MYUSER,MYPASS);
$idbase=mysqli_select_db($idcom,$base);


	
	if(!empty($_POST['cne']) && !empty($_POST['nom']) && !empty($_POST['msg']) && !empty($_POST['division']) ){
	$cne=$_POST['cne'];
	$nom=$_POST['nom'];
	$msg=@$_POST['msg'];
	$div=@$_POST['division']; 
	$d=strtotime("+1 hour");
	$datein=date("Y-m-d H:i:s",$d);
	
$requete="INSERT INTO visiteur( `cne`, `nom`, `raison`, `datein`,`division`) VALUES('$cne','$nom','$msg','$datein','$div')";
$requete4="SELECT * FROM `visiteur` WHERE division like '$div' AND dateout IS NULL ";
$requete5="SELECT * FROM `divisiontable` WHERE divname like '$div' ";
					
					$res4=mysqli_query($idcom,$requete4);
					$numero4=mysqli_num_rows($res4);
					$res5=mysqli_query($idcom,$requete5);
					$max=mysqli_fetch_array($res5);



					if($numero4+1<=$max[2]){

$result=mysqli_query($idcom,$requete) ;

if(!$result){
	echo "<script type=\"text/javascript\">alert(\"erreur\")</script>";
	echo "<script type=\"text/javascript\">window.location=\"visitor.php\"</script>";
		
}
else{
	echo "<script type=\"text/javascript\">alert(\"enregistrer  \")</script>";
	echo "<script type=\"text/javascript\">window.location=\"visitor.php\"</script>";
	
	 
}
}
else{
echo"<script type=\"text/javascript\">alert(\"la division que vous avez choisi est pleine. Veuillez attendre quelque minutes  \")</script>";
echo "<script type=\"text/javascript\">window.location=\"visitor.php\"</script>";}
}
 ?>
	</div>
	
			
</body>
<script type="text/javascript" src="visitor.js"></script>
<?php
}
?>
</html>
