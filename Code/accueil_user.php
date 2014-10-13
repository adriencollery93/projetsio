<?php

/**
 * Fichier accueil_user.php
 * @abstract page qui traite la connexion d'un utilisateur à l'application et l'accueille en fonction de son appartenance à une classe ou s'il s'agit d'un enseignant (dans ce cas, le champ code_classe de la table user est vide ""
 * @author Eric Dondelinger
 * @version 0.1
 */

session_start();

if (!isset($_POST["user"])){
	echo("Vous n'êtes pas autorisé à visualiser cette page. Merci de retourner à l'accueil.");
}else {
	
	// Le test sur le login/mdp peut être effectué
	$query = "select * from user where code_user = '".$_POST["user"]."' and pass_user = '".$_POST["pwd"]."'";
	mysql_connect("localhost", "root", "admin");
	mysql_select_db("projet_notes");
	$resultat = mysql_query($query);
	
	// si il y a des lignes retournées c'est que l'user a été reconnu
	if(mysql_num_rows($resultat) > 0){
		$infos_user = mysql_fetch_assoc($resultat);
		$_SESSION["user"] = $infos_user['code_user'];
		$_SESSION["prenom_user"] = $infos_user['prenom_user'];
		$_SESSION["nom_user"] = $infos_user['nom_user'];
		if ($infos_user['code_classe'] == ""){
			$_SESSION["estProf"] = "O";
			require("accueil_prof.php");
		}else {
			$_SESSION["estProf"] = "N";
			require("accueil_eleve.php");
		}
	}else{
		header('Location: index.php?error=nonreconnu');
	}
}

?>