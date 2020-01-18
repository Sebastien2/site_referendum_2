<?php

include('modeles/leftColumn/classique.php');


//echo "connecte";

//On prend le profil
$idUser=$_SESSION['id'];



//on prend la liste de ses groupes
$groupes=listeMesGroupes($idUser);
//var_dump($groupes);


//la liste des referendums auxquels il peut participer, et sur lesquels il n'a pas encore participé, par catégorie (10 catégories, puis autres)
include('modules/leftColumn/vues/classiqueConnecte.php');

?>