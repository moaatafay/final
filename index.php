<?php 
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="index.css">
	<title>Gestion des visiteurs</title>
</head>
<body>
	
	<form method ="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	
			
	

	<div class="a">
		<p>systeme de gestion de visiteurs</p>
		<div class="c">
			
		
			<div class="txt"><label >Entrer votre Nom d'utilisateur </label></div>
			<input type="text" name="user" size="55" style="margin-bottom: 10px;">
			<div class="txt"><label>Entrer votre mot de passe</label></div>
			<input type="password" name="code" size="55" style="margin-bottom: 10px;">
			<hr style="width:50%;margin-left:100px">
			
			<center><input type="submit" value="connexion" class="btn btn-primary" ></center>

		
	</div>
</div>
</form>
<?php

	define("MYHOST","localhost");
	define("MYUSER","root");
	define("MYPASS","");
	$base="visitor";
	$idcom=mysqli_connect("localhost","root","");
	$idbase=mysqli_select_db($idcom,$base);
if(!empty($_POST['user']) && !empty($_POST['code'])){
$code=$_POST['code'];
$user=$_POST['user'];
$requete="SELECT * FROM utilisateur WHERE  `password`='$code' AND `cin`='$user'  ";

$result=mysqli_query($idcom,$requete);
$coord=mysqli_fetch_row($result);

if(!$coord){
	echo" <script>alert('mot de passe ou nom d utilisateur incorrect')</script> ";

	echo "<script type=\"text/javascript\">window.location=\"index.php\"</script>";

}
	else{
    $_SESSION["gender"]=$coord[1];
    $_SESSION["user"]=$coord[2];
    $_SESSION["password"]=$coord[3];
   
    header("location:dash.php");
	}}




	?>
</body>





</html>