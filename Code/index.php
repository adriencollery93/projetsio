<!-- Page d'accueil de l'application de gestion des r�sultats scolaires -->
<html>
<head>
<title>Application de gestion des r�sultats</title>
</head>

<body>

<h1>Bienvenue sur l'application de gestion des r�sultats</h1>

<?php
if(isset($_GET["error"])){
	echo("Erreur d'authentification, recommencez en v�rifiant votre login/mdp");
}
?>

<form action="accueil_user.php" method="POST">
	Utilisateur : <input type="text" name="user"><br>
	Mot de passe : <input type="password" name="pwd">
	</br>
	<input type="submit" name="ok" value="envoyer">
	<input type="reset" name="raz" value="effacer">
</form>

</body>

</html>