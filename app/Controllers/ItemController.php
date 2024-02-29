<?php

namespace App\Controllers;

use App\Models\DevisModel;
use App\Models\DevisItemModel;
use App\Models\ItemModel;

/**
 * Contrôleur gérant les actions liées aux items.
 */
class ItemController extends BaseController
{
    /**
     * @var ItemModel Le modèle pour les items.
     */
    protected $itemModel;
    
    /**
     * @var DevisItemModel Le modèle pour les items de devis.
     */
    protected $devisItemModel;
    
    /**
     * @var DevisModel Le modèle pour les devis.
     */
    protected $devisModel;
    
    /**
     * @var \CodeIgniter\Validation\Validation Le service de validation.
     */
    protected $validation;
    
    /**
     * Constructeur de la classe.
     * 
     * Initialise les modèles et le service de validation.
     */
    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->devisItemModel = new DevisItemModel();
        $this->devisModel = new DevisModel();
        $this->validation = \Config\Services::validation();
    }
    
    /**
     * Affiche la liste des items.
     * 
     * @return string Une vue avec la liste des items.
     */
    public function index()
    {
        $data['items'] = $this->itemModel->findAll();
        
        // Préparation des données pour la vue
        $listData = [
            'title' => 'Formulaire de liste des items',
            'content' => view('items/list', $data)
        ];
        
        // Renvoi de la vue avec les données
        return view('layout', $listData);
    }

    /**
     * Affiche le formulaire de création d'un item.
     * 
     * @return string Une vue avec le formulaire de création d'un item.
     */
    public function createForm()
    {
        return view('items/create');
    }

    /**
     * Crée un item.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Une redirection vers la liste des items.
     */
    public function create()
    {
        $data = [
            'description' => $this->request->getVar('description'),
            'price'=> $this->request->getVar('price'),
        ];
        
        $this->validation->setRules([
            'description' => 'required',
            'price' => 'required|numeric'
        ]);
        
        if (!$this->validation->run($data)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }
        
        $this->itemModel->save($data);
        return redirect()->to('/items/list');
    }

    /**
     * Affiche un item par son identifiant.
     * 
     * @param int $id L'identifiant de l'item.
     * 
     * @return string Une vue avec les détails de l'item.
     */
    public function view($id)
    {
        $data['item'] = $this->itemModel->where('id', $id)->first();
        
        if (empty($data['item'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Impossible de trouver l\'item avec l\'identifiant : ' . $id);
        }
        
        // Préparation des données pour la vue
        $listData = [
            'title' => 'Détails de l\'item',
            'content' => view('items/view', $data)
        ];
        
        // Renvoi de la vue avec les données
        return view('layout', $listData);
    }
    
    /**
     * Met à jour un item.
     * 
     * @param int $id L'identifiant de l'item.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Une redirection vers la vue de l'item.
     */
    public function update($id = null)
    {
        $data = [
            'description' => $this->request->getVar('description'),
            'price'=> $this->request->getVar('price'),
        ];
        
        $this->validation->setRules([
            'description' => 'required',
            'price' => 'required|numeric'
        ]);
        
        if (!$this->validation->run($data)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }
        
        $this->itemModel->update($id, $data);
        return redirect()->to('/items/view/'. $id); 
    }

    /**
     * Affiche le formulaire de modification d'un item.
     * 
     * @param int $id L'identifiant de l'item.
     * 
     * @return string Une vue avec le formulaire de modification de l'item.
     */
    public function edit($id = null)
    {
        $item = $this->itemModel->find($id);
        if (!$item) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Impossible de trouver l\'item avec l\'identifiant : ' . $id);
        }
        
        // Préparation des données pour la vue
        $editData = [
            'title' => 'Modification de l\'item',
            'content' => view('items/edit', ['item' => $item])
        ];
        
        // Renvoi de la vue avec les données
        return view('layout', $editData);
    }
    
    /**
     * Supprime un item.
     * 
     * @param int $id L'identifiant de l'item.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Une redirection vers la liste des items.
     */
    public function delete($id = null)
    {
        // Supprime l'item avec l'identifiant spécifié
        $this->itemModel->delete($id);
        
        // Redirige vers la liste des items
        return redirect()->to('/items/list');
    }
}
