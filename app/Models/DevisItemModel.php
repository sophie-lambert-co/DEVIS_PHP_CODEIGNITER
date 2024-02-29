<?php

namespace App\Models;

use CodeIgniter\Model;

class DevisItemModel extends Model
{
    /**
     * @var int
     */
    protected $table = 'devis_items'; // Nom de la table dans la base de données

    /**
     * @var int
     */
    protected $primaryKey = 'id'; // Clé primaire de la table

    /**
     * @var array
     */
    protected $allowedFields = ['devis_id', 'item_id', 'quantity', 'custom_price']; // Champs autorisés pour l'insertion et la mise à jour

    
     /**
     * @var bool
     */
    protected $useTimestamps = true; // Utilisation des timestamps pour created_at et updated_at

    
      /**
     * @var string
     */
    protected $deletedField = 'deleted_at'; // Champ de suppression douce


 

    // Autres propriétés et méthodes selon vos besoins...
}
