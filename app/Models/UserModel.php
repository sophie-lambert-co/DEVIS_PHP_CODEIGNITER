<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

/**
 * Le UserModel gère les interactions avec la table users.
 */
class UserModel extends Model
{
    protected $validation;
    protected $request;
    protected $response;
  
    // Nom de la table
    protected $table = 'users';

    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Champs autorisés pour les insertions et les mises à jour
    protected $allowedFields = [
        'user_name', 'id', 'role', 'n_siret', 'adresse_entrprise', 'tel', 'is_admin', 'email', 'password', 'created_at', 'updated_at', 'deleted_at'
    ];

    // Type de retour des données
    protected $returnType = 'array';

    // Utilisation des suppressions douces (soft deletes)
    protected $useSoftDeletes = true;

    // Utilisation des timestamps
    protected $useTimestamps = true;

    // Champ pour la suppression douce
    protected $deletedField = 'deleted_at';


    public function __construct() 
    {
        // Initialisation des modèles et des services
        $this->validation = Services::validation();
        $this->request = Services::request();
        $this->response = Services::response();
    }

     /**
     * Méthode pour afficher le formulaire de création d'un user.
     * 
     * @return string| void |    \CodeIgniter\HTTP\RedirectResponse Une vue avec le formulaire de création d'un user.
     */
    public function createUser($data)
    {
          // Définition des règles de validation
          $validation = $this->validation;
          $validation->setRules([
              'user_name' => 'required|min_length[3]|max_length[20]',
              'created_at' => 'required|valid_date',
              'n_siret' => 'required',
              'adresse_entrprise' => 'required',
              'tel' => 'required',
              'email' => 'required|valid_email|is_unique[users.email]',
              'password' => 'required|min_length[8]|max_length[255]',
          ]);

        // Validation des données
        if (!$this->validation->run($data)) {
             // Récupération des erreurs
        $errors = $this->validation->getErrors();

    
        // Renvoi du formulaire avec les erreurs
        return view('clients/create', ['errors' => $errors]);
        } else {
            // Création du user
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
         $this->insert($data);
      
            // Redirection vers la vue du user
            return redirect()->to('/clients/view/' . $this->insertID);
        }
        
    }












    /**
     * Définit le mot de passe de l'utilisateur.
     *
     * @param string $password Le mot de passe à définir.
     */
    public function setPassword($password)
    {
        $this->update($this->primaryKey, ['password' => password_hash($password, PASSWORD_DEFAULT)]);
    }

    /**
     * Vérifie le mot de passe de l'utilisateur.
     *
     * @param string $password Le mot de passe à vérifier.
     *
     * @return bool Renvoie true si le mot de passe est correct, false sinon.
     */
    public function checkPassword($password)
    {
        $user = $this->find($this->primaryKey);
        return password_verify($password, $user['password']);
    }

 

     /**
     * Récupère le client associé à un devis spécifique.
     *
     * @param int $userId L'identifiant de l'utilisateur.
     * 
     * @return array
     */
    public function getUser($userId)
    {
        $userModel = new \App\Models\UserModel();
        return $userModel->where('id', $userId)->first();
    }

    
    
}