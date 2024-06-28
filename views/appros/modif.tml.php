<form action="?controller=appro&action=modifier-appro" method="post">
    <input type="hidden" name="approId" value="<?= $appro['id'] ?>">
    
    <label for="fournisseur_Id">Fournisseur</label>
    <select name="fournisseur_Id">
        <?php foreach ($fournisseurs as $fournisseur): ?>
            <option value="<?= $fournisseur['id'] ?>" <?= $fournisseur['id'] == $appro['fournisseur_Id'] ? 'selected' : '' ?>>
                <?= $fournisseur['nom'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    
    <label for="montant">Montant</label>
    <input type="text" name="montant" value="<?= $appro['montant'] ?>">
    
    <label for="articles">Articles</label>
    <?php foreach ($articles as $article): ?>
        <div>
            <input type="checkbox" name="articles[]" value="<?= $article['id'] ?>" <?= in_array($article['id'], array_column($appro['details'], 'article_Id')) ? 'checked' : '' ?>>
            <?= $article['libelle'] ?>
            <input type="text" name="quantities[<?= $article['id'] ?>]" value="<?= $appro['details'][$article['id']]['qteAppro'] ?? '' ?>">
        </div>
    <?php endforeach; ?>
    
    <button type="submit">Modifier l'approvisionnement</button>
</form>
