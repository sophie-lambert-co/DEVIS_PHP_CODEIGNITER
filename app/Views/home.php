<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>devis_codeIgniter</title>

    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../custom.css">
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5 navbar-custom">
  <a class="navbar-brand" href="#">Devis CodeIgniter</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Rectangle pour la connexion -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Connexion</h5>
                        <p class="card-text">Déjà membre ? Connectez-vous ici.</p>
                        <a href="/login" class="btn btn-primary">Se connecter</a>
                    </div>
                </div>
            </div>

            <!-- Rectangle pour la création de compte -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Créer un compte</h5>
                        <p class="card-text">Nouveau ici ? Créez un compte.</p>
                        <a href="/clients/register" class="btn btn-primary">Créer un compte</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>