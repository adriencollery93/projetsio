<?php
/**
 * Fichier accueil_eleve.php
 * @abstract page qui affiche la page d'accueil d'un eleve
 * @author Eric Dondelinger
 * @version 0.1
 */

session_start();

if ($_SESSION["estProf"] != "N"){
	header('Location: errorPage.php');
}

// connexion à la BDD
mysql_connect("localhost", "root", "admin");
mysql_select_db("projet_notes");

// on récupère les matières de la classe de l'étudiant
$query = "select * from matiere where code_classe = '".$infos_user['code_classe']."'";
$resu_mat = mysql_query($query);

// on compte le nombre maximum de notes obtenu dans une matière pour la mise en forme du tableau résultat
$query = "select count(*) as nb from resultat, evaluation, matiere where resultat.code_eval = evaluation.code_eval and evaluation.code_mat = matiere.code_mat and code_classe = '".$infos_user['code_classe']."' and code_user = '".$_SESSION['user']."'";
$resu_compte = mysql_query($query);

$liste_compte = mysql_fetch_assoc($resu_compte);
$notes_max = $liste_compte['nb'];

// on affiche le connecté
echo("Connecté : ".$_SESSION['prenom_user']." ".$_SESSION['nom_user']);
?>
<h2>Voici vos résultats pour les matières de votre formation : </h2>
</br>
<table>
	<tr>
		<th>Matière</th>
<?php
		for ($i = 1; $i<= $notes_max; $i++){
			echo("<th>Note ".$i."</th>");
		}
?>
	</tr>
<?php	
		while ($liste_mat = mysql_fetch_assoc($resu_mat)) {
			echo("<tr><td>".$liste_mat['lib_mat']."</td>");
			// on va chercher les notes de cette matière pour l'étudiant
			$query = "select * from resultat, evaluation where resultat.code_eval = evaluation.code_eval and code_user = '".$_SESSION['user']."' and code_mat = ".$liste_mat['code_mat'];

			$resu_notes = mysql_query($query);
			while ($liste_notes = mysql_fetch_assoc($resu_notes)) {
				echo("<th>".$liste_notes['note']."</th>");
			}
			echo("</tr>");
		}
?>		
</table>