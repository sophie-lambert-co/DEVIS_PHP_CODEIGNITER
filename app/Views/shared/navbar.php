<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
  <a class="navbar-brand" href="/">Devis CodeIgniter</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/clients/logout">Se déconnecter</a>
      </li>
      <li class="nav-item">
    <?php $session = \Config\Services::session(); ?>
    <a class="nav-link" href="/clients/view/<?php echo $session->get('user_id'); ?>">
        <?php echo $session->get('user_name'); ?> 
    </a>
</li>
    </ul>
  </div>
</nav>


