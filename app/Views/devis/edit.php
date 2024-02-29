<!-- Affiche les erreurs de validation -->
<?= \Config\Services::validation()->listErrors() ?>
<!DOCTYPE html>
<html>

<section class="ml-5 mb-5">
    <h1 class="mb-5">Édition de devis</h1>

    <!-- Afficher les détails du devis -->
    <h2 class="mb-3">Détails du Devis</h2>
    <p class="mb-3">Identifiant du devis :
        <?= $devis['id'] ?>
    </p>
    <p class="mb-3"><strong>Nom du Client:</strong>
        <?= $user['user_name'] ?>
    </p>
    <p class="mb-5"><strong>Date de Création:</strong>
        <?= $devis['created_at'] ?>
    </p>

    <form action="/devis/update/<?= $devis['id'] ?>" method="post">
        <h3 class="mb-3">Items du Devis</h3>
        <?php foreach ($devis['items'] as $item): ?>
            <div class="mb-5">
                <p class="mb-3">
                    <?= $item['description'] ?> - <span class="item_price">
                        <?= $item['price'] ?>
                    </span>€
                </p>
                <label for="quantity_<?= $item['id'] ?>" class="mr-1">Quantité:</label>
                <input type="number" name="quantity[<?= $item['id'] ?>]" id="quantity_<?= $item['id'] ?>"
                    class="item_quantity mr-1" value="<?= $item['quantity'] ?>" min="1">
                <p class="mb-3">Total de l'item: <span class="total_item_price"></span>€</p>
                <div class="d-flex">
                    <a href="/devis/removeItem/<?= $devis['id'] ?>/<?= $item['id'] ?>"class="btn btn-primary mr-3"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?')">Supprimer</a>
                    <input type="submit" value="Mettre à jour les quantités"class="btn btn-primary">
                </div>
            </div>
        <?php endforeach; ?>

        <div class="mb-5">
            <label for="newItem" class="mr-1">Ajouter un item:</label>
            <select id="newItem" name="newItem" class="mr-1">
                <option value="">Sélectionnez un item...</option>
                <?php foreach ($allItems as $item): ?>
                    <option value="<?= $item['id'] ?>">
                        <?= $item['description'] ?> -
                        <?= $item['price'] ?>€
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="quantity" class="mr-1">Quantité:</label>
            <input type="number" name="newItemQuantity" value="1" min="1" class="mr-1">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>

    <h3 class="mb-5">Total du Devis: <span class="total_devis">
            <?= $devis['total_devis'] ?>
        </span> €</h3>

    <div class="d-flex">
        <form action="/devis/delete/<?= $devis['id'] ?>" method="post"
            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce devis?')">
            <button type="submit" class="btn btn-primary mr-3">Supprimer</button>
        </form>
        <a href="/devis/view/<?= $devis['id'] ?>" class="btn btn-primary">Retourner à la vue du devis</a>
    </div>
</section>




    <script>
        // Fonction pour calculer le total du devis en fonction des quantités sélectionnées
        function calculerTotal() {
            let total = 0;
            // Récupère tous les inputs de quantité
            const itemQuantities = document.querySelectorAll('.item_quantity');
            // Récupère tous les prix des items
            const itemPrices = document.querySelectorAll('.item_price');

            // Pour chaque input de quantité
            itemQuantities.forEach((quantityInput, index) => {
                // Récupère la quantité et le prix de l'item
                const quantity = parseInt(quantityInput.value) || 0;
                const price = parseFloat(itemPrices[index].textContent);
                // Calcule le total de l'item
                const itemTotal = quantity * price;
                // Ajoute le total de l'item au total du devis
                total += itemTotal;
                // Met à jour le total de l'item
                document.querySelectorAll('.total_item_price')[index].textContent = itemTotal.toFixed(2);
            });

            // Met à jour le total du devis
            document.querySelector('.total_devis').textContent = total.toFixed(2);
        }

        // Ajoute un gestionnaire d'événements 'change' à chaque input de quantité
        document.querySelectorAll('.item_quantity').forEach(quantityInput => {
            quantityInput.addEventListener('change', function () {
                // Calcule le total du devis lorsque la quantité change
                calculerTotal();
            });
        });

        // Calcule le total initial du devis
        calculerTotal();
    </script>