<section class="ml-5 mb-5">
    <h1>Tableau de bord administrateur</h1>

    <h2>Informations de l'administrateur</h2>

    <!-- Affichage du nom de l'administrateur -->
    <p style="margin-bottom: 1em;">Nom de l'administrateur : <?= $user->user_name ?></p>

    <!-- Affichage de l'email de l'administrateur -->
    <p style="margin-bottom: 1em;">Email : <?= $user->email ?></p>

    <!-- Liens vers différentes fonctionnalités du tableau de bord -->
    <div style="display: flex; gap: 1em;">
        <!-- Lien vers la liste des devis -->
        <a href="/devis/list" class="btn btn-primary">liste des devis</a>
        <!-- Lien vers la liste des clients -->
        <a href="/clients/list" class="btn btn-primary">liste des clients</a>
        <!-- Lien vers la liste des items -->
        <a href="/items/list" class="btn btn-primary">liste des items</a>
        <!-- Lien vers la page de modification du profil de l'administrateur -->
        <a href="/clients/edit/<?= $user->id ?>" class="btn btn-primary">Modifier</a>
    </div>
</section>
