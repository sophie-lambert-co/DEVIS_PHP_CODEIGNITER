<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use Config\Services\Validation;

/**
 * Contrôleur gérant l'authentification des utilisateurs.
 */
class AuthController extends Controller
{
    protected $userModel;
    protected $validation;
    protected $session;

    /**
     * Constructeur du contrôleur.
     */
    public function __construct()
    {
        // Initialisation du modèle utilisateur, du service de validation et de la session
        $this->userModel = new UserModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    /**
     * Méthode pour l'enregistrement d'un nouvel utilisateur.
     *
     * @return mixed Retourne la vue appropriée.
     */
    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            // Récupère les données du formulaire
            $data = $this->request->getPost();

            // Crée l'utilisateur et renvoie à la vue de l'utilisateur
            return $this->userModel->createUser($data);
        } else {
            // Affiche le formulaire d'enregistrement
            $data = [
                'title' => 'Création d\'un client',
                'content' => view('Clients/create')
            ];

            return view('layout', $data);
        }
    }

    /**
     * Authentifie l'utilisateur et gère les différentes actions en fonction du résultat de l'authentification.
     *
     * @return mixed Renvoie la vue appropriée en fonction du résultat de l'authentification.
     */
    public function authenticate()
    {
        helper(['form', 'text']);

        // Récupérer les données du formulaire
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Validation des données du formulaire
        $this->validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]' // Exemple de règle de validation pour le mot de passe
        ]);

        // Vérification de la validation des données du formulaire
        if (!$this->validation->withRequest($this->request)->run()) {
            // Les données du formulaire ne sont pas valides, afficher la vue de connexion avec les erreurs de validation
            $data = [
                'title' => 'Connexion client',
                'error' => $this->validation->getErrors(),
            ];
            return view('layout', $data);
        }

        // Récupérer le client  
        $user = $this->userModel->where('email', $email)->first();

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($password, $user->password)) {
            // Mot de passe correct, alors définir les données utilisateur dans la session
            $this->session->set('user_id', $user->id);
            $this->session->set('user_name', $user->user_name);

            // Rediriger l'utilisateur
            return redirect()->to('/clients/view/' . $user->id);
        } else {
            // Mot de passe incorrect ou utilisateur non trouvé
            $error = lang('Auth.wrongCredentials');
        }

        // Afficher la vue de connexion avec l'erreur appropriée
        $data = [
            'title' => 'Connexion client',
            'content' => view('login', ['error' => $error])
        ];
        return view('layout', $data);
    }

    /**
     * Affiche le formulaire de connexion.
     *
     * @return mixed Retourne la vue du formulaire de connexion.
     */
    public function login()
    {
        // Afficher le formulaire de connexion
        $data = [
            'title' => 'Connexion client',
            'content' => view('login')
        ];
        return view('layout', $data);
    }

    /**
     * Déconnecte l'utilisateur.
     *
     * @return mixed Retourne à la page d'accueil après la déconnexion.
     */
    public function logout()
    {
        // Destruction de la session utilisateur
        $this->session->destroy();
        return redirect()->to('/');
    }
}
