<?php
require_once ("../core/Session.php");
?>

<div class="container mx-auto mt-5">
    <div class="flex justify-center">
        <div class="w-full lg:w-3/4">
            <div class="bg-white shadow-md rounded-md p-6">
                <h2 class="text-2xl font-bold mb-4 text-center">Approvisionnement</h2>
                <form method="POST" action="<?= WEBROOT ?>">
                    <input type="hidden" name="controller" value="appro">
                    <input type="hidden" name="action" value="add-article">
                    <div class="mb-4">
                        <label for="fournisseur" class="block text-sm font-medium text-gray-700">Fournisseur</label>
                        <select id="fournisseur" name="fournisseur_Id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <option value="">---</option>
                            <?php foreach ($fournisseurs as $fournisseur): ?>
                                <option value="<?= $fournisseur['id'] ?>" <?= (Session::get("panier") && Session::get("panier")->fournisseur == $fournisseur['id']) ? 'selected' : '' ?>>
                                    <?= $fournisseur['nomFour'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="flex mb-4 space-x-4">
                        <div class="w-1/2">
                            <label for="article_Id" class="block text-sm font-medium text-gray-700">Article</label>
                            <select id="article_Id" name="article_Id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">---</option>
                                <?php foreach ($articles as $article): ?>
                                    <option value="<?= $article['id'] ?>"><?= $article['libelle'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="w-1/4">
                            <label for="qteAppro" class="block text-sm font-medium text-gray-700">Quantité</label>
                            <input type="number" id="qteAppro" name="qteAppro" placeholder="Quantité"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div class="w-1/4 flex items-end">
                            <button type="submit" id="add-article"
                                class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:bg-green-700">Ajouter</button>
                        </div>
                    </div>
                    <div class="mt-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Article
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantité
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Prix
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Montant
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="articles-list">
                                <?php if (Session::get('panier')): ?>
                                    <?php foreach (Session::get('panier')->articles as $article): ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= $article['libelle'] ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= $article['qteAppro'] ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= $article['prixAppro'] ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= $article['montantArticle'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="mt-6 flex justify-between items-center">
                    <div class="text-red-600 text-xl font-bold">Total: <span id="total-price"><?= Session::get('panier') ? Session::get('panier')->total : 0 ?></span> CFA</div>
                    <a href="<?= WEBROOT ?>?controller=appro&action=add-appro"
                        class="bg-purple-600 text-white px-8 py-4 rounded-md text-lg hover:bg-purple-700 focus:outline-none focus:bg-purple-700">Enregistrer</a>
                </div>
                <!-- <div class="mt-4 flex justify-end">
                    <a href="<?= WEBROOT ?>?action=Fermer-form"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 focus:outline-none focus:bg-gray-400">Fermer</a>
                </div> -->
            </div>
        </div>
    </div>
</div>
