<?= $this->extend('layouts/frontend'); ?>

<?= $this->section('title') ?>
<?= lang('App.welcome') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content_lang">
	<a href="<?= site_url('lang/fr'); ?>" id="lan"  data-id="fr">[ Français ]</a>
	|
	<a href="<?= site_url('lang/en'); ?>" id="lan" data-id="en">[ English ]</a>
</div>
<div class="container right-panel-active" id="container">

	<div class="forms-container">
		<div class="signin-signup">
			<div class="form-container sign-up-container">
				<form method="POST" action="<?= url_to('follow') ?>" class="form" id="form_search_request">
					<h1><?= lang('App.welcomeFollowupTitle') ?></h1>
					<p><?= lang('App.welcome_search_txt') ?></p>
					<input type="text" id="id_request" name="ticket_public" required  placeholder="<?= lang('App.welcome_search_lbl') ?> *" />
					<input type="text" id="id_nui" name="taxnum" required  placeholder="<?= lang('App.taxid') ?>" />
					<div class="recap" style="padding: 10px; color: #ff0108">
						<?php if (session()->getFlashdata('error') !== NULL) : ?> 
						<div class="alert alert-danger"> <?= session()->getFlashdata('error') ?></div>
						<?php endif;?>
					</div>
					<button id="search_request" class="btn-eneo-green"><?= lang('App.welcome_search_btn') ?></button>
                    
				</form>
			</div>
		
		</div>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<img src="<?= base_url() ?>/assets/images/branding.png">
				<p><?= lang('App.welcome_apply_lbl') ?></p>
				<a href="<?= url_to('connection') ?>" class="btn btn-eneo-blue"><?= lang('App.welcome_apply_btn') ?></a>
				<!-- <button class="ghost" id="signIn"><?= lang('App.welcome_apply_btn') ?></button> -->
			</div>
			<div class="overlay-panel overlay-right">
				<img src="<?= base_url() ?>/assets/images/branding.png">
				<p><?= lang('App.welcome_followUp_lbt') ?></p>
				<button class="ghost" id="signUp"><?= lang('App.welcome_followUp_btn') ?></button>
			</div>
		</div>
	</div>
</div>


<?= $this->endSection() ?>
