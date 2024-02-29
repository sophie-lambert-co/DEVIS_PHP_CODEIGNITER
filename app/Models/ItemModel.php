<?php 

namespace App\Models;

use CodeIgniter\Model;

/**
 * Le ItemModel est un exemple de modèle simple dans CodeIgniter. Il est utilisé pour interagir avec la table items dans la base de données.
 */
class ItemModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'items';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $allowedFields = ['description', 'price'];

     /**
     * @var bool
     */
    protected $useSoftDeletes = true; // Utilisation de la suppression douce

     /**
     * @var array
     */
    protected $useTimestamps = true; // Utilisation des timestamps pour created_at et updated_at

    /**
     * @var string
     */
    protected $deletedField = 'deleted_at'; // Champ de suppression douce




    
/**
 * Cette fonction récupère tous les devis associés à un item spécifique.
 *
 * @param int $itemId L'identifiant de l'item.
 * 
 * @return array Un tableau contenant tous les devis associés à l'item spécifié.
 */
public function getDevis(int $itemId): array
{
    // On commence par sélectionner la table 'devis_items'
    return $this->db->table('devis_items')
        // On joint la table 'devis' sur la condition que 'devis.id' soit égal à 'devis_items.devis_id'
        ->join('devis', 'devis.id = devis_items.devis_id')
        // On ajoute une condition où 'devis_items.item_id' doit être égal à l'identifiant de l'item passé en paramètre
        ->where('devis_items.item_id', $itemId)
        // On sélectionne tous les champs de la table 'devis'
        ->select('devis.*')
        // On exécute la requête
        ->get()
        // On retourne le résultat sous forme de tableau
        ->getResultArray();
}
    // Ajoutez des méthodes supplémentaires si nécessaire
}