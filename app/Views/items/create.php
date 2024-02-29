<?= \Config\Services::validation()->listErrors() ?>

<section class="ml-5 mb-5">
<h1>Créer un nouvel item</h1>
<form method="post" action="/items/create">
    <label for="description">Description</label>
    <input type="text" id="description" name="description">
    <label for="price">Prix</label>
    <input type="text" id="price" name="price">
    <input type="submit" value="Créer"class="btn btn-primary">
</form>
</section>