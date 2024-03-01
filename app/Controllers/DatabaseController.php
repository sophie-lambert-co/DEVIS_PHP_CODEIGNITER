<?php


// Fichier : app/Controllers/DatabaseController.php

namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * Contrôleur gérant les opérations liées à la base de données.
 */
class DatabaseController extends Controller
{
    /**
     * Affiche un message pour indiquer si la connexion à la base de données a réussi.
     *
     * @return void
     */
    public function index()
    {
        // Obtenir la connexion à la base de données
        $db = db_connect();

        // Vérifier si la connexion est établie
        if ($db->connect_error) {
            // En cas d'erreur de connexion, afficher un message d'erreur
            die("Erreur de connexion à la base de données : " . $db->connect_error);
        } else {
            // Si la connexion est établie avec succès, afficher un message de succès
            echo "Connexion à la base de données établie avec succès !";
        }
    }
}
