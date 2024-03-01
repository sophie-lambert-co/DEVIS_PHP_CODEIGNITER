<!DOCTYPE html>
<html>

<section class="ml-5 mb-5">
    <h1>Devis</h1>
    <?php foreach ($devis as $devi): ?>

    <p>Date de création : <?= $devi['created_at'] ?></p>

    <h2>Items</h2>
    <p>Total du devis : <?php $devi['total_devis'] ?></p>
    <a href="/devis/list" class="btn btn-primary">Retour à la liste</a>
    <a href="/devis/edit/<?= $devi['id'] ?>"class="btn btn-primary">Modifier</a>
    <a href="/devis/list/<?= $devi['id'] ?>"class="btn btn-primary">Supprimer</a>
    <?php endforeach; ?>

    <table>
        <tr>
            <th>Nom de l'item</th>
            <th>Prix</th>
            <th>Quantité</th>
        </tr>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $item['description'] ?></td>
                <td><?= $item['price'] ?></td>
                <td><?= $item['quantity'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    
    <section class="ml-5">
</html>