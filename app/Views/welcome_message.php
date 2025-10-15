<?php // app/Views/welcome.php 
?>
<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<title>Eneo Cameroon - <?= esc($this->renderSection('title') ?? 'Liste demandes') ?></title>

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

		.link-btn {
			display: inline-block;
			padding: 6px 10px;
			background: #0b57a4;
			color: #fff;
			border-radius: 6px;
			font-size: 12px;
			font-weight: 600;
			text-decoration: none;
			transition: background 0.2s, box-shadow 0.2s;
		}

		.link-btn:hover {
			background: #084b8f;
			box-shadow: 0 4px 10px rgba(11, 87, 164, 0.25);
		}

		.link-btn.secondary {
			background: #2563eb;
		}

		.link-btn.secondary:hover {
			background: #1e4db7;
		}

		.link-btn.success {
			background: #16a34a;
		}

		.link-btn.success:hover {
			background: #12813c;
		}

		tr:hover {
			background: #f9fbff;
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
	<main class="wrap" role="main" aria-labelledby="pageTitle">
		<div class="topbar">
			<a class="brand" href="<?= site_url() ?>">
				<img src="<?= base_url('/assets/images/branding.png') ?>" alt="Eneo Cameroon logo">
				<h1 id="pageTitle">Portail - Demandes de branchement</h1>
			</a>

			<div class="controls" role="region" aria-label="Recherche et actions">
				<form class="search" method="get" action="<?= site_url('/') ?>" role="search" aria-label="Recherche de demandes">
					<label for="search" class="visually-hidden">Recherche</label>
					<!-- <input id="q" name="q" type="text" placeholder="Recherche par ticket, nom ou NUI..." value="<?= esc($search ?? '') ?>" /> -->
					<input id="search" name="search" type="text" placeholder="Recherche..." value="<?= esc($search ?? '') ?>" />
					<button type="submit" aria-label="Rechercher">Rechercher</button>
				</form>

				<!-- <a class="action-btn" href="<?= url_to('connection') ?>">Nouvelle demande</a> -->
			</div>
		</div>

		<section class="table-wrap" aria-labelledby="tableTitle">
			<h2 id="tableTitle" style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden;">Liste des demandes</h2>

			<table role="table" aria-describedby="tableDesc">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nom</th>
						<th scope="col">Numéro de Work Request</th>
						<th scope="col">Numéro de contrat CMS</th>
						<th scope="col">Le numéro de CNI</th>
						<th scope="col">Le numéro de NIU</th>
						<th scope="col">Plan de localisation</th>
					</tr>
				</thead>

				<tbody>
					<?php if (!empty($requests) && count($requests) > 0) : ?>
						<?php foreach ($requests as $idx => $r) : ?>
							<?php
							$id = esc($r['id_request'] ?? $r['id'] ?? $idx + 1);
							$firstname = esc($r['firstname'] ?? '');
							$lastname = esc($r['lastname'] ?? '');
							$wrNumber = esc($r['wr_number'] ?? '—');
							$cmsContract = esc($r['cms_contract'] ?? '—');
							$tax = esc($r['taxnum'] ?? '');
							$idnum = esc($r['identity_number'] ?? '');
							$attachments = json_decode($r['attachments'] ?? '[]', true);

							$displayName = $firstname
								? "{$firstname} {$lastname}"
								: ($lastname ?: '<span class="muted">—</span>');


							$linkCNI =  null;
							$linkNIU = null;
							$linkPlan =  null;

							foreach ($attachments as $file) {
								$desc = $file['description'];

								if (str_contains($desc, 'ID')) {
									$linkCNI = site_url('attachments/download/' . $file['id']);
								} elseif (str_contains($desc, 'NIU')) {
									$linkNIU = site_url('attachments/download/' . $file['id']);
								} elseif (str_contains($desc, 'plan') || str_contains($desc, 'Localisation Plan file')) {
									$linkPlan = site_url('attachments/download/' . $file['id']);
								}
							}



							?>
							<tr onclick="window.location='<?= site_url('connection/follow/' . $id) ?>'" style="cursor:pointer; transition:background 0.2s ease;">
								<td><strong><?= $id ?></strong></td>
								<td><?= $displayName ?></td>
								<td><span style="font-weight:600; color:#0b57a4;"><?= $wrNumber ?></span></td>
								<td><?= $cmsContract ?></td>

								<td>
									<?php if ($idnum) : ?>
										<a href="<?= $linkCNI ?>" class="link-btn" title="Télécharger fichier (recto/verso)"><?= $idnum ?></a>
									<?php else : ?>
										<span class="muted">—</span>
									<?php endif; ?>
								</td>
								<td>
									<?php if ($tax) : ?>
										<a href="<?= $linkNIU ?>" class="link-btn" title="Télécharger fichier CNI"><?= $tax ?></a>
									<?php else : ?>
										<span class="muted">—</span>
									<?php endif; ?>
								</td>
								<td>
									<a href="<?= $linkPlan ?>" class="link-btn success" target="_blank" title="Voir plan de localisation">Voir le plan</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="7" style="text-align:center; padding:28px 18px;">
								<div class="muted">Aucune demande trouvée — utilisez la recherche de demande.</div>
							</td>
						</tr>
					<?php endif; ?>
				</tbody>

			</table>
		</section>

		<nav aria-label="Pagination" style="margin-top:18px;">
			<?= $pager->links() ?>
		</nav>
	</main>
</body>

</html>