<!-- clients/view.php -->
<?= \Config\Services::validation()->listErrors() ?>

<section class="ml-5 mb-5">

    <h1>Client</h1>

    <p style="margin-bottom: 1em;">Date de création :
        <?= $user->created_at ?> <!-- Utilisation de la notation d'objet -->
    </p>
    <p style="margin-bottom: 1em;">Nom de l'utilisateur :
        <?= $user->user_name ?> <!-- Utilisation de la notation d'objet -->
    </p>
    
    <h2>Informations Client</h2> <!-- Correction du titre -->

    <p style="margin-bottom: 1em;">N° SIRET:
        <?= $user->n_siret ?> <!-- Utilisation de la notation d'objet -->
    </p>
    <p style="margin-bottom: 1em;">Adresse de l'entreprise:
        <?= $user->adresse_entrprise ?> <!-- Utilisation de la notation d'objet -->
    </p>
    <p style="margin-bottom: 1em;">Téléphone:
        <?= $user->tel ?> <!-- Utilisation de la notation d'objet -->
    </p>
    <p style="margin-bottom: 1em;">Email:
        <?= $user->email ?> <!-- Utilisation de la notation d'objet -->
    </p>

    <h2>Devis client: <?= $user->user_name ?></h2> <!-- Correction du titre -->
    <!-- ... -->

    <div style="display: flex; gap: 1em;">
        <?php if ($user->is_admin == 1) : ?>
            <a href="/admin/view/<?= $user->id ?>"class="btn btn-primary">Accéder au tableau de bord administrateur</a>
        <?php endif; ?>
        <a href="/clients/edit/<?= $user->id ?>"class="btn btn-primary">Modifier</a> 
        <a href="/clients/delete/<?= $user->id ?>"class="btn btn-primary">Supprimer</a> 
        <a href="/devis/create/"class="btn btn-primary">Créer un devis</a>
    </div>

</section>
