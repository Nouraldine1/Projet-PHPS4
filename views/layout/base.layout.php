<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.5.2/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100">
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <!-- <div class="flex-shrink-0">
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg"
                            alt="Workflow">
                    </div> -->
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">
                            <!-- Menu links -->
                            <a href="<?= WEBROOT ?>?controller=article&action=lister-article"
                                class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900"
                                aria-current="page">Articles</a>
                            <a href="<?= WEBROOT ?>?controller=appro&action=form-appro" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white <?= has_role('Responsable Stock')| has_role('Gestionnaire') ?>">Approvisionnement</a>
                            <a href="<?= WEBROOT ?>?controller=production&action=lister-production"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white <?= has_role('Responsable Production')| has_role('Gestionnaire') ?>">Production</a>
                            <a href="<?= WEBROOT ?>?controller=vente&action=lister-vente"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white <?= has_role('Vendeur') | has_role('Gestionnaire')?>">Ventes</a>
                            <a href="<?= WEBROOT ?>?controller=fournisseur&action=lister-fournisseur"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white <?= has_role('Gestionnaire') | has_role('Gestionnaire') ?>">Fournisseurs</a>
                            <a href="<?= WEBROOT ?>?controller=client&action=lister-client"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white <?= has_role('Gestionnaire') ?>">Clients</a>
                            <a href="<?= WEBROOT ?>?controller=user&action=lister-responsable-stock"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white <?= has_role('Gestionnaire') ?>">Responsables Stock</a>
                            <a href="<?= WEBROOT ?>?controller=user&action=lister-responsable-production"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white <?= has_role('Gestionnaire') ?>">Responsables Production</a>
                            <a href="<?= WEBROOT ?>?controller=user&action=lister-vendeur"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white <?= has_role('Gestionnaire') ?>">Vendeurs</a>
                            <?php if (Autorisation::hasRole('Gestionnaire')): ?>
                            <div class="relative inline-block text-left" x-data="{ open: false }">
                                <div>
                                    <button @click="open = !open" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-gray-800 px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                        Paramétrage
                                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                                <div x-show="open" @click.outside="open = false" class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                    <div class="py-1" role="none">
                                        <a href="<?= WEBROOT ?>?controller=categorie&action=lister-categorie" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0">Catégories</a>
                                        <a href="<?= WEBROOT ?>?controller=type&action=lister-type" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">Types</a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <!-- Profile dropdown -->
                    <div class="relative ml-3" x-data="{ open: false }">
                        <div>
                            <button @click="open = !open" type="button"
                                class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="">
                            </button>
                        </div>
                        <div x-show="open" @click.outside="open = false"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <?php if (Session::get('userConnect')): 
                                $user = Session::get('userConnect');
                            ?>
                            <span class="block px-4 py-2 text-sm text-gray-700"><?= htmlspecialchars($user['nomComplet']) ?> (<?= htmlspecialchars($user['name']) ?>)</span>
                            <a href="<?= WEBROOT ?>?controller=securite&action=logout"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                tabindex="-1" id="user-menu-item-0">Déconnexion</a>
                            <?php else: ?>
                            <a href="<?= WEBROOT ?>?controller=securite&action=form-connexion"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                tabindex="-1" id="user-menu-item-1">Connexion</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex-1 p-5">
        <?php echo $contentView; ?>
    </div>
</body>

</html>
