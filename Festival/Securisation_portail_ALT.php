<?php
if ($_POST['numEtab'] == "1" && $_POST['pswd'] == "1234") //Il suffit de remplacer la valeur entre quote pour modifier le mot de passe.
{
header ('Location: index2.php'); //Redirection vers la page "Portail.html"
}
else
{
header ('Location: index.html'); //Redirection vers la page de saisie du mot de passe
}
?>