<?php

namespace App\Controllers;

use App\Models\DevisModel;
use App\Models\DevisItemModel;
use App\Models\UserModel;
use Config\Services;
use App\Models\ItemModel;

/**
 * Classe DevisController
 * 
 * Cette classe gère les devis.
 */
class DevisController extends BaseController
{
    protected $userModel;
    protected $devisItemModel;
    protected $devisModel;
    protected $validation;
    protected $clientModel;
    protected $itemModel;

    protected $db;


    /**
     * Constructeur de la classe DevisController.
     * 
     * Initialise les modèles et services utilisés dans les autres méthodes.
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->devisItemModel = new DevisItemModel();
        $this->devisModel = new DevisModel();
        $this->itemModel = new ItemModel();
        $this->clientModel = new UserModel();
        $this->validation = Services::validation();
        $this->db = Services::connect();
        // Charge la bibliothèque de base de données
    }

    /**
     * Méthode pour afficher la liste des devis.
     * 
     * Récupère tous les devis avec le nom d'utilisateur associé et les renvoie à la vue 'devis/list'.
     * 
     * @return string|array la vue 'devis/list'.
     */
    public function index()
    {
        $request = service('request');
        $search = $request->getGet('search');

        // Récupérez tous les devis avec le user_name
        $data['devis'] = $this->devisModel->getDevisWithUserName();


        $listData = [
            'title' => 'Formulaire de liste des devis',
            'content' => view('devis/list', $data)
        ];

        // Renvoi de la vue avec les données
        return view('layout', $listData);
    }

    /**
     * Méthode pour afficher le formulaire de création d'un devis.
     * 
     * Prépare les données nécessaires pour le formulaire de création d'un devis et les renvoie à la vue 'devis/create'.
     * 
     * @return string La vue 'devis/'.
     */
    // fonction pour afficher le formulaire de création d'un devis
    public function createForm()
    {
        $data = []; // Initialiser $data comme un tableau

        // Récupérer tous les utilisateurs
        $query = $this->userModel->get();
        $data['users'] = $query->getResultArray();

        // Récupérer tous les items
        $query = $this->itemModel->get();
        $data['items'] = $query->getResultArray();

        // Affichage du formulaire de création de devis

        $viewData = [
            'title' => 'Formulaire de création de devis',
            'content' => view('devis/create', $data)
        ];

        // Renvoi de la vue avec les données
        return view('layout', $viewData);
    }



    /**
     * Méthode pour créer un devis.
     * 
     * Crée un nouveau devis et renvoie une redirection vers la liste des devis si la création est réussie, sinon renvoie une redirection vers le formulaire de création avec les erreurs de validation.
     * 
     * @param int $userId L'identifiant de l'utilisateur.
     * @param array $request Les données de la requête.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse|void|string Une redirection vers la liste des devis ou vers le formulaire de création, ou rien si la méthode affiche la vue.
     */
    public function create()
    {
        // Chargement des helpers form et url
        helper(['form', 'url']);

        // Initialisation des variables
        $validation = $this->validation;
        $request = $this->request;
        $itemModel = $this->itemModel;
        $devisModel = $this->devisModel;

        // Initialisation de devisId


        // Définition des règles de validation
        $validation->setRules([
            'user_id' => 'required',
            'created_at' => 'required|valid_date',
            'items' => 'required',
            'quantities' => 'required'
        ]);

        // Vérification si la méthode de la requête est POST
        if ($request->getMethod() == 'post') {
            // Vérification si les données de la requête sont valides
            if ($validation->withRequest($request)->run()) {
                // Récupération des items et des quantités de la requête
                $items = $request->getPost('items');
                $quantities = $request->getPost('quantities');

                // Calcul du total du devis
                $total = 0;
                foreach ($items as $itemId) {
                    $quantity = isset($quantities[$itemId]) ? $quantities[$itemId] : 0;
                    // dd($itemId);
                    $item = $this->itemModel->where('id', $itemId)->get()->getRowArray();
                    // dd($item);
                    $total += $item['price'] * $quantity;
                }

                // Préparation des données pour l'insertion
                $data = [
                    'user_id' => $request->getPost('user_id'),
                    'created_at' => $request->getPost('created_at'),
                    'total_devis' => $total,
                ];

                // Insertion du devis dans la base de données et récupération de l'ID
                $devisId = $devisModel->insert($data);

                // Insertion des items dans le devis
                foreach ($items as $itemId) {
                    $quantity = isset($quantities[$itemId]) ? $quantities[$itemId] : 0;
                    $devisModel->insertItem($devisId, $itemId, $quantity);
                }

                // Redirection vers la liste des devis
                return redirect()->to('/devis/list');
            } else {
                // Les données du formulaire ne sont pas valides, renvoyez l'utilisateur au formulaire avec les erreurs de validation
                return redirect()->to('/devis/create')->withInput()->with('validation', $validation->getErrors());
            }
        }
    }




    /**php
     * Méthode pour afficher un devis par son id.
     * 
     * @param int $Id L'identifiant du devis.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse|string Une redirection vers la vue du devis devis/view.
     */
    public function view($id)
    {
        // Récupérer le devis
        // $data['devis'] = $this->devisModel->where('id', $id)->first();
        $devis = $this->devisModel->where('id', $id)->findAll();
        // Si le devis n'est pas trouvé, lancer une exception
        if (empty($devis)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Impossible de trouver le devis avec l\'identifiant : ' . $id);
        }

        // Récupérer l'utilisateur associé au devis
        $user = $this->devisModel->getUserForDevis($id);

        // Récupérer les items du devis
        $items = $this->devisModel->getDevisItemsWithDetails($id);

        $data = [
            'title' => 'Détails du devis',
            'content' => view('devis/view', ['devis' => $devis, 'user' => $user, 'items' => $items])
        ];

        // Renvoi de la vue avec les données
        return view('layout', $data);
    }



    // Définition des messages d'erreur constants
    private const ERROR_MSG_NOT_FOUND = 'Impossible de trouver le devis avec l\'identifiant : ';
    private const ERROR_MSG_NO_POST_DATA = 'Aucune donnée reçue de la requête POST';
    private const ERROR_MSG_UPDATE_FAILED = 'La mise à jour du devis a échoué';

    // Fonction pour éditer un devis
    public function edit($id = null)
    {
        // Trouver le devis par son identifiant
        $devis = $this->devisModel->find($id);
        // Si le devis n'est pas trouvé, lancer une exception
        if (!$devis) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(self::ERROR_MSG_NOT_FOUND . $id);
        }

        // Obtenir l'utilisateur associé au devis
        $user = $this->devisModel->getUserForDevis($id);
        // Obtenir les articles du devis
        $items = $this->devisModel->getDevisItemsWithDetails($id);
        // Ajouter les articles au devis
        $devis['items'] = $items;
        // Obtenir tous les articles
        $allItems = $this->itemModel->findAll();

        // Préparer les données pour la vue
        $data = [
            'title' => 'Résultats de la modification',
            'content' => view('devis/edit', [
                'allItems' => $allItems,
                'devis' => $devis,
                'user' => $user,
                'items' => $items
            ])
        ];

        // Renvoi de la vue avec les données
        return view('layout', $data);
    }



    /**
     * Méthode pour supprimer un article d'un devis.
     * 
     * @param int $Id L'identifiant du devis.
     * @param int $itemId L'identifiant de l'article.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Une redirection vers la page d'édition du devis.
     */
    public function removeItem($id, $itemId)
    {
        // Supprimer l'article du devis
        $this->devisItemModel->where([
            'devis_id' => $id,
            'item_id' => $itemId,
        ])->delete();

        // Rediriger vers la page d'édition du devis
        return redirect()->to('/devis/edit/' . $id);
    }



    /**
     * Méthode pour ajouter un article dans un devis.
     * 
     * @param int $devisId L'identifiant du devis.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Une redirection vers la page d'édition du devis.
     */
    public function addItem($devisId)
    {
        // Si les données sont envoyées via POST (après soumission du formulaire)
        if ($this->request->getMethod() === 'post') {
            // Obtenir l'identifiant de l'item et la quantité à partir de la requête POST
            $itemId = $this->request->getPost('newItem');
            $quantity = $this->request->getPost('newItemQuantity');

            // Vérifier si l'item existe déjà dans le devis
            $existingItem = $this->devisItemModel->where('devis_id', $devisId)->where('item_id', $itemId)->first();

            // Si l'item existe déjà, mettre à jour la quantité
            if ($existingItem) {
                $this->devisItemModel->update($existingItem['id'], [
                    'quantity' => $existingItem['quantity'] + $quantity,
                ]);
            }
            // Si l'item n'existe pas et que l'identifiant de l'article et la quantité sont définis, ajouter l'article au devis
            else if ($itemId && $quantity) {
                $this->devisItemModel->insert([
                    'devis_id' => $devisId,
                    'item_id' => $itemId,
                    'quantity' => $quantity,
                ]);
            }

            // Rediriger vers la page d'édition du devis
            return redirect()->to('/devis/edit/' . $devisId);
        } else {
            // Gérer le cas où la requête n'est pas une requête POST
            return redirect()->to('/error');
        }
    }



    /**
     * Méthode pour modifier un devis.
     * 
     * @param int $devisId L'identifiant du devis.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Une redirection vers la page d'édition du devis.
     */
    public function update($devisId)
    {
        // Récupérer le devis
        $devis = $this->devisModel->find($devisId);

        // Récupérer les quantités d'articles existants
        $quantities = $this->request->getPost('quantity');

        // Mettre à jour les quantités d'articles existants
        foreach ($quantities as $itemId => $quantity) {
            $this->devisModel->updateItemQuantity($devisId, $itemId, $quantity);
        }

        // Récupérer le nouvel item et sa quantité
        $newItemId = $this->request->getPost('newItem');
        $newItemQuantity = $this->request->getPost('newItemQuantity');

        // Ajouter le nouvel item si un item été sélectionné
        if ($newItemId !== '') {
            $this->addItem($devisId);
        }

        // Recalculer le total du devis
        $this->devisModel->calculateTotal($devisId);

        // Mettre à jour le total du devis
        //$this->devisModel->updateTotal($devisId, $total);

        // Rediriger vers la page d'édition du devis
        return redirect()->to("/devis/edit/$devisId");
    }



    /**
     * Méthode pour supprimer un devis.
     * 
     * @param int $id L'identifiant du devis.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Une redirection vers la liste des devis.
     */
    public function delete($id)
    {
        // Supprimer le devis
        $this->devisModel->delete($id);

        // Rediriger vers la liste des devis
        return redirect()->to('/devis/list');
    }
}