<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Le DevisModel gère les interactions avec la table devis. Il peut également contenir des méthodes personnalisées pour des requêtes spécifiques.
 */
class DevisModel extends Model
{
    protected $table = 'devis'; // Nom de la table dans la base de données
    protected $primaryKey = 'id'; // Clé primaire de la table
    protected $allowedFields = ['user_id', 'total_devis']; // Champs autorisés à être insérés ou mis à jour
    protected $useTimestamps = true; // Activer les horodatages automatiques
    private $itemModel; // Instance du modèle d'item
    private $devisItemModel; // Instance du modèle d'élément de devis

    public function __construct()
    {
        parent::__construct();
        // Instanciation des modèles nécessaires
        $this->itemModel = new \App\Models\ItemModel();
        $this->devisItemModel = new DevisItemModel();
    }

    /**
     * Récupère les détails des items d'un devis spécifique.
     *
     * @param int $devisId L'identifiant du devis.
     * 
     * @return array Tableau contenant les détails des items du devis.
     */
    public function getDevisItemsWithDetails($devisId)
    {
        return $this->db->table('devis_items')
            ->join('devis', 'devis.id = devis_items.devis_id')
            ->join('items', 'items.id = devis_items.item_id')
            ->where('devis_items.devis_id', $devisId)
            ->select('devis.created_at, items.*, items.description, devis_items.quantity, items.price')
            ->get()
            ->getResultArray();
    }

    /**
     * Récupère les devis avec le nom d'utilisateur. Si un terme de recherche est fourni, filtre les devis par ce terme.
     *
     * @param string|null $search Le terme de recherche.
     * 
     * @return array Tableau contenant les devis avec le nom d'utilisateur.
     */
    public function getDevisByUserId($search = null)
    {
        $builder = $this->db->table($this->table)
            ->join('users', 'users.id = devis.user_id')
            ->select('devis.*, users.id');

        if ($search) {
            $builder->like('users.id', $search);
        }

        return $builder->get()->getResultArray();
    }

    /**
     * Met à jour la quantité d'un item dans un devis spécifique.
     *
     * @param int $devisId L'identifiant du devis.
     * @param int $itemId L'identifiant de l'item.
     * @param int $quantity La nouvelle quantité.
     */
    public function updateItemQuantity($devisId, $itemId, $quantity)
    {
        $this->db->table('devis_items')
            ->where('devis_id', $devisId)
            ->where('item_id', $itemId)
            ->update(['quantity' => $quantity]);
    }

    /**
     * Calcule le total d'un devis en multipliant le prix de chaque item par sa quantité.
     *
     * @param int $devisId L'identifiant du devis.
     */
    public function calculateTotal($devisId)
    {
        $items = $this->devisItemModel->where('devis_id', $devisId)->findAll();

        $total = 0;
        $itemModel = new \App\Models\ItemModel();
        foreach ($items as $devisItem) {
            $item = $itemModel->find($devisItem['item_id']);
            if ($item !== null && isset($item['price'])) {
                $total += $item['price'] * $devisItem['quantity'];
            }
        }

        $this->update($devisId, ['total_devis' => $total]);
    }

    /**
     * Récupère l'utilisateur associé à un devis spécifique.
     *
     * @param int $devisId L'identifiant du devis.
     * 
     * @return array Tableau contenant les informations de l'utilisateur associé au devis.
     */
    public function getUserForDevis($devisId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->join('users', 'users.id = devis.user_id');
        $builder->where('devis.id', $devisId);
        $query = $builder->get();

        return $query->getFirstRow('array');
    }

    /**
     * Insère un item dans un devis avec la quantité spécifiée.
     *
     * @param int $devisId L'identifiant du devis.
     * @param int $itemId L'identifiant de l'item.
     * @param int $quantity La quantité de l'item.
     */
    public function insertItem($devisId, $itemId, $quantity)
    {
        $this->devisItemModel->insert([
            'devis_id' => $devisId,
            'item_id' => $itemId,
            'quantity' => $quantity
        ]);
    }
}
