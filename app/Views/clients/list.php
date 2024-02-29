<!DOCTYPE html>
<html>
<section class="ml-5 mb-5">

    <h1>Liste des clients</h1>

  
    <form method="get" action="/clients/search">
    <input type="text" name="search" placeholder="Rechercher par user_name">
    <input type="submit" value="Rechercher">
</form>

    <table>
        <tr>
            <th>User Name</th>
            <th>Date de création</th>
            <th>n° Siret</th>
            <th>Adresse entreprise</th>
            <th>tel</th>
            <th>email</th>
        </tr>
        <?php foreach ($user as $users) : ?>
            <tr>
                <td><?= $users->user_name ?></td>
                <td><?= $users->created_at ?></td>
                <td><?= $users->n_siret ?></td>
                <td><?= $users->adresse_entrprise ?></td>
                <td><?= $users->tel ?></td>
                <td><?= $users->email ?></td>
                <td>
                <div style="display: flex;">
                    <a href="/clients/view/<?= $users->id?>" class="btn btn-primary btn-sm mr-2">Consulter</a>
                    <a href="/clients/edit/<?= $users->id ?>" class="btn btn-primary btn-sm">Modifier</a>
                </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
</html>