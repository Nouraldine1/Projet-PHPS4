<?php
Session::ouvrir();
$errors = Session::get("errors") ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .is-invalid {
            border-color: #e3342f; /* Rouge */
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-4 px-4">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-2xl font-bold">Ajouter un Utilisateur</h2>
        </div>

        <!-- Formulaire d'ajout d'utilisateur -->
        <div class="flex justify-center mb-4">
            <form action="<?= WEBROOT ?>?controller=user&action=add-user" method="POST" class="w-full md:w-1/2 flex flex-col space-y-2">
                <input type="hidden" name="controller" value="user">
                <input type="hidden" name="action" value="add-user">
                
                <div class="mb-4">
                    <input type="text" name="nomComplet" placeholder="Nom complet" class="border px-4 py-2 w-full h-12 rounded-md <?= !empty($errors['nomComplet']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($_POST['nomComplet'] ?? '') ?>">
                    <?php if (!empty($errors['nomComplet'])): ?>
                        <div class="text-sm text-red-500 mt-2"><?= htmlspecialchars($errors['nomComplet']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <input type="text" name="login" placeholder="Login" class="border px-4 py-2 w-full h-12 rounded-md <?= !empty($errors['login']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($_POST['login'] ?? '') ?>">
                    <?php if (!empty($errors['login'])): ?>
                        <div class="text-sm text-red-500 mt-2"><?= htmlspecialchars($errors['login']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <input type="password" name="password" placeholder="Mot de passe" class="border px-4 py-2 w-full h-12 rounded-md <?= !empty($errors['password']) ? 'is-invalid' : '' ?>">
                    <?php if (!empty($errors['password'])): ?>
                        <div class="text-sm text-red-500 mt-2"><?= htmlspecialchars($errors['password']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <select name="role" class="border px-4 py-2 w-full h-12 rounded-md <?= !empty($errors['role']) ? 'is-invalid' : '' ?>"  >
                        <option value="">Sélectionnez un rôle</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?php echo $role['id']; ?>" <?= isset($_POST['role']) && $_POST['role'] == $role['id'] ? 'selected' : '' ?>><?php echo htmlspecialchars($role['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['role'])): ?>
                        <div class="text-sm text-red-500 mt-2"><?= htmlspecialchars($errors['role']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <input type="text" name="tel" placeholder="Téléphone" class="border px-4 py-2 w-full h-12 rounded-md <?= !empty($errors['tel']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($_POST['tel'] ?? '') ?>">
                    <?php if (!empty($errors['tel'])): ?>
                        <div class="text-sm text-red-500 mt-2"><?= htmlspecialchars($errors['tel']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <input type="text" name="adresse" placeholder="Adresse" class="border px-4 py-2 w-full h-12 rounded-md <?= !empty($errors['adresse']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($_POST['adresse'] ?? '') ?>">
                    <?php if (!empty($errors['adresse'])): ?>
                        <div class="text-sm text-red-500 mt-2"><?= htmlspecialchars($errors['adresse']) ?></div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn bg-purple-600 text-white px-3 py-2 rounded-md">Ajouter</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php Session::remove("errors"); ?>
