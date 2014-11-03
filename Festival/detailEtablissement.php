<?php

include("_debut.inc.php");
include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");

// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival

$connexion=connect();
if (!$connexion)
{
   ajouterErreur("Echec de la connexion au serveur MySql");
   afficherErreurs();
   exit();
}
if (!selectBase($connexion))
{
   ajouterErreur("La base de données festival est inexistante ou non accessible");
   afficherErreurs();
   exit();
}

$id=$_REQUEST['id'];  

// OBTENIR LE DÉTAIL DE L'ÉTABLISSEMENT SÉLECTIONNÉ

$lgEtab=obtenirDetailEtablissement($connexion, $id);

$nom=$lgEtab['nom'];
$adresseRue=$lgEtab['adresseRue'];
$codePostal=$lgEtab['codePostal'];
$ville=$lgEtab['ville'];
$tel=$lgEtab['tel'];
$adresseElectronique=$lgEtab['adresseElectronique'];
$type=$lgEtab['type'];
$civiliteResponsable=$lgEtab['civiliteResponsable'];
$nomResponsable=$lgEtab['nomResponsable'];
$prenomResponsable=$lgEtab['prenomResponsable'];
$nombreChambresOffertes=$lgEtab['nombreChambresOffertes'];
$Informations_pratiques=$lgEtab['Informations_pratiques'];
$ConventionSignee=$lgEtab['ConventionSignee'];

echo "
<table width='60%' cellspacing='0' cellpadding='0' align='center' 
class='tabNonQuadrille'>
   
   <tr class='enTeteTabNonQuad'>
      <td colspan='3'>$nom</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td  width='20%'> Id: </td>
      <td>$id</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Adresse: </td>
      <td>$adresseRue</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Code postal: </td>
      <td>$codePostal</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Ville: </td>
      <td>$ville</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Téléphone: </td>
      <td>$tel</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> E-mail: </td>
      <td>$adresseElectronique</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Type: </td>";

      if ($type==1)
      {
         echo "<td> Etablissement scolaire </td>";
      }
      else
      {
         echo "<td> Autre établissement </td> ";
      }

      echo "
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Responsable: </td>
      <td>$civiliteResponsable $nomResponsable $prenomResponsable
      </td>
   </tr> 
   <tr class='ligneTabNonQuad'>
      <td> Offre: </td>
      <td>$nombreChambresOffertes chambre(s)</td>
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Convention signée </td>";
      if ($ConventionSignee==1)
      {
         echo "<td> La convention est signée </td>";
      }
      else
      {
         echo "<td> La convention n'est pas signée </td>";
      }
      echo "
   </tr>
   <tr class='ligneTabNonQuad'>
      <td> Informations Pratiques : </td>
      <td>$Informations_pratiques</td>";
      echo "
   </tr>
</table>
<table align='center'>
   <tr>
      <td align='center'><a href='listeEtablissements.php'>Retour</a>
      </td>
   </tr>
</table>";
?>
