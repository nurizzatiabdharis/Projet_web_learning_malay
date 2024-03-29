﻿<?php
  session_start();
  include("../outils/connexion.php");
  include("../outils/base.php");
  include("./fonctions.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/site.css" />
  <title>Correction Evaluation Debutant</title>
</head>
    <body>
  <?php include('../outils/menu.php');?>
    <div id=corps>
      <section>
        <p><h1> Correction Evaluation Debutant </h1></p>
            <?php
            $niveau_evaluation = 'debutant';
            $nb_reponses_totales = 10;
            $donnee_extraite = array_extract_from_POST();     //recuperation des données issues de $_POST et inscrit dans un nouveau tableau
            $tab_result = tab_correction($donnee_extraite);   //tableau ayant pour clé l'id de la question et en valeur VRAI ou FAUX qui correspond à la comparaison de la réponse dans la bdd et celle donnée par l'utilisateur
            correction_evaluation($donnee_extraite, $tab_result);   //affichage du tableau d'évaluation
            $nb_reponses_justes = 0;
            foreach ($tab_result as $key => $value)
            {
              if($value == 'VRAI')
              {
                $nb_reponses_justes++;
              }
            }
            $sql = "SELECT * FROM record_evaluation WHERE idUser = {$_SESSION['id']} AND niveau='debutant'"; //lancer une requete sql pour savoir combien d'essai a ete fait par un utilisateur
    				$req = $bd->prepare($sql);
    				$req->execute();
    				$data_record=$req->fetchall();
    				$req->closeCursor();

    				$nb_essai=count($data_record);

            if ($nb_essai < 2){
              points_XP($_SESSION['id'], $_SESSION['niveau'], $nb_reponses_justes, $niveau_evaluation, $nb_reponses_totales); //enregistrer le 1er/2eme essai
            }
            else { //il est à max d'essai, donc calcul de niveau

              points_XP($_SESSION['id'], $_SESSION['niveau'], $nb_reponses_justes, $niveau_evaluation, $nb_reponses_totales); //on registre le 3eme essai

              calcul_niveau($_SESSION['id'], $niveau_evaluation);

              }




          ?>
      </section>
    </div>
  </body>
</html>
