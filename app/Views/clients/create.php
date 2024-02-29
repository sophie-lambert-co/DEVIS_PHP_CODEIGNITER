<section class="ml-5 mb-5">
    
    <?php if (\Config\Services::validation()->getErrors()) : ?>
        <!-- Affichage des erreurs de validation s'il y en a -->
        <div class="alert alert-danger">
            <?= \Config\Services::validation()->listErrors() ?>
        </div>
    <?php endif ?>

    <h1>Création de mon compte client</h1>
    <form method="post" action="/clients/register">

        <!-- Champ pour sélectionner la date -->
        <div class="form-group">
            <label for="created_at">Date:</label>
            <input type="date" class="form-control" name="created_at" id="created_at" value="<?= date('Y-m-d') ?>">
        </div>

        <!-- Champ pour le nom du client -->
        <div class="form-group">
            <label for="user_name">Nom du Client:</label>
            <input type="text" class="form-control" id="user_name" name="user_name">
        </div>

        <!-- Champ pour le numéro SIRET -->
        <div class="form-group">
            <label for="n_siret">N° SIRET:</label>
            <input type="text" class="form-control" id="n_siret" name="n_siret">
        </div>

        <!-- Champ pour l'adresse de l'entreprise -->
        <div class="form-group">
            <label for="adresse_entrprise">Adresse de l'entreprise:</label>
            <input type="text" class="form-control" id="adresse_entrprise" name="adresse_entrprise">
        </div>

        <!-- Champ pour le numéro de téléphone -->
        <div class="form-group">
            <label for="tel">Téléphone:</label>
            <input type="text" class="form-control" id="tel" name="tel">
        </div>

        <!-- Champ pour l'email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email">
        </div>

        <!-- Champ pour le mot de passe -->
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <!-- Bouton de soumission du formulaire -->
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</section>
