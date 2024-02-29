<?= \Config\Services::validation()->listErrors() ?>
<!DOCTYPE html>
<html>


<section class="ml-5 mb-5">
    <h1>Liste des items</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Tarif</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <?= $item['id'] ?>
                    </td>
                    <td>
                        <?= $item['description'] ?>
                    </td>
                    <td>
                        <?= $item['price'] ?>
                    </td>
                    <td>
                        <a href="/items/delete/<?= $item['id'] ?>"class="btn btn-primary">Supprimer</a>
                        <a href="/items/view/<?= $item['id'] ?>"class="btn btn-primary">Voir</a>
                        <a href="/items/edit/<?= $item['id'] ?>"class="btn btn-primary">Modifier</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <a href="/items/create/"class="btn btn-primary">Créer un nouvel item</a>

        </tbody>
    </table>
</section>

</html>