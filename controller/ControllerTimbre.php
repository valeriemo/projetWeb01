<?php

RequirePage::model('Condition');


class ControllerTimbre extends Controller
{

    /**
     * Méthode pour afficher la page d'accueil. Affiche tous les projets en cours.
     */
    public function index()
    {
        Twig::render("/timbre/timbre-index.php");
    }

    /**
     * Méthode pour afficher le formulaire de création de timbre.
     */
    public function create() {
        CheckSession::sessionAuth();

        // Je dois aller chercher les types de conditions pour les afficher dans le formulaire
        $condition = new Condition;
        $conditions = $condition->select();

        Twig::render("/timbre/timbre-create.php",  ['conditions' => $conditions]);
    }


}