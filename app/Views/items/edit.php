<?= \Config\Services::validation()->listErrors() ?>
<section class="ml-5 mb-5">
<form action="/items/update/<?= $item['id'] ?>" method="post">
    
    <label for="description">Description</label>
    <input type="text" name="description" value="<?= $item['description'] ?>">

    <label for="price">Price</label>
    <input type="text" name="price" value="<?= $item['price'] ?>">

    <!-- Ajoutez ici d'autres champs si nécessaire -->

  
    <input type="submit" value="Enregistrer"class="btn btn-primary">
   
</form>
</section>