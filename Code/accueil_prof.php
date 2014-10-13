<?php
/**
 * Fichier accueil_prof.php
 * @abstract page qui affiche la page d'accueil d'un prof
 * @author Eric Dondelinger
 * @version 0.1
 */

session_start();

if ($_SESSION["estProf"] != "O"){
	header('Location: errorPage.php');
}

$query = "select * from enseigner, matiere where code_user = '".$_SESSION['user']."' and enseigner.code_mat = matiere.code_mat";
mysql_connect("localhost", "root", "admin");
mysql_select_db("projet_notes");
$resultat = mysql_query($query);

echo("Connecté : ".$_SESSION['prenom_user']." ".$_SESSION['nom_user']);
?>

<h2>Sélectionnez la classe à laquelle vous souhaitez accéder</h2>
<br/>
<table border="1">
	<tr>
		<th>Code classe</th><th>Matière</th><th>Choix</th>
	</tr>	
<?php
while ($infos_classe = mysql_fetch_assoc($resultat)) {
	echo("<tr><td>".$infos_classe["code_classe"]."</td><td>".$infos_classe["lib_mat"]."</td><td><a href=recap_matiere.php?mat=".$infos_classe["code_mat"].">clic</a></td></tr>");
}
?>
</table>