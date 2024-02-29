<?php if (!empty($error)) : ?>
    <div class="alert alert-danger" role="alert">
        <?= esc($error) ?>
    </div>
<?php endif; ?>
<section class="ml-5 mb-5">
<form method="post" action="/authenticate" class="ml-5" >
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">

    <label for="password" class="ml-5">Mot de passe: </label >
    <input type="password" id="password" name="password" >

    <input type="submit" value="Se connecter"class="btn btn-primary">
</form>
</section>




