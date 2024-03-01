<!DOCTYPE html>
<html>
<section class="ml-5 mb-5">
    <title>Liste des devis</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
    </style>


    <h1>Liste des devis</h1>

    <form method="get">
        <input type="text" name="search" placeholder="Rechercher par user_name">
        <input type="submit" value="Rechercher">
    </form>

    <table>
        <tr>
            <th>User Name</th>
            <th>Date de création</th>
            <th>Total du devis</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($devis as $deviItem) : ?>
            
            <tr>
                <td><?= $deviItem['user_name'] ?></td>
                <td><?= $deviItem['created_at'] ?></td>
                <td><?= $deviItem['total_devis'] ?></td>
                <td>
                    <a href="/devis/view/<?= $deviItem['id'] ?>"class="btn btn-primary">Consulter</a>
                    <a href="/devis/edit/<?= $deviItem['id'] ?>"class="btn btn-primary">Modifier</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
</html>