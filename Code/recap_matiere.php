<?php
/**
 * Fichier recap_matiere.php
 * @abstract page qui affiche les notes pour la matière sélectionnée
 * @author Eric Dondelinger
 * @version 0.1
 * @todo à voir utiliser cette page pour optimisation via les fonctionnalités zend core
 */

session_start();

if ($_SESSION["estProf"] != "O"){
	header('Location: errorPage.php');
}

if (!isset($_GET["mat"])){
	header('Location: accueil_prof.php');
}

mysql_connect("localhost", "root", "admin");
mysql_select_db("projet_notes");

// c'est ici que l'on valide une nouvelle saisie de résultat
if (isset($_GET["libeval"])){
	// on détermine le prochain numéro libre pour l'évaluation
	$query_ajout = "select count(*) as nb from evaluation";
	$resu_ajout = mysql_query($query_ajout);
	$liste_ajout = mysql_fetch_assoc($resu_ajout);
	$nb = $liste_ajout['nb'];
	$nb++;
	// ajout dans la base de la nouvelle évaluation
	$query_ajout = "insert into evaluation values (".$nb.", '".$_GET['libeval']."', '".$_GET['dateeval']."', '".$_GET['desdeval']."', ".$_GET['coefeval'].",".$_GET['mat'].")";
	$resu_ajout = mysql_query($query_ajout);
	// l'évaluation créée, il reste à ajouter les notes pour chaque étudiant
	for ($i = 0; $i< $_GET["nbetud"]; $i++){
		$query_ajout = "insert into resultat values (".$nb.", '".$_GET["user".$i.""]."', ".$_GET["note".$i.""].")";
		$resu_ajout = mysql_query($query_ajout);
	}
}

// on va récupérer la classe de la matière sélectionnée par l'utilisateur tout d'abord
$query = "select * from matiere where code_mat ='".$_GET["mat"]."'";
$resultat = mysql_query($query);
$resu_liste = mysql_fetch_assoc($resultat);

$classe = $resu_liste['code_classe'];

// on récupère toutes les évalusations de cette matière
$query = "select * from evaluation where code_mat = '".$_GET["mat"]."'";
$resu_eval = mysql_query($query);
$nb_eval = mysql_num_rows($resu_eval);

// on peut ensuite aller récupérer les élèves de cette classe afin de les afficher
$query = "select * from user where code_classe = '".$classe."' order by nom_user";
$resultat = mysql_query($query);

echo("Connecté : ".$_SESSION['prenom_user']." ".$_SESSION['nom_user']);
?>

<h2>Voici la liste de vos élèves et leur résultat pour la matière <?=$_GET["mat"]?> de la classe <?=$classe?></h2>
<h3>Renseignez la colonne vide pour ajouter un nouveau résultat (le descriptif de la nouvelle évaluation est à renseigner dans le formulaire sous la liste)</h3>
<br/>
<form action="recap_matiere.php">
<table border="1">
	<tr>
		<th>Nom élève</th>
<?php		
	while ($liste_eval = mysql_fetch_assoc($resu_eval)) {
		echo("<th>Eval ".$liste_eval['code_eval']."</th>");
	}
?>
	<th>Nouvelle</th>
	</tr>
<?php
$i = 0;
while ($resu_liste = mysql_fetch_assoc($resultat)) {
	echo("<tr><td>".$resu_liste["nom_user"]." ".$resu_liste['prenom_user']."</td>");
	// on va recherche les notes de chacun
	// on se repositionne sur la note courante
	mysql_data_seek($resu_eval, 0);
	while ($eval = mysql_fetch_assoc($resu_eval)){
		// on va chercher la note pour cette évaluation
		$query = "select * from resultat where code_user = '".$resu_liste["code_user"]."' and code_eval = ".$eval['code_eval'];
		$resu_res = mysql_query($query);
		$res = mysql_fetch_assoc($resu_res);
		echo("<td>".$res['note']."</td>");
	}
	echo("<td><input type=\"hidden\" name=\"user".$i."\" value=\"".$resu_liste["code_user"]."\">");
	echo("<input type=\"text\" name=\"note".$i."\" value=\"\">");
	echo("</tr>");
	$i++;
}
?>
</table>
<br/>
<table>
	<tr>
		<td>Description de la nouvelle évaluation : </td><td><input type="text" name="libeval"></td>
	</tr>
	<tr>
		<td>Coefficient de la nouvelle évaluation :</td><td><input type="text" name="coefeval"></td>
	</tr>
	<tr>
		<td>Date de la nouvelle évaluation (AAAAMMJJ) :</td><td><input type="text" name="dateeval"></td>
	</tr>
	<tr>
		<td>Description détaillée (facultatif) : </td><td><input type="text" name="desdeval"></td>
	</tr>
	<tr>
		<td><input type="hidden" name="mat" value="<?=$_GET['mat']?>"><input type="hidden" name="nbetud" value="<?=$i?>"></td><td><input type="submit" value="Envoyer"></td>
	</tr>
</table>

</form>