<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php $success = $request->session()->getFlash('success') ?>

                <?php if ($success): ?>
                    <div class="alert alert-success" role="alert">
                        <?= $success ?>
                    </div>
                <?php endif; ?>

                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="bi bi-person-badge"></i> Panneau d'administration</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-info-circle-fill fs-1"></i>
                            <h4 class="alert-heading">Bonjour <?= $_SESSION['user'];?>!</h4>
                            <p>Bienvenue dans le panneau d'administration.</p>
                        </div>
                        <div class="mt-4">
                            <p class="lead">Vous êtes connecté en tant qu'administrateur</p>
                        </div>

                        <a href="/logout" class="btn btn-danger">Déconnexion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>