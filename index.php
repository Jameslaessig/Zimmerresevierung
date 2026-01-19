<?php
require_once "classes/Gast.php";
require_once "classes/Zimmer.php";
require_once "classes/Reservierung.php";


if (isset($_POST['add_gast'])) {
    $gast = new Gast($_POST['name'], $_POST['email'], $_POST['adresse']);
    $gast->save();
}

if (isset($_POST['add_res'])) {
    $gastData   = Gast::getById($_POST['gast_id']);
    $zimmerData = Zimmer::getById($_POST['zimmer_id']);

    $gast   = new Gast($gastData['name'], $gastData['email'], $gastData['adresse'], $gastData['id']);
    $zimmer = new Zimmer(
        $zimmerData['nr'],
        $zimmerData['name'],
        $zimmerData['personen'],
        $zimmerData['preis'],
        $zimmerData['balkon'],
        $zimmerData['id']
    );

    $res = new Reservierung($_POST['start'], $_POST['ende'], $gast, $zimmer);
    $res->save();
}

$gaeste = Gast::getAll();
$zimmer = Zimmer::getAll();
$reservierungen = Reservierung::getAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Zimmerreservierung</title>

    <!-- BOOTSTRAP CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container my-4">

    <h1 class="mb-4">🏨 Zimmerreservierung</h1>

    <div class="card mb-4">
        <div class="card-header">Gast anlegen</div>
        <div class="card-body">
            <form method="post" class="row g-3">
                <div class="col-md-4">
                    <input class="form-control" name="name" placeholder="Name" required>
                </div>
                <div class="col-md-4">
                    <input class="form-control" name="email" placeholder="E-Mail" required>
                </div>
                <div class="col-md-4">
                    <input class="form-control" name="adresse" placeholder="Adresse" required>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" name="add_gast">Speichern</button>
                </div>
            </form>
        </div>
    </div>


    <div class="card mb-4">
        <div class="card-header">Gäste</div>
        <ul class="list-group list-group-flush">
            <?php foreach ($gaeste as $g): ?>
                <li class="list-group-item">
                    <?= htmlspecialchars($g['name']) ?> (<?= htmlspecialchars($g['email']) ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="card mb-4">
        <div class="card-header">Reservierung anlegen</div>
        <div class="card-body">
            <form method="post" class="row g-3">

                <div class="col-md-3">
                    <label>Gast</label>
                    <select name="gast_id" class="form-select">
                        <?php foreach ($gaeste as $g): ?>
                            <option value="<?= $g['id'] ?>"><?= $g['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Zimmer</label>
                    <select name="zimmer_id" class="form-select">
                        <?php foreach ($zimmer as $z): ?>
                            <option value="<?= $z['id'] ?>"><?= $z['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Start</label>
                    <input type="date" name="start" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Ende</label>
                    <input type="date" name="ende" class="form-control" required>
                </div>

                <div class="col-12">
                    <button class="btn btn-success" name="add_res">Reservieren</button>
                </div>

            </form>
        </div>
    </div>


    <div class="card">
        <div class="card-header">Reservierungen</div>
        <ul class="list-group list-group-flush">
            <?php foreach ($reservierungen as $r): ?>
                <li class="list-group-item">
                    <?= $r['gastname'] ?> – <?= $r['zimmername'] ?>
                    (<?= $r['start'] ?> bis <?= $r['ende'] ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>

</body>
</html>
