<?php

namespace App\Controllers;

use App\Models\DevisModel;
use App\Models\DevisItemModel;
use App\Models\ItemModel;
use App\Models\UserModel;
use Config\Services;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * Contrôleur gérant les actions liées aux utilisateurs.
 */
class UserController extends BaseController
{
    // Déclaration des variables de classe
    protected $itemModel;
    protected $devisItemModel;
    protected $devisModel;
    protected $userModel;
    protected $validation;
    protected $request;
    protected $response;
    
    /**
     * Constructeur de la classe.
     */
    public function __construct()
    {
        // Initialisation des modèles et des services
        $this->itemModel = new ItemModel();
        $this->devisItemModel = new DevisItemModel();
        $this->devisModel = new DevisModel();
        $this->userModel = new UserModel();
        $this->validation = Services::validation();
        $this->request = Services::request();
        $this->response = Services::response();
    }

    /**
     * Affiche la liste des utilisateurs.
     * 
     * @return string Une vue avec la liste des utilisateurs.
     */
    public function index(): string
    {
        // Récupérer tous les utilisateurs
        $query = $this->userModel->get();
        $users = $query->getResult(); // Utilisez getResult() pour obtenir toutes les lignes
        
        // Préparer les données pour la vue
        $data = [
            'title' => 'Liste des utilisateurs',
            'user' => $users, // Passer le tableau d'utilisateurs à la vue
            'content' => view('clients/list', ['user' => $users]) // Passer le tableau d'utilisateurs à la vue
        ];
        
        // Renvoi de la vue avec les données
        return view('layout', $data);
    }

    /**
     * Effectue une recherche d'utilisateur.
     * 
     * @return string Une vue avec les résultats de la recherche.
     */
    public function search(): string
    {
        // Récupérer la valeur de recherche de la requête GET
        $search = $this->request->getGet('search');
        
        // Effectuer la recherche dans la base de données
        $query = $this->userModel->like('user_name', $search)->get();
        $user = $query->getResult();
        
        // Préparer les données pour la vue
        $data = [
            'title' => 'Résultats de la recherche pour "' . $search . '"',
            'user' => $user,
            'content' => view('clients/list', ['user' => $user])
        ];
        
        // Renvoi de la vue avec les données
        return view('layout', $data);
    }

    /**
     * Affiche le formulaire de création d'un utilisateur.
     * 
     * @return string|void|\CodeIgniter\HTTP\RedirectResponse  Une vue avec le formulaire de création d'un utilisateur ou une redirection.
     *
     */
    public function create()
    {
        // Chargement des helpers form et url
        helper(['form', 'url']);
        // Vérifie si la requête est de type POST
        if ($this->request->getMethod() === 'post') {
            // Récupère les données du formulaire
            $data = $this->request->getPost();
            
            // Crée l'utilisateur
            $this->userModel->createUser($data);
            
            // Redirige vers la vue de l'utilisateur
            return redirect()->to('/clients/view/' . $this->userModel->insertID);
        } else {
            // Affichage du formulaire de création
            // Préparer les données pour la vue
            $data = [
                'title' => 'Création d\'un client',
                'content' => view('clients/create')
            ];
            
            // Renvoi de la vue avec les données
            return view('layout', $data);
        }
    }

    /**
     * Affiche les détails d'un utilisateur.
     * 
     * @param string $id L'identifiant de l'utilisateur.
     * @return \CodeIgniter\HTTP\RedirectResponse|string Une redirection ou une vue avec les détails de l'utilisateur.
     */
    public function view($id)
    {
        try {
            // Récupérer l'utilisateur selon l'ID fourni
            $query = $this->userModel->where('id', $id)->get();
            $user = $query->getRow(); // Utilisez getRow() pour obtenir la première ligne
            
            // Vérifier si l'utilisateur existe
            if ($user === null) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Impossible de trouver l\'utilisateur avec l\'identifiant : ' . $id);
            }
            
            // Déterminer la vue à afficher en fonction du rôle de l'utilisateur
            $view = ($user->is_admin == 1) ? 'admin/view' : 'clients/view';
            
            // Préparer les données à envoyer à la vue
            $data = [
                'title' => 'Détails de l\'utilisateur',
                'user' => $user,
                'devis' => $this->devisModel->where('user_id', $id)->findAll()
            ];
            
            // Afficher la vue correspondante
            $content = view($view, $data);
            return view('layout', ['content' => $content]);
        } catch (\Exception $e) {
            // Gérer les erreurs
            $error = $e->getMessage();
            // Initialiser la variable $content avec une vue de connexion contenant le message d'erreur
            $content = view('login', ['error' => $error]);
            return view('layout', ['content' => $content]);
        }
    }

    /**
     * Affiche le formulaire de modification d'un utilisateur.
     * 
     * @param int $id L'identifiant de l'utilisateur.
     * @return string Une vue avec le formulaire de modification de l'utilisateur.
     */
    public function edit($id)
    {
        // Récupérer l'utilisateur selon l'ID fourni
        $query = $this->userModel->where('id', $id)->get();
        $user = $query->getRow(); // Utilisez getRow() pour obtenir la première ligne
        
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Impossible de trouver le user avec l\'identifiant : ' . $user['user_name']);
        }
        
        // Préparation des données à envoyer à la vue
        $data = [
            'title' => 'Modification du compte client',
            'user' => $user,
        ];
        
        // Affichage de la vue avec le formulaire de modification
        return view('layout', ['content' => view('clients/edit', $data)]);
    }

    /**
     * Met à jour un utilisateur.
     * 
     * @param int $id L'identifiant de l'utilisateur.
     * @return \CodeIgniter\HTTP\RedirectResponse|string Une redirection ou une vue avec les détails de l'utilisateur.
     */
    public function update($id)
    {
        // Récupérer l'utilisateur selon l'ID fourni
        $query = $this->userModel->where('id', $id)->get();
        $user = $query->getRow(); // Utilisez getRow() pour obtenir la première ligne
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Impossible de trouver le user avec l\'identifiant : ' . $user['user_id']);
        }
        
        // Récupération des données du formulaire
        $data = [
            'n_siret' => $this->request->getVar('n_siret'),
            'adresse_entrprise' => $this->request->getVar('adresse_entrprise'),
            'tel' => $this->request->getVar('tel'),
            'email' => $this->request->getVar('email'),
        ];
        
        // Définition des règles de validation
        $this->validation->setRules([
            'n_siret' => 'required',
            'adresse_entrprise' => 'required',
            'tel' => 'required',
            'email' => 'required|valid_email',
        ]);
        
        // Vérification de la validation
        if (!$this->validation->run($data)) {
            // Redirection vers le formulaire avec les erreurs de validation
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        } else {
            // Mise à jour de l'utilisateur
            $this->userModel->update($id, $data);
            // Redirection vers la vue de l'utilisateur
            return redirect()->to('/clients/view/' . $id);
        }
    }

    /**
     * Supprime un utilisateur.
     * 
     * @param int $id L'identifiant de l'utilisateur.
     * @return \CodeIgniter\HTTP\RedirectResponse Une redirection vers la liste des utilisateurs.
     */
    public function deleteUser($id)
    {
        // Suppression de l'utilisateur
        $this->userModel->delete($id);
        
        // Redirection vers la liste des utilisateurs
        return redirect()->to('/clients/list'); 
    }
}

