<?php // app/Views/connection_detail.php 
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Détails de la demande') ?></title>
    <link href="<?= base_url() ?>/V2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ====== Reset léger ====== */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            color: #1d1d1f;
            background: #f6f7fb;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ====== Page container ====== */
        .wrap {
            max-width: 1200px;
            margin: 36px auto;
            padding: 24px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(17, 24, 39, 0.08);
        }

        /* ====== Header ====== */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit;
        }

        .brand img {
            height: 44px;
            width: auto;
            display: block;
        }

        .brand h1 {
            font-size: 18px;
            margin: 0;
            font-weight: 600;
            letter-spacing: 0.2px;
            color: #0b57a4;
        }

        /* ====== Controls: search + new button ====== */
        .controls {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            border-radius: 10px;
            padding: 6px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6);
        }

        .search input[type="text"] {
            border: 0;
            outline: 0;
            background: transparent;
            padding: 10px 12px;
            font-size: 14px;
            min-width: 260px;
        }

        .search button {
            background: #0b57a4;
            color: #fff;
            border: 0;
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        .action-btn {
            display: inline-block;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            background: linear-gradient(180deg, #0b57a4, #084b8f);
            color: #fff;
            box-shadow: 0 6px 18px rgba(11, 87, 164, 0.18);
        }

        /* ====== Table block ====== */
        .table-wrap {
            margin-top: 18px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e6eef8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        thead {
            background: linear-gradient(90deg, #f8fbff, #eef6ff);
        }

        thead th {
            text-align: left;
            padding: 14px 18px;
            font-size: 13px;
            color: #284b66;
            font-weight: 700;
            letter-spacing: 0.2px;
            border-bottom: 1px solid rgba(16, 24, 40, 0.04);
        }

        tbody td {
            padding: 14px 18px;
            font-size: 14px;
            color: #344054;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        tbody tr:hover {
            background: #fbfdff;
        }

        /* Badge status */
        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 12px;
            color: #fff;
        }

        .badge--approved {
            background: #16a34a;
        }

        /* green */
        .badge--pending {
            background: #f59e0b;
        }

        /* amber */
        .badge--closed {
            background: #6b7280;
        }

        /* gray */

        /* Small helper */
        .muted {
            color: #6b7280;
            font-size: 13px;
        }

        /* ====== Pagination styling - adapts to CI pager markup (ul.pagination) ====== */
        .pagination {
            display: flex;
            gap: 8px;
            list-style: none;
            padding: 12px;
            justify-content: center;
            margin: 0;
            flex-wrap: wrap;
        }

        .pagination li a,
        .pagination li span {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: #0b57a4;
            border: 1px solid transparent;
            background: transparent;
            font-weight: 600;
        }

        .pagination li.active a,
        .pagination li.active span {
            background: #0b57a4;
            color: #fff;
            border-color: transparent;
            box-shadow: 0 6px 18px rgba(11, 87, 164, 0.12);
        }

        .pagination li.disabled span {
            color: #c7cbd3;
        }

        /* ====== Mobile responsiveness ====== */
        @media (max-width: 900px) {
            .brand h1 {
                font-size: 16px;
            }

            .search input[type="text"] {
                min-width: 140px;
            }

            .table-wrap {
                overflow: auto;
            }

            tbody td {
                padding: 12px;
                font-size: 13px;
            }
        }

        @media (max-width: 520px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .controls {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>

<body>
    <div class="container-main">
        <main class="wrap" role="main" aria-labelledby="pageTitle">
            <div class="topbar">
                <a class="brand" href="<?= site_url() ?>">
                    <img src="<?= base_url('/assets/images/branding.png') ?>" alt="Eneo Cameroon logo">
                    <h1 id="pageTitle">Portail - Demandes de branchement</h1>
                </a>
            </div>

            <legend><?= lang('App.pageTitle'); ?></legend>

            <p class="info-text">
                <?php if ($data['connection_type'] != 3) : ?>
                    Nom du demandeur : <?= esc("{$data['civility']} {$data['title']}") ?> <br>
                    Numéro de la demande : <?= esc($data['ticket_public']) ?>
                <?php else: ?>
                    Bonjour <?= esc("{$data['civility']} {$data['title']}") ?>, <?= esc("{$data['identity_type']} {$data['identity_number']}") ?>,
                    votre demande de conversion N° <?= esc($data['ticket_public']) ?> a été prise en compte.
                    Rendez-vous à votre Agence ENEO ou contactez l'agence en ligne.
                <?php endif; ?>
            </p>

            <?php if ($data['connection_type'] != 3 && $data['work_request_number']) : ?>
                <ul class="progressbar">
                    <li class="<?= $data['work_request_number'] ? 'active' : '' ?>"><?= lang('App.request'); ?></li>
                    <li class="<?= $data['quotation_amount'] ? 'active' : '' ?>">Work request</li>
                    <li><?= lang('App.quotation'); ?></li>
                    <li><?= lang('App.connection'); ?></li>
                </ul>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><?= lang('App.request'); ?></th>
                            <th><?= lang('App.quotation'); ?></th>
                            <th><?= lang('App.amount'); ?></th>
                            <th><?= lang('App.period'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= esc($data['ticket_public']) ?></td>
                            <td><?= $data['quotation_amount'] ? 'Disponible' : 'En cours' ?></td>
                            <td><?= esc($data['quotation_amount'] ?? lang('App.unavailable')) ?></td>
                            <td><?= esc($data['quotation_date'] ?? lang('App.unavailable')) ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php endif; ?>

            <section class="table-wrap" aria-labelledby="tableTitle">
                <h2 id="tableTitle" style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden;">📎 Pièces jointes</h2>

                <table role="table" aria-describedby="tableDesc">
                    <thead>
                        <tr>
                            <th scope="col">Description</th>
                            <th scope="col">Prévisualisation</th>
                            <th scope="col">Téléchargement</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($attachments) && count($attachments) > 0) : ?>
                            <?php foreach ($attachments as $file) : ?>
                                <tr>
                                    <td>
                                        <?= esc($file['description']) ?>
                                    <td>
                                        <?php if (preg_match('/\.(jpg|jpeg|png|gif|pdf)$/i', $file['filename'])) : ?>
                                            <a href="<?= site_url('attachments/preview/' . $file['id']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Voir</a>
                                        <?php else: ?>
                                            <span class="text-muted">Non disponible</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('attachments/download/' . $file['id']) ?>" class="btn btn-sm btn-outline-success">Télécharger</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align:center; padding:28px 18px;">
                                    <div class="muted">Aucune demande trouvée — utilisez la recherche ou créez une nouvelle demande.</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>

            <p><a href="<?= base_url() ?>" class="action-link">← Retour à l'accueil</a></p>
        </main>
    </div>
</body>

</html>