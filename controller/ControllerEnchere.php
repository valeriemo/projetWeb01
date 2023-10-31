<?php



class ControllerEnchere extends Controller
{

    /**
     * Méthode pour afficher la page d'accueil. Affiche tous les projets en cours.
     */
    public function index()
    {
        Twig::render("/enchere/enchere-index.php");
    }


}