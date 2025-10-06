<!Doctype html>
<html lang="en">

<head>
    <title>Eneo Cameroon - <?= $this->renderSection('title') ?></title>
    <?= $this->include('layouts/partials/_metas') ?>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/favicon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet"    href="<?= base_url() ?>/assets/css/style.css" >
</head>

<body>
    <?= $this->renderSection('content') ?>
    <!-- <script src="<?= base_url() ?>/assets/js/script.js"></script> -->
</body>

</html>