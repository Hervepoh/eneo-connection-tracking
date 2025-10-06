<?= $this->extend('layouts/form'); ?>
<?= $this->section('content') ?>
<style>
    .cards {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .card {
        width: 10rem;
        height: 10rem;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color : rgba(190,190,190,0.5);
    }
</style>

<div class="container " style=" margin:10px auto;">
    <form action="<?= url_to('connection_save') ?>" method="POST" id="connection_form" enctype="multipart/form-data">

        <div class="row">

            <div class="col-md-6" style="padding-top:20px;">
                <img src="<?= base_url() ?>/img/enteteMK_branchement.png" class="headImg">


                <div class="content_lang">
                    <a style="display: inline-block;text-align: left !important;" href="<?= site_url(); ?>">[ <?= lang('App.home') ?> ]</a>
                    <?php if ((session())->get('lang') == 'en') : ?>
                        <a href="<?= site_url('lang/fr'); ?>" id="lan" style="color: #1B75BB;" data-id="fr">[ Français ]</a>
                    <?php endif; ?>
                    <?php if ((session())->get('lang') == 'fr') : ?>
                        <a href="<?= site_url('lang/en'); ?>" id="lan" style="color: #1B75BB;" data-id="en">[ English ]</a>
                    <?php endif; ?>
                </div>
                <legend class="text-left" style="padding-top:30px;color: #1B75BB">Faire une réclamation</legend>
                <legend class="text-left" style="padding-top:3px;color: #1B75BB;font-size: 10px"><?php echo lang('App.filesize'); ?></legend>

            </div>

            <div class="col-md-6" style="padding-top:20px;">
                Une question, un problème ou un litige au sujet de ma facture, de mon contrat ou d’un paiement ? Le service client Eneo est à mon écoute et met tout en œuvre pour m’apporter une réponse claire et rapide. Si des recherches complémentaires s’avèrent nécessaires, un délai de traitement m’est indiqué.
                <!-- <img src="<?= base_url() ?>/img/Web_main_Cover.png" class="headImg"> -->
            </div>

        </div>

        <div class="row">
            <div id="smartwizard" class="col-lg-12">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#step-1">

                            <strong>Motif de la réclamation<?php //echo lang('App.step1BoldMessage'); 
                                                            ?></strong> <br> <?php  //echo lang('App.step1ThinMessage'); 
                                                                                ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#step-2">
                            <strong><?php echo lang('App.step2BoldMessage'); ?></strong> <br><?php echo lang('App.step2ThinMessage'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#step-3">
                            <strong><?php echo lang('App.step3BoldMessage'); ?></strong> <br><?php echo lang('App.step3ThinMessage'); ?>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                        <h4>
                            <span>
                                <img src="/content/dam/2-Actifs/Images/Demande_reclamation/bullet-1.png" alt="">
                            </span>
                            J’indique le motif de ma réclamation en sélectionnant un thème ci-dessous
                        </h4>
                        <div class="cards">
                            <div class="card">
                                <div class="card-body">
                                    <span class="picto" style="background-image:url(/content/dam/picto/gris/facture-1.png);"></span>
                                    <span class="picto_actif hide" style="background-image:url(/content/dam/picto/blanc/facture-2.png);"></span>
                                    <p>Montant de ma facturet</p>
                                </div>
                            </div>
                            <div class="card">
                                <div>
                                    <span class="picto" style="background-image:url(/content/dam/picto/gris/facture-1.png);"></span>
                                    <span class="picto_actif hide" style="background-image:url(/content/dam/picto/blanc/facture-2.png);"></span>
                                    <p>Règlement et remboursement</p>
                                </div>
                            </div>
                            <div class="card">
                                <div>
                                    <span class="picto" style="background-image:url(/content/dam/picto/gris/facture-1.png);"></span>
                                    <span class="picto_actif hide" style="background-image:url(/content/dam/picto/blanc/facture-2.png);"></span>
                                    <p>Compteur et intervention </p>
                                </div>
                            </div>
                            <div class="card">
                                <div>
                                    <span class="picto" style="background-image:url(/content/dam/picto/gris/facture-1.png);"></span>
                                    <span class="picto_actif hide" style="background-image:url(/content/dam/picto/blanc/facture-2.png);"></span>
                                    <p>Mon contrat d'énergie</p>
                                </div>
                            </div>
                            <div class="card">
                                <div>
                                    <span class="picto" style="background-image:url(/content/dam/picto/gris/facture-1.png);"></span>
                                    <span class="picto_actif hide" style="background-image:url(/content/dam/picto/blanc/facture-2.png);"></span>
                                    <p>Qualité de la relation client</p>
                                </div>
                            </div>

                            <div class="card">
                                <div>
                                    <span class="picto" style="background-image:url(/content/dam/picto/gris/coupure-1.png);"></span>
                                    <span class="picto_actif hide" style="background-image:url(/content/dam/picto/blanc/coupure-2.png);"></span>
                                    <p>Coupure électricité / gaz </p>
                                </div>
                            </div>

                            <div class="card">
                                <div>
                                    <span class="picto" style="background-image:url(/content/dam/1-Upload/demarchage-abusif-off-102x62.png);"></span>
                                    <span class="picto_actif hide" style="background-image:url(/content/dam/1-Upload/demarchage-abusif-on-102x62.png);"></span>
                                    <p>Démarchage abusif et arnaque</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="formElt left">
                                    <div class="form-group form-inline" style="text-align:left;">
                                        <span id="lbtypeComp" style="margin-top:5px;"><?php echo lang('App.youare'); ?></span>
                                        <div style="margin-left:5px;">
                                            <div id="radio-group-comp" style="display:inline-block;">
                                                <input type="radio" class="radiobox person_type" name="person_type" id="person_type" value="1" checked>
                                                <span id="lbComp1" style="margin-top: 10px;color: #1B75BB; "><?php echo lang('App.physical'); ?></span>
                                                <!-- <br> 
													-->
                                                <input type="radio" class="radiobox person_type" style="margin-left: 5px;" name="person_type" id="person_type" value="2">
                                                <span id="lbComp2" style="margin-top: 10px;color: #1B75BB; "> <?php echo lang('App.moral'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group raisonSociale pMorale">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="social_reason" name="social_reason" value="" placeholder="Raison Sociale">
                                        </div>
                                    </div>
                                    <div class="form-group Civility pPhysique">
                                        <div class="col-sm-12">
                                            <select name="civility" id="civility" class="form-control">
                                                <option value="" disabled="" selected=""><?php echo lang('App.courtesy'); ?></option>
                                                <option value="Mr">Mr</option>
                                                <option value="Mme">Mrs</option>
                                                <option value="Mlle">Miss</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group firstName pPhysique">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="<?php echo lang('App.firstname'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group lastName pPhysique">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="lastname" name="lastname" value="" placeholder="<?php echo lang('App.lastname'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group region">
                                        <div class="col-sm-12">
                                            <select name="region" id="region" class="form-control">
                                                <option value="" disabled selected=""><?php echo lang('App.residential_area'); ?></option>
                                                <option value="201">Centre </option>
                                                <option value="204">Littoral </option>
                                                <!--	<option value="205" disabled>North </option>
													<option value="207" disabled>West </option>
													<option value="208" disabled>South </option>
													<option value="203" disabled>East </option>
													<option value="200" disabled>Adamaoua </option>
													<option value="202" disabled>Extreme North</option>
													<option value="206" disabled>North West </option>
													<option value="209" disabled>South West </option> -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <select name="identity_type_id" id="identity_type_id" class="form-control identity_type_id">
                                                <option value="" disabled="" selected=""><?php echo lang('App.document_type'); ?></option>
                                                <option value="1"><?php echo lang('App.new_id'); ?> </option>
                                                <option value="2"><?php echo lang('App.old_id'); ?></option>
                                                <option value="3"><?php echo lang('App.receip'); ?></option>
                                                <option value="4"><?php echo lang('App.passport'); ?></option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control nidnum" id="nidnum" name="nidnum" value="" placeholder="<?php echo lang('App.new_id'); ?> Nr*">

                                            <input type="text" class="form-control oidnum" id="oidnum" name="oidnum" value="" placeholder="<?php echo lang('App.old_id'); ?> Nr*">

                                            <input type="text" class="form-control ridnum" id="ridnum" name="ridnum" value="" placeholder="<?php echo lang('App.receip'); ?> Nr*">

                                            <input type="text" class="form-control pidnum" id="pidnum" name="pidnum" value="" placeholder="<?php echo lang('App.passport'); ?> Nr*">
                                        </div>
                                    </div>

                                    <div class="form-group form-inline idOnAt">
                                        <div class="col-sm-12">
                                            <span id="lbrequestor" style="margin-top: 5px;"><?php echo lang('App.delivered_at'); ?> &nbsp; </span>
                                            <input type="text" class="form-control" id="identity_delivered_at" name="identity_delivered_at" value="" placeholder="At" size="4">
                                            <br />

                                            <span id="lbrequestor" style="margin-top: 5px;"><?php echo lang('App.expires_on'); ?> &nbsp; </span>
                                            <input type="date" min="<?php echo date("Y-m-d"); ?>" id="identity_expires_on" name="identity_expires_on" class="form-control">

                                        </div>
                                    </div>



                                    <div class="form-group docAttached">
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control-file" id="idfile" name="idfile" value="" placeholder="<?php echo lang('App.add_id_doc'); ?>">
                                            <label for="idfile"><?php echo lang('App.add_id_doc'); ?></label>
                                        </div>
                                    </div>



                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="formElt right">
                                    <div class="form-group activity">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="activity" name="activity" value="" placeholder="<?php echo lang('App.activity'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group e-mail">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="email" name="email" value="" placeholder="<?php echo lang('App.email'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group form-inline">
                                        <div class="col-12 col-md-6">
                                            <input type="text" class="form-control" id="phone" name="phone" value="" placeholder="<?php echo lang('App.cellphone'); ?>" autocomplete="off">
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <label class="checkbox-inline check">
                                                <input type="checkbox" name="is_whatsapp" id="is_whatsapp" class="checkbox-c" value="1" @if(old('is_whatsapp')=="1" ) {{'checked="checked"'}} @endif>
                                                <span><?php echo lang('App.is_whatsapp'); ?> </span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group form-inline">
                                        <div class="col-12 col-md-6">
                                            <input type="text" class="form-control" id="phone_2" name="phone_2" value="" placeholder="<?php echo lang('App.cellphone2'); ?>" autocomplete="off">
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <label class="checkbox-inline check">
                                                <input type="checkbox" name="is_whatsapp_2" id="is_whatsapp_2" class="checkbox-c" value="1" @if(old('is_whatsapp_2')=="1" ) {{'checked="checked"'}} @endif>
                                                <span><?php echo lang('App.is_whatsapp'); ?> </span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="formElt left">

                                    <div class="form-group col-sm-12 form-inline" style="text-align:left;">
                                        <span id="lbtypeBranch" style="margin-top: 10px;"><?php echo lang('App.requested_service'); ?> </span>
                                        <div style="margin-left:1px;">
                                            <div id="radio-group-branch" style="display:inline-block;">
                                                <input type="radio" class="radiobox service_type" name="typeBranch" id="typeBranch" value="1" checked>
                                                <span id="lbBranch1" style="margin-top: 5px;color: #1B75BB; "><?php echo lang('App.new_connection'); ?> </span><br>
                                                <input type="radio" class="radiobox service_type" name="typeBranch" style="margin-left: 1px;" id="typeBranch" value="2">
                                                <span id="lbBranch2" style="margin-top: 5px;color: #1B75BB; "><?php echo lang('App.submeter'); ?></span><br>
                                                <input type="radio" class="radiobox service_type" name="typeBranch" style="margin-left: 1px;" id="typeBranch" value="3">
                                                <span id="lbBranch3" style="margin-top: 5px;color: #1B75BB; "><?php echo lang('App.meter_conversion'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12 newConnection subMeter">
                                        <input type="text" class="form-control" id="contract" name="contract" value="" placeholder="<?php echo lang('App.contract_number'); ?>">
                                    </div>
                                    <div class="form-group col-sm-12 newConnection subMeter">
                                        <input type="text" class="form-control" id="agency" name="agency" value="" placeholder="<?php echo lang('App.agency'); ?>">
                                    </div>


                                    <div class="col-md-12 p-0 newConnection subMeter">
                                        <div class="col-md-12 form_field_outer p-0">
                                            <div class="row form_field_outer_row">

                                                <div class="form-group col-sm-12 form-inline " style="text-align:left;">
                                                    <span id="lbtypeComp" style="margin-top:5px;"><?php echo lang('App.meter_type'); ?></span>
                                                    <div style="margin-left:5px;">
                                                        <div id="radio-group-comp" style="display:inline-block;">
                                                            <input type="radio" class="radiobox" name="typeCompteur" id="typeComp1" value="1" checked>
                                                            <span id="lbComp1" style="margin-top: 10px;color: #1B75BB; "><?php echo lang('App.postpaid'); ?></span><!-- <br> -->
                                                            <input type="radio" class="radiobox" style="margin-left: 5px;" name="typeCompteur" id="typeComp2" value="2">
                                                            <span id="lbComp2" style="margin-top: 10px;color: #1B75BB; "><?php echo lang('App.prepaid'); ?></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="form-group col-sm-12 form-inline ">
                                                    <select name="power" id="power" class="form-control">
                                                        <option value="" disabled="" selected=""><?php echo lang('App.requested_power'); ?></option>
                                                        <option value="5A">5A</option>
                                                        <option value="10A">10A</option>
                                                        <option value="15A">15A</option>
                                                        <option value="20A">20A</option>
                                                        <option value="25A">25A</option>
                                                        <option value="30A">30A</option>
                                                        <option value="35A">35A</option>
                                                        <option value="40A">40A</option>
                                                        <option value="45A">45A</option>
                                                        <option value="50A">50A</option>
                                                        <option value="55A">55A</option>
                                                        <option value="60A">60A</option>
                                                        <option value="65A">65A</option>
                                                        <option value="70A">70A</option>
                                                        <option value="75A">75A</option>
                                                        <option value="80A">80A</option>
                                                        <option value="85A">85A</option>
                                                        <option value="90A">90A</option>
                                                        <option value="95A">95A</option>
                                                        <option value="100A">100A</option>
                                                        <option value="105A">105A</option>
                                                        <option value="110A">110A</option>
                                                        <option value="115A">115A</option>
                                                        <option value="120A">120A</option>
                                                        <option value="125A">125A</option>
                                                    </select>
                                                    <span id="lbmeterType" style="margin-left: 1px;"> <?php echo lang('App.connection_type'); ?> </span>
                                                    <div style="text-align:center; margin-left:3px;">
                                                        <div id="radio-group-met" style="display:inline-block;">
                                                            <input type="radio" class="radiobox" name="meterType" id="meterType1" value="01211" checked>
                                                            <span id="lbMet2" style="margin-top: 10px;color: #1B75BB; "> <?php echo lang('App.two_wires'); ?></span><br>
                                                            <input type="radio" class="radiobox" name="meterType" id="meterType2" value="01212">
                                                            <span id="lbMet2" style="margin-top: 10px;color: #1B75BB; "> <?php echo lang('App.four_wires'); ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-12 appliances ">
                                                    <input type="text" style="height: 100px;" data-toggle="tooltip" data-placement="top" title="<?php echo lang('App.appliances_desc'); ?>" class="form-control" id="appliances" name="appliances" value="" placeholder="<?php echo lang('App.appliances'); ?>">
                                                </div>
                                                <div class="form-group col-sm-12 newConnection networkDis ">
                                                    <input type="text" data-toggle="tooltip" data-placement="top" title="<?php echo lang('App.networkDis_desc'); ?> (m)" class="form-control" id="networkDis" name="networkDis" value="" placeholder="<?php echo lang('App.networkDis'); ?>">
                                                </div>
                                                <div class="form-group col-sm-12 form-inline newConnection " style="text-align:left;">
                                                    <span id="lbtypeComp" style="margin-top:5px;"><?php echo lang('App.cableExist'); ?></span>
                                                    <div style="margin-left:5px;">
                                                        <div id="radio-group-comp" style="display:inline-block;">
                                                            <input type="radio" class="radiobox" name="cableExist" id="cableExist1" value="1" checked>
                                                            <span id="lbComp1" style="margin-top: 10px;color: #1B75BB; "><?php echo lang('App.yes'); ?></span><!-- <br> -->
                                                            <input type="radio" class="radiobox" style="margin-left: 5px;" name="cableExist" id="cableExist2" value="2">
                                                            <span id="lbComp2" style="margin-top: 10px;color: #1B75BB; "><?php echo lang('App.no'); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 form-inline subMeter" style="text-align:left;">
                                                    <span id="lbtypeComp" style="margin-top:5px;"><?php echo lang('App.meter_quantity'); ?> </span>
                                                    <input type="number" class="form-control" name="qty-0" access="false" id="qty-0" size="3">
                                                </div>
                                                <div class="form-group subMeter col-md-6 add_del_btn_outer">
                                                    <button class="btn_round add_node_btn_frm_field" title="Copy or clone this row">
                                                        <i class="fas fa-copy"></i>
                                                    </button>

                                                    <button class="btn_round remove_node_btn_frm_field" disabled>
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 subMeter">
                                        <button class="btn btn-outline-lite py-0 add_new_frm_field_btn"><i class="fas fa-plus add_icon"></i> <?php echo lang('App.add_new_block'); ?></button>
                                    </div>
                                </div>
                                <input type="hidden" id="submeter_groups" name="submeter_groups" value="" />


                            </div>
                            <div class="col-lg-6">
                                <div class="formElt right">


                                    <div class="form-group col-sm-12 form-inline subMeter">
                                        <span id="lbtypeComp"><?php echo lang('App.nb_distribution_box'); ?></span>
                                        <div class="input-group number-spinner " style="margin-left:5px;">
                                            <input type="number" name="nbdistbox" id="nbdistbox" class="form-control text-center" size="3" value="">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 form-inline newConnection subMeter">
                                        <select name="constType" id="constType" class="form-control house_type">
                                            <option value="" disabled="" selected=""><?php echo lang('App.construction_type'); ?></option>
                                            <option value="1">Studio </option>
                                            <option value="2">Appartement</option>
                                            <option value="3">Villa</option>
                                            <option value="4">Duplex</option>
                                            <option value="5">Building</option>
                                        </select>
                                        <select name="floor" id="floor" class="form-control buildings" style="margin-left:10px;">
                                            <option value="" disabled="" selected=""><?php echo lang('App.number_of_floor'); ?></option>
                                            <option value="R0">R+0</option>
                                            <option value="R1">R+1</option>
                                            <option value="R2">R+2</option>
                                            <option value="R3">R+3</option>
                                            <option value="RAutre">&gt;R+3</option>
                                        </select>
                                    </div>

                                    <div class="form-group premiseLoc newConnection subMeter">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="premiseLoc" name="premiseLoc" value="" placeholder="<?php echo lang('App.localisation'); ?>">
                                        </div>
                                    </div>


                                    <div class="form-group docAttached  newConnection subMeter">
                                        <div class="col-sm-12" style="text-align : left; margin-left:5px;">
                                            <input type="file" class="form-control-file" id="billfile" name="billfile" value="" placeholder="<?php echo lang('App.add_bill_doc'); ?>">
                                            <label for="billfile"><?php echo lang('App.add_bill_doc'); ?></label>


                                        </div>
                                    </div>
                                    <div class="form-group docAttached2  newConnection subMeter">
                                        <div class="col-sm-12" style="text-align : left; margin-left:5px;">
                                            <input type="file" class="form-control-file" id="letterfile" name="letterfile" value="" placeholder="<?php echo lang('App.add_request_doc'); ?>">
                                            <label for="letterfile"><?php echo lang('App.add_request_doc'); ?></label>

                                        </div>
                                    </div>
                                    <div class="form-group docAttached3  newConnection subMeter">
                                        <div class="col-sm-12" style="text-align : left; margin-left:5px;">
                                            <input type="file" class="form-control-file" id="planfile" name="planfile" value="" placeholder="<?php echo lang('App.add_location_doc'); ?>">
                                            <label for="planfile"><?php echo lang('App.add_location_doc'); ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group docAttached4 newConnection subMeter">
                                        <div class="col-sm-12" style="text-align : left; margin-left:5px;">
                                            <input type="file" class="form-control-file" id="housefile" name="housefile" value="" placeholder="<?php echo lang('App.add_housepic_doc'); ?>">
                                            <label for="housefile"><?php echo lang('App.add_housepic_doc'); ?></label>

                                        </div>
                                    </div>
                                    <div class="form-group docAttached4 newConnection subMeter">
                                        <div class="col-sm-12" style="text-align : left; margin-left:5px;">
                                            <input type="file" class="form-control-file" id="meterfile" name="meterfile" value="" placeholder="<?php echo lang('App.add_meterpic_doc'); ?>">
                                            <label for="meterfile"><?php echo lang('App.add_meterpic_doc'); ?></label>

                                        </div>
                                    </div>

                                    <div class="form-group docAttached4 newConnection subMeter">
                                        <div class="col-sm-12" style="text-align : left; margin-left:5px;">
                                            <input type="file" class="form-control-file" id="permitfile" name="permitfile" value="" placeholder="<?php echo lang('App.add_permitfile_doc'); ?>">
                                            <label for="permitfile"><?php echo lang('App.add_permitfile_doc'); ?></label>

                                        </div>
                                    </div>
                                    <div class="form-group form-inline conversion" style="text-align:left;">
                                        <span id="lbtypeComp" style="margin-top:5px;"><?php echo lang('App.conversion_message_head'); ?></span><br />

                                    </div>
                                    <div class="form-group form-inline conversion" style="text-align:left;">
                                        <?php echo lang('App.conversion_message_body'); ?>

                                    </div>

                                </div>
                                <!--div class="form-group">
										<script src="https://www.google.com/recaptcha/api.js?" async="" defer=""></script>
										<div data-sitekey="6LdMpxkTAAAAANkGN7JhLcd3wc5YNndDgNkV1rjF" class="g-recaptcha"><div><iframe 
										src="https://www.google.com/recaptcha/api/fallback?k=6LdMpxkTAAAAANkGN7JhLcd3wc5YNndDgNkV1rjF&amp;hl=fr&amp;v=qljbK_DTcvY1PzbR7IG69z1r&amp;t=40023" scrolling="no" style="width: 302px; height: 
										422px;" frameborder="0"></iframe><div style="margin: -4px 0px 0px; padding: 0px; background: rgb(249, 249, 249) none repeat scroll 0% 0%; border: 1px solid rgb(193, 193, 193); border-radius: 
										3px; height: 60px; width: 300px;"><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 
										193, 193); margin: 10px 25px; padding: 0px; resize: none; display: block;"></textarea></div></div></div>
									</div-->
                                <div class="form-group newConnection subMeter">
                                    <div class="form-check">
                                        <input class="form-check-input check-condition" type="checkbox" id="CheckCondition" value="1" name="conditionAccepted">
                                        <label class="checkbox-inline conditions_utilisation" for="CheckCondition">
                                            <?php echo lang('App.condition_of_use'); ?>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row subMeter">




                        </div>

                    </div>
                    <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="formElt " id="message_recapitulatif">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <span id="countdown" class="d-flex align-items-center justify-content-center form-inline" style="margin:auto;"></span>
                        </div>
                        <div class="row">
                            <!--button type="button" id="form_submit" class="btn btn-success btn-lg" style="margin:auto;">Soumettre</button-->
                            <button class="spinner-button btn btn-primary btn-lg btn-success" id="form_submit" aria-haspopup="true" aria-expanded="false" style="margin:auto;"><i class="fa fa-upload"></i><?php echo lang('App.submit_button'); ?></button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </form>
</div>

<?php echo "<script>var Messages = " . json_encode(lang('App.messages')) . ';</script>';
echo "<script>var validationOptions = " . json_encode(lang('App.validationOptions')) . ';</script>'; ?>
<script src="<?= base_url(); ?>/V2/js/app.js"></script>
<script>
    $("#form_submit").on("click", function() {
        event.preventDefault();
        $(".toolbar-bottom").hide();

        $(this).html('<i class="fa fa-circle-o-notch fa-spin"></i> ' + Messages.processing);

        $("#message_recapitulatif").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + Messages.sending);

        var case_id = null;
        var form = $('#connection_form')[0];
        var formData = new FormData(form);
        console.log(formData);


        $.ajax({
                url: "<?= url_to('connection_save') ?>",
                type: "POST",
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.success == true) {
                        var el = $('<div style="color:green;"></div>').html('<strong>' + Messages.success + '!</strong');
                        $("#message_recapitulatif").append(el);
                        var el = $('<div></div>').html(Messages.ticket_number + '<strong>' + data.case_number + '</strong');
                        $("#message_recapitulatif").append(el);
                    } else {
                        var el = $('<div style="color:red;"></div>').html('<strong>' + data.msg + '!</strong');
                        $("#message_recapitulatif").append(el);
                    };
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var el = $('<div style="color:red;"></div>').html('<strong>' + Messages.errorcreate + errorThrown + '!</strong');
                    $("#message_recapitulatif").append(el);
                }
            })
            .done(function(resp) {

                var el = $('<div id="error"></div>').html(Messages.homepage);
                $("#message_recapitulatif").append(el);
                $("#form_submit").prop("disabled", true);
                $("#form_submit").hide();
                $(".tab-content").height("auto");
            })


    });
</script>
<?= $this->endSection() ?>