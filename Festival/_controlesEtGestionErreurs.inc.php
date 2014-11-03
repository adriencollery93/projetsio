<?php

// FONCTIONS DE CONTRÔLE DE SAISIE

// Si $codePostal a une longueur de 5 caractères et est de type entier, on 
// considère qu'il s'agit d'un code postal
function estUnCp($codePostal)
{
   // Le code postal doit comporter 5 chiffres
   return strlen($codePostal)== 5 && estEntier($codePostal);
}

// Si la valeur transmise ne contient pas d'autres caractères que des chiffres, 
// la fonction retourne vrai
function estEntier($valeur)
{
   return !preg_match("/[^0-9]/", $valeur);
}

// Si la valeur transmise ne contient pas d'autres caractères que des chiffres  
// et des lettres non accentuées, la fonction retourne vrai
function estChiffresOuEtLettres($valeur)
{
   return !preg_match("/[^a-zA-Z0-9]/", $valeur);
}

// Fonction qui vérifie la saisie lors de la modification d'un établissement. 
// Pour chaque champ non valide, un message est ajouté à la liste des erreurs
function verifierDonneesEtabM($connexion, $id, $nom, $adresseRue, $codePostal, 
                              $ville, $tel, $nomResponsable, $nombreChambresOffertes)
{
   if ($nom=="" || $adresseRue=="" || $codePostal=="" || $ville=="" || 
       $tel=="" || $nomResponsable=="" || $nombreChambresOffertes=="")
   {
      ajouterErreur("Chaque champ suivi du caractère * est obligatoire");
   }
   if ($nom!="" && estUnNomEtablissement($connexion, 'M', $id, $nom))
   {
      ajouterErreur("L'établissement $nom existe déjà");
   }
   if ($codePostal!="" && !estUnCp($codePostal))
   {
      ajouterErreur("Le code postal doit comporter 5 chiffres");   
   }
   if ($nombreChambresOffertes!="" && (!estEntier($nombreChambresOffertes) ||
       !estModifOffreCorrecte($connexion, $id, $nombreChambresOffertes)))
   {
      ajouterErreur
      ("La valeur de l'offre est non entière ou inférieure aux attributions effectuées");
   }
   if (!estEntier($ville) == 0)
   {
      ajouterErreur ("Le nom de la ville ne doit pas contenir uniquement des chiffres");
   }
   if ($nom != "")
   {
      if (!estEntier($nom) == 0)
      {
         ajouterErreur ("Le nom de la ligue ne doit pas uniquement contenir des chiffres");
      }
   }
   if ($nomResponsable != "")
   {
      if (!estEntier($nomResponsable) == 0)
      {
         ajouterErreur ("Le nom de famille ne doit pas contenir de chiffres");
      }
   }
}

// Fonction qui vérifie la saisie lors de la création d'un établissement. 
// Pour chaque champ non valide, un message est ajouté à la liste des erreurs
function verifierDonneesEtabC($connexion, $id, $nom, $adresseRue, $codePostal, 
                              $ville, $tel, $nomResponsable, $nombreChambresOffertes, $ConventionSignee)
{
   if ($id=="" || $nom=="" || $adresseRue=="" || $codePostal=="" || $ville==""
       || $tel=="" || $nomResponsable=="" || $nombreChambresOffertes=="")
   {
      ajouterErreur("Chaque champ suivi du caractère * est obligatoire");
   }
   if($id!="")
   {
      // Si l'id est constitué d'autres caractères que de lettres non accentuées 
      // et de chiffres, une erreur est générée
      if (!estChiffresOuEtLettres($id))
      {
         ajouterErreur
         ("L'identifiant doit comporter uniquement des lettres non accentuées et des chiffres");
      }
      else
      {
         if (estUnIdEtablissement($connexion, $id))
         {
            ajouterErreur("L'établissement $id existe déjà");
         }
      }
   }
   if ($nom!="" && estUnNomEtablissement($connexion, 'C', $id, $nom))
   {
      ajouterErreur("L'établissement $nom existe déjà");
   }
   /*if ($ConventionSignee == 0)
   {
      ajouterErreur("La convention doit être signée");
   }*/
   if (isset($_REQUEST['ConventionSignee']))
   {

   }
   else
   {
      ajouterErreur("La convention n'est pas signée.");
   }
   if ($codePostal!="" && !estUnCp($codePostal))
   {
      ajouterErreur("Le code postal doit comporter 5 chiffres");   
   }
   if ($nombreChambresOffertes!="" && !estEntier($nombreChambresOffertes)) 
   {
      ajouterErreur ("La valeur de l'offre doit être un entier");
   }
   if ($ville != "")
   {
      if (!estEntier($ville) == 0)
      {
         ajouterErreur ("Le nom de la ville ne doit pas contenir uniquement des chiffres");
      }
   }
   if ($nom != "")
   {
      if (!estEntier($nom) == 0)
      {
         ajouterErreur ("Le nom de la ligue ne doit pas uniquement contenir des chiffres");
      }
   }
   if ($nomResponsable != "")
   {
      if (!estEntier($nomResponsable) == 0)
      {
         ajouterErreur ("Le nom de famille ne doit pas contenir de chiffres");
      }
   }
   if (!estEntier($tel) == 1)
   {
      ajouterErreur("Le numéro de téléphone ne doit contenir que des chiffres");
   }
}

// FONCTIONS DE GESTION DES ERREURS

function ajouterErreur($msg)
{
   if (! isset($_REQUEST['erreurs']))
      $_REQUEST['erreurs']=array();
   $_REQUEST['erreurs'][]=$msg;
}

function nbErreurs()
{
   if (!isset($_REQUEST['erreurs']))
   {
	   return 0;
	}
	else
	{
	   return count($_REQUEST['erreurs']);
	}
}
 
function afficherErreurs()
{
   echo '<div class="msgErreur">';
   echo '<ul>';
   foreach($_REQUEST['erreurs'] as $erreur)
	{
      echo "<li>$erreur</li>";
	}
   echo '</ul>';
   echo '</div>';
} 

?>
