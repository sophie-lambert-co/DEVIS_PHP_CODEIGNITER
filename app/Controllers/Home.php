<?php

namespace App\Controllers;

/**
 * Contrôleur principal de la page d'accueil.
 */
class Home extends BaseController
{
    /**
     * Affiche la page d'accueil.
     *
     * @return string Retourne la vue de la page d'accueil.
     */
    public function index(): string
    {
        // Retourne la vue de la page d'accueil ainsi que la vue du pied de page
        return view('home') . view('Shared/footer');
    }
}
