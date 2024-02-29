<?= \Config\Services::validation()->listErrors() ?>
<!DOCTYPE html>
<html>

<section class="ml-5 mb-5">
    <h1>Détails de l'item</h1>

  
    <p>Description: <?= $item['description'] ?></p>
    <p>Prix: <?= $item['price'] ?></p>

    <a href="/items/edit/<?= $item['id'] ?>"class="btn btn-primary">Modifier</a>
    <a href="/items/delete/<?= $item['id'] ?>"class="btn btn-primary">Supprimer</a>
    <a href="/items/list"class="btn btn-primary">Liste des items</a>
   
</section > 
</html>