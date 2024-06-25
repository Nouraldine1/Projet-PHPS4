<?php
Session::ouvrir();
$errors = Session::get("errors") ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .is-invalid {
            border-color: #e3342f; /* Rouge */
        }
    </style>
</head>
<body>
    <div class="container mx-auto mt-4 px-4">
        <div class="flex justify-center items-center mb-3">
            <h2 class="text-2xl font-bold">Connexion</h2>
        </div>

        <div class="flex justify-center mb-4">
            <form action="<?= WEBROOT ?>?controller=securite&action=connexion" method="POST" class="w-full md:w-1/2 flex flex-col">
                <div class="mb-4">
                    <input type="text" name="login" placeholder="Nom d'utilisateur" class="border px-4 py-2 w-full h-12 rounded-md <?= add_class_invalid('login') ?>" value="<?= htmlspecialchars($_POST['login'] ?? '') ?>">
                    <?php if (!empty($errors['login'])): ?>
                        <div class="text-sm text-red-500 mt-2"><?= htmlspecialchars($errors['login']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-4">
                    <input type="password" name="password" placeholder="Mot de passe" class="border px-4 py-2 w-full h-12 rounded-md <?= add_class_invalid('password') ?>" >
                    <?php if (!empty($errors['password'])): ?>
                        <div class="text-sm text-red-500 mt-2"><?= htmlspecialchars($errors['password']) ?></div>
                    <?php endif; ?>
                    <input type="hidden" name="controller" value="securite">
                    <input type="hidden" name="action" value="connexion">
                </div>
                <button type="submit" class="btn bg-purple-600 text-white px-3 py-2 rounded-md">Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php Session::remove("errors"); ?>

