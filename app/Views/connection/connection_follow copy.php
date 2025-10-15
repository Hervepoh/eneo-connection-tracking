<DOCTYPE html>
    <html lang="en">

    <head>
        <title><?= $title ?></title>
        <meta name="author" content="">
        <meta name="rights" content="Eneo Cameroon S.A." />
        <meta name="description" content="Service dédié aux demandes de branchement" />
        <meta name="keywords" content="Eneo, cameroun, cameroon, energy, energie, fournisseur d'électricité, Electricité cameroun, Particuliers, entreprises, professionnels, industriels,Electricity Cameroon, ménages, abonnement, branchement, facture, paiement, mobile money, actualité, Economie d'énergie, Conseils sécurité, MyEasyLight, EasyLight, easyconnection, compteur,Centre de Presse, Alertes réseau, compteur,courant, Orange, MTN, Express Union, Express Exchange,Agence en ligne, Online Agency,Logo Eneo,Centrale gaz,Joel Nana Kontchou, Courant, Facture électronique, ebills, e-bills, electronic bills, Mobile Payement, Online Payement,Impayés,délestages, coupures,Outages,Emploi " />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <link href="<?= base_url() ?>/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
        <link rel="stylesheet" href="<?= base_url() ?>/V2/css/bootstrap.min.css">
        <link href="<?= base_url() ?>/dist/css/style.css" rel="stylesheet">
        <link href="<?= base_url() ?>/assets/css/progress-bar.css" rel="stylesheet">

        <script language="javascript" src="<?= base_url() ?>/V2/js/bootstrap.min.js"></script>
    </head>

    <body>

        <div class="text-center container" style="padding-bottom:120px; margin:10px auto;">
            <div class="row">

                <div class="col-md-6" style="padding-top:20px;">
                    <img src="<?= base_url() ?>/img/enteteMK_branchement.png" class="headImg">
                </div>

                <div class="col-md-6" style="padding-top:20px;">
                    <img src="<?= base_url() ?>/img/Web_main_Cover.png" class="headImg">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <legend class="text-center" style="font-weight:bold; padding-top:50px;padding-bottom:20px;color: #1B75BB">
                        <?= lang('App.pageTitle'); ?>
                    </legend>
                    <p class="col-md-10 offset-1">
                        <?php if ($data['connection_type'] != 3) : ?>
                            <?= <<<EOT
Nom du demanduer :  {$data['civility']} {$data['title']} ,<br/> Numéro de la demande : {$data['ticket_public']} . \x41
EOT;
                            ?>
                        <?php else: ?>
                            <?= <<<EOT
Bonjour {$data['civility']} {$data['title']} , {$data['identity_type']} {$data['identity_number']} , votre demande de conversion N°  {$data['ticket_public']} a bien été prise en compte .
Rendez vous à votre Agence ENEO ou contacter l'agence en Ligne: "Avenue Koumassi Bali, Douala I " Tel: (237)695 51 11 11 \x41
EOT;
                            ?>
                        <?php endif; ?>
                    </p>
                    <?php
                    if ($data['connection_type'] != 3) : ?>
                        <?php if ($data['work_request_number']) : ?>
                            <div class="container-progressbar">
                                <ul class="progressbar">
                                    <li class="<?= $data['work_request_number'] ? 'active' : '' ?>"><?= lang('App.request'); ?></li>
                                    <li class="<?= $data['quotation_amount'] ? 'active' : '' ?>"> Work request </li>
                                    <li class=""><?= lang('App.quotation'); ?></li>
                                    <li class=""><?= lang('App.connection'); ?></li>
                                </ul>
                            </div>
                            <table style="margin:110px auto 10px auto">
                                <!-- <caption>Statement Summary</caption> -->
                                <thead>
                                    <tr>
                                        <th scope="col"><?= lang('App.request'); ?></th>
                                        <th scope="col"><?= lang('App.quotation'); ?></th>
                                        <th scope="col"><?= lang('App.amount'); ?></th>
                                        <th scope="col"><?= lang('App.period'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-label=<?= lang('App.request'); ?>><?= $data['ticket_public'] ?></td>
                                        <td data-label=<?= lang('App.quotation'); ?>><?= $data['quotation_amount'] ? 'disponible' : 'En cours de chiffrement' ?></td>
                                        <td data-label=<?= lang('App.amount'); ?>><?= $data['quotation_amount'] ??  lang('App.unavailable'); ?></td>
                                        <td data-label=<?= lang('App.period'); ?>><?= $data['quotation_date'] ?? lang('App.unavailable') ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php endif; ?>
                        <?php if (($data['status'] == 'close') && is_null($data['work_request_number'])) : ?>
                            <table style="margin:10px auto 10px auto">
                                <!-- <caption>Statement Summary</caption> -->
                                <thead>
                                    <tr>
                                        <th scope="col"><?= lang('App.request'); ?></th>
                                        <th scope="col"><?= lang('Resolution'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-label=<?= lang('App.request'); ?>><?= $data['ticket_public'] ?></td>
                                        <td data-label=<?= lang('App.quotation'); ?>><?= $data['resolution'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    <?php endif; ?>

                    <h3 class="mt-4">📎 Pièces jointes</h3>
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <!-- <th>Titre</th> -->
                                <th>Description</th>
                                <th>Prévisualisation</th>
                                <th>Téléchargement</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($attachments)): ?>
                                <?php foreach ($attachments as $file): ?>
                                    <tr>
                                        <!-- <td><?= esc($file['title']) ?></td> -->
                                        <td><?= esc($file['description']) ?></td>
                                        <td>
                                            <?php if (preg_match('/\.(jpg|jpeg|png|gif|pdf)$/i', $file['filename'])): ?>
                                                <a href="<?= site_url('attachments/preview/' . $file['id']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    Voir
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">Non disponible</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= site_url('attachments/download/' . $file['id']) ?>" class="btn btn-sm btn-outline-success">
                                                Télécharger
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Aucun fichier joint</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <p style="margin:30px"><a href="<?= base_url() ?>"><?= lang('App.back_home'); ?></a></p>
                </div>
            </div>

        </div>

    </body>

    </html>