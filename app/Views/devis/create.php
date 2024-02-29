<?= \Config\Services::validation()->listErrors() ?>

<section class="ml-5 mb-5">

<h1>Créer un nouveau devis</h1>
<form method="post" action="/devis/create">

    <!-- Champ pour sélectionner le nom du client -->
    <label for="user_id">Nom du Client:</label>
    <select name="user_id" id="user_id">
        <!-- Options générées par PHP avec l'ID et le nom de chaque client -->
        <?php foreach ($users as $user): ?>
            <option value="<?= $user['id'] ?>">
                <?= $user['user_name'] ?>
            </option>
        <?php endforeach; ?>
    </select>


    <!-- Champ pour sélectionner la date -->
    <label for="created_at">Date:</label>
    <input type="date" name="created_at" id="created_at" value="<?= date('Y-m-d') ?>">


    <!-- Section pour ajouter des items au devis -->
    <h3>Ajouter des Items au Devis</h3>

    <!-- Une boucle pour parcourir tous les items disponibles -->
    <?php foreach ($items as $item): ?>
        <div>
            <!-- Afficher la description et le prix de l'item -->
            <label>
                <?= $item['description'] ?> - <span class="item_price">
                    <?= $item['price'] ?>
                </span>€
            </label>

            <!-- Case à cocher pour sélectionner l'item -->
            <input type="checkbox" class="item_checkbox" name="items[]" value="<?= $item['id'] ?>">

            <!-- Champ pour spécifier la quantité de l'item -->
            <label for="quantity">Quantité:</label>
            <input type="number" class="item_quantity" name="quantities[<?= $item['id'] ?>]" min="0" value="0">

            <!-- Afficher le prix total pour cet item (quantité * prix) -->
            <label>Total: <span class="total_item_price">0.00</span> €</label>
        </div>
    <?php endforeach; ?>

    <!-- Afficher le total général du devis -->
    <h3>Total: <span id="total_devis">0</span> €</h3>

    <input type="submit" value="Enregistrer le devis"class="btn btn-primary">

    
<script>
    // Fonction pour calculer le total du devis en fonction des quantités sélectionnées
    function calculerTotal() {
        let total = 0;
        const itemQuantities = document.querySelectorAll('.item_quantity');
        const itemPrices = document.querySelectorAll('.item_price');

        itemQuantities.forEach((quantityInput, index) => {
            const quantity = parseInt(quantityInput.value) || 0;
            const price = parseFloat(itemPrices[index].textContent);
            const itemTotal = quantity * price;
            total += itemTotal;
            // Mettre à jour le total de l'item
            document.querySelectorAll('.total_item_price')[index].textContent = itemTotal.toFixed(2);
        });

        // Mettre à jour le total affiché dans la page
        document.getElementById('total_devis').textContent = total.toFixed(2);
    }

    // Écouteurs d'événements pour mettre à jour les quantités lors de la sélection/désélection des cases à cocher
    const itemCheckboxes = document.querySelectorAll('.item_checkbox');
    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const associatedQuantityInput = this.parentElement.querySelector('.item_quantity');
            associatedQuantityInput.value = this.checked ? '1' : '0';
            calculerTotal(); // Mettre à jour le total une fois que la quantité est mise à jour
        });
    });

    // Écouteurs d'événements pour mettre à jour le total du devis lors de la modification des quantités
    const itemQuantityInputs = document.querySelectorAll('.item_quantity');
    itemQuantityInputs.forEach(quantityInput => {
        quantityInput.addEventListener('input', function () {
            // Mettre à jour le total chaque fois que la quantité est modifiée
            calculerTotal();
            // Cocher ou décocher la case en fonction de la quantité
            const associatedCheckbox = this.parentElement.querySelector('.item_checkbox');
            associatedCheckbox.checked = parseInt(this.value) > 0;
        });
    });

    // Appeler la fonction de calcul du total une fois au chargement de la page
    window.addEventListener('load', calculerTotal);
</script>

</form>

</section>