<!-- Affiche les erreurs de validation -->
<?= \Config\Services::validation()->listErrors() ?>
<!DOCTYPE html>
<html>
<section class="ml-5 mb-5">

    <title>Modification compte client</title>

    <h1 style="margin-bottom: 1em;">Utilisateur :
        <?= $user->user_name ?>
    </h1>

    <h2>Détails du Compte</h2>
    <p style="margin-bottom: 1em;">Date du creation du compte:
        <?= $user->created_at ?>
    </p>

    <form action="/clients/update/<?= $user->id ?>" method="post" style="margin-bottom: 1em;">

        <label for="n_siret">Numero siret :</label>
        <input type="text" name="n_siret" value="<?= $user->n_siret ?>">

        <label for="adresse_entrprise">Adresse de l'entreprise :</label>
        <input type="text" name="adresse_entrprise" value="<?= $user->adresse_entrprise ?>">

        <label for="tel">Tel :</label>
        <input type="text" name="tel" value="<?= $user->tel ?>">

        <label for="email">Email :</label>
        <input type="text" name="email" value="<?= $user->email ?>">

        <input type="submit" value="Enregistrer">

    </form>

    <div style="display: flex; gap: 1em;">
        <a href="/clients/view/<?= $user->id ?>"class="btn btn-primary">Consulter</a>
        <a href="/clients/delete/<?= $user->id ?>"class="btn btn-primary">Supprimer</a>
    </div>

</section>
</html>