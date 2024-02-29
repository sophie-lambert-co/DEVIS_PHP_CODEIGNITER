<!DOCTYPE html>
<html>

<section class="ml-5 mb-5">
    <h1>Devis</h1>

    <p>Date de création : <?= $devis['created_at'] ?></p>
    <p>Nom de l'utilisateur : <?= $user['user_name'] ?></p>

    <h2>Items</h2>
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

    <p>Total du devis : <?= $devis['total_devis'] ?></p>

    <a href="/devis/list" class="btn btn-primary">Retour à la liste</a>
    <a href="/devis/edit/<?= $devis['id'] ?>"class="btn btn-primary">Modifier</a>
    <a href="/devis/list/<?= $devis['id'] ?>"class="btn btn-primary">Supprimer</a>
    <section class="ml-5">
</html>