<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?= base_url() ?>/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">

    <meta name="author" content="">
    <link rel="stylesheet" href="<?= base_url() ?>/V2/css/bootstrap.min.css">
    <!--link href="<?= base_url() ?>/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" /-->
    <link href="<?= base_url() ?>/dist/css/smart_wizard_all.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/dist/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>/V2/js/intl-tel-input-12.1.0/build/css/intlTelInput.css">
    <title>Eneo Cameroon SA - <?= lang('App.connection_form') ?></title>
    <meta name="rights" content="Eneo Cameroon S.A." />
    <meta name="description" content="Service dédié aux demandes de branchement" />
    <meta name="keywords" content="Eneo, cameroun, cameroon, energy, energie, fournisseur d'électricité, Electricité cameroun, Particuliers, entreprises, professionnels, industriels,Electricity Cameroon, ménages, abonnement, branchement, facture, paiement, mobile money, actualité, Economie d'énergie, Conseils sécurité, MyEasyLight, EasyLight, easyconnection, compteur,Centre de Presse, Alertes réseau, compteur,courant, Orange, MTN, Express Union, Express Exchange,Agence en ligne, Online Agency,Logo Eneo,Centrale gaz,Joel Nana Kontchou, Courant, Facture électronique, ebills, e-bills, electronic bills, Mobile Payement, Online Payement,Impayés,délestages, coupures,Outages,Emploi " />
    <script src="<?= base_url() ?>/V2/js/jquery-3.5.0.min.js"></script>
    <script language="javascript" src="<?= base_url() ?>/V2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/libphonenumber-js/1.7.7/libphonenumber-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>
    <script src="<?= base_url() ?>/V2/js/intl-tel-input-12.1.0/build/js/intlTelInput.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!--
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-170927595-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-170927595-1');
    </script>
    -->
    <script src="<?= base_url() ?>/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/conditional-field.min.js" type="text/javascript"></script>


    <!-- Validation library file -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript">
        var next = "<?= lang('App.next'); ?>";
        var previous = "<?= lang('App.previous'); ?>";
    </script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

</head>

<body class="text-center">
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
                    <legend class="text-left" style="padding-top:30px;color: #1B75BB"><?= lang('App.pageTitle'); ?></legend>
                    <legend class="text-left" style="padding-top:3px;color: #1B75BB;font-size: 10px"><?= lang('App.filesize'); ?></legend>

                </div>

                <div class="col-md-6" style="padding-top:20px;">
                    <img src="<?= base_url() ?>/img/Web_main_Cover.png" class="headImg">
                </div>

            </div>

            <div class="row">
                <div id="smartwizard" class="col-lg-12">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#step-1">
                                <strong><?= lang('App.step1BoldMessage'); ?></strong> <br><?= lang('App.step1ThinMessage'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-2">
                                <strong><?= lang('App.step2BoldMessage'); ?></strong> <br><?= lang('App.step2ThinMessage'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-3">
                                <strong><?= lang('App.step3BoldMessage'); ?></strong> <br><?= lang('App.step3ThinMessage'); ?>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" style="margin-bottom: 50px !important; ">
                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="formElt left">

                                        <div class="form-group form-inline" style="text-align:left;">
                                            <span id="lbtypeComp" style="margin-top:5px;"><?= lang('App.youare'); ?></span>
                                            <div style="margin-left:5px;">
                                                <div id="radio-group-comp" style="display:inline-block;">
                                                    <input type="radio" class="radiobox person_type" name="person_type" id="person_type" value="1" checked>
                                                    <span id="lbComp1" style="margin-top: 10px;color: #1B75BB; "><?= lang('App.physical'); ?></span>
                                                    <!-- <br> -->
                                                    <input type="radio" class="radiobox person_type" style="margin-left: 5px;" name="person_type" id="person_type" value="2">
                                                    <span id="lbComp2" style="margin-top: 10px;color: #1B75BB; "> <?= lang('App.moral'); ?></span>
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
                                                    <option value="" disabled="" selected=""><?= lang('App.courtesy'); ?></option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mme">Mrs</option>
                                                    <option value="Mlle">Miss</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group firstName pPhysique">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="<?= lang('App.firstname'); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group lastName pPhysique">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="lastname" name="lastname" value="" placeholder="<?= lang('App.lastname'); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group town">
                                            <div class="col-sm-12">
                                                <select name="town" id="town" class="form-control">
                                                    <option value="" disabled selected=""><?= lang('App.town'); ?></option>
                                                    <?php foreach($townsList as $town) : ?>
                                                        <option value="<?= $town['id'] ?>"> <?= $town['name'] ?> </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group region">
                                            <div class="col-sm-12">
                                                <select name="region" id="region" class="form-control">
                                                    <option value="" disabled selected=""><?= lang('App.residential_area'); ?></option>
                                                    <option value="201">Centre </option>
                                                    <option value="204">Littoral </option>
                                                    <option value="207"><?= lang('App.west'); ?></option>
                                                    <option value="206"><?= lang('App.north_west'); ?> </option>
                                                    <option value="209"><?= lang('App.south_west'); ?> </option>
                                                    <option value="205" disabled>North </option>
						    <option value="207" disabled>West </option>
						    <option value="208" disabled>South </option>
						    <option value="203" disabled>East </option>
			                            <option value="200" disabled>Adamaoua </option>
					            <option value="202" disabled>Extreme North</option>
		         			    <option value="206" disabled>North West </option>
                                                    <option value="209" disabled>South West </option> 
                                                </select>
                                            </div>
                                        </div> -->

                                        <div class="form-group e-mail">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="email" name="email" value="" placeholder="<?= lang('App.email'); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group form-inline">
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="form-control" id="phone" name="phone" value="" placeholder="<?= lang('App.cellphone'); ?>" autocomplete="off">
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <label class="checkbox-inline check">
                                                    <input type="checkbox" name="is_whatsapp" id="is_whatsapp" class="checkbox-c" value="1" @if(old('is_whatsapp')=="1" ) {{'checked="checked"'}} @endif>
                                                    <span><?= lang('App.is_whatsapp'); ?></span>
                                                </label>
                                            </div>
                                           
                                        </div>

                                        <div class="form-group form-inline">
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="form-control" id="phone_2" name="phone_2" value="" placeholder="<?= lang('App.cellphone2'); ?>" autocomplete="off">
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <label class="checkbox-inline check">
                                                    <input type="checkbox" name="is_whatsapp_2" id="is_whatsapp_2" class="checkbox-c" value="1" @if(old('is_whatsapp_2')=="1" ) {{'checked="checked"'}} @endif>
                                                    <span><?= lang('App.is_whatsapp'); ?> </span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group activity">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="activity" name="activity" value="" placeholder="<?= lang('App.activity'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="formElt right">
                                        <div class="form-group premise_activity">
                                            <div class="col-sm-12">
                                                <select name="premise_activity" id="premise_activity" class="form-control">
                                                    <option value="" disabled="" selected=""><?= lang('App.premise_activity'); ?></option>
                                                    <option value="TF001"><?= lang('App.premise_activity_fields.APARTMENTS_BUILDING'); ?></option>
                                                    <option value="TF002"><?= lang('App.premise_activity_fields.BUILDING'); ?></option>
                                                    <option value="TF003"><?= lang('App.premise_activity_fields.CHURCH'); ?></option>
                                                    <option value="TF004"><?= lang('App.premise_activity_fields.CINEMA'); ?></option>
                                                    <option value="TF005"><?= lang('App.premise_activity_fields.CITY_CENTRE'); ?></option>
                                                    <option value="TF006"><?= lang('App.premise_activity_fields.CLINIC'); ?></option>
                                                    <option value="TF007"><?= lang('App.premise_activity_fields.COMPOUND'); ?></option>
                                                    <option value="TF008"><?= lang('App.premise_activity_fields.EDUCATIONAL_CENTRE'); ?></option>
                                                    <option value="TF009"><?= lang('App.premise_activity_fields.FACTORY'); ?></option>
                                                    <option value="TF010"><?= lang('App.premise_activity_fields.FARM'); ?></option>
                                                    <option value="TF011"><?= lang('App.premise_activity_fields.GAS_STATION'); ?></option>
                                                    <option value="TF012"><?= lang('App.premise_activity_fields.HOSPITAL'); ?></option>
                                                    <option value="TF013"><?= lang('App.premise_activity_fields.HOTEL'); ?></option>
                                                    <option value="TF014"><?= lang('App.premise_activity_fields.HOUSE'); ?></option>
                                                    <option value="TF015"><?= lang('App.premise_activity_fields.MARKET'); ?></option>
                                                    <option value="TF016"><?= lang('App.premise_activity_fields.MOSQUE'); ?></option>
                                                    <option value="TF017"><?= lang('App.premise_activity_fields.PALACE'); ?></option>
                                                    <option value="TF018"><?= lang('App.premise_activity_fields.PARKING_LOT'); ?></option>
                                                    <option value="TF019"><?= lang('App.premise_activity_fields.PRISON'); ?></option>
                                                    <option value="TF020"><?= lang('App.premise_activity_fields.RESTAURANT'); ?></option>
                                                    <option value="TF021"><?= lang('App.premise_activity_fields.SHOP'); ?></option>
                                                    <option value="TF022"><?= lang('App.premise_activity_fields.SPORT_CLUB'); ?></option>
                                                    <option value="TF023"><?= lang('App.premise_activity_fields.SQUARE'); ?></option>
                                                    <option value="TF024"><?= lang('App.premise_activity_fields.STADIUM'); ?></option>
                                                    <option value="TF025"><?= lang('App.premise_activity_fields.ELECTRIC_SUB_STATION'); ?></option>
                                                    <option value="TF026"><?= lang('App.premise_activity_fields.TERRAIN'); ?></option>
                                                    <option value="TF027"><?= lang('App.premise_activity_fields.WAREHOUSE'); ?></option>
                                                    <option value="TF028"><?= lang('App.premise_activity_fields.WATER_PUMP'); ?></option>
                                                    <option value="TF029"><?= lang('App.premise_activity_fields.WORKSHOP'); ?></option>
                                                    <option value="TF030"><?= lang('App.premise_activity_fields.AIRLINE'); ?></option>
                                                    <option value="TF031"><?= lang('App.premise_activity_fields.CONSTRUCTION'); ?></option>
                                                    <option value="TF032"><?= lang('App.premise_activity_fields.MILL'); ?></option>
                                                    <option value="TF033"><?= lang('App.premise_activity_fields.RECREATIONAL_CENTRE'); ?></option>
                                                    <option value="TF034"><?= lang('App.premise_activity_fields.STREET_LIGHT'); ?></option>
                                                    <option value="TF040"><?= lang('App.premise_activity_fields.INDIVIDUAL'); ?></option>
                                                    <option value="TF041"><?= lang('App.premise_activity_fields.COMPANY'); ?></option>
                                                    <option value="TF042"><?= lang('App.premise_activity_fields.INSTITUTION'); ?></option>
                                                    <option value="TF043"><?= lang('App.premise_activity_fields.GOVERNMENT'); ?></option>
                                                    <option value="TF044"><?= lang('App.premise_activity_fields.MUNICIPAL'); ?></option>
                                                    <option value="TF045"><?= lang('App.premise_activity_fields.PARASTATALS'); ?> </option>
                                                    <option value="TF046"><?= lang('App.premise_activity_fields.SCHOOLS'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="col-sm-12">
                                                <select name="identity_type_id" id="identity_type_id" class="form-control identity_type_id">
                                                    <option value="" disabled="" selected=""><?= lang('App.document_type'); ?></option>
                                                    <option value="1"><?= lang('App.new_id'); ?> </option>
                                                    <option value="2"><?= lang('App.old_id'); ?></option>
                                                    <option value="3"><?= lang('App.receip'); ?></option>
                                                    <option value="4"><?= lang('App.passport'); ?></option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control nidnum" id="nidnum" name="nidnum" value="" placeholder="<?= lang('App.new_id'); ?> Nr*">

                                                <inp/ut type="text" class="form-control oidnum" id="oidnum" name="oidnum" value="" placeholder="<?= lang('App.old_id'); ?> Nr*">

                                                <input type="text" class="form-control ridnum" id="ridnum" name="ridnum" value="" placeholder="<?= lang('App.receip'); ?> Nr*">

                                                <input type="text" class="form-control pidnum" id="pidnum" name="pidnum" value="" placeholder="<?= lang('App.passport'); ?> Nr*">
                                            </div>
                                        </div>

                                        <div class="form-group form-inline idOnAt">
                                            <div class="col-sm-12">
                                                <span id="lbrequestor" style="margin-top: 5px;"><?= lang('App.delivered_at'); ?> &nbsp; </span>
                                                <input type="text" class="form-control" id="identity_delivered_at" name="identity_delivered_at" value="" placeholder="At" size="4">
                                                <br />

                                                <span id="lbrequestor" style="margin-top: 5px;"><?= lang('App.expires_on'); ?> &nbsp; </span>
                                                <input type="date" min="<?= date("Y-m-d"); ?>" id="identity_expires_on" name="identity_expires_on" class="form-control">

                                            </div>
                                        </div>


                                        <div class="form-group originDoc">
                                            <div class="col-sm-12">
                                                <select name="identity_country" id="identity_country" class="form-control">
                                                    <option value="" disabled="" selected=""><?= lang('App.delivery_country'); ?></option>
                                                    <option value="93">Afghanistan</option>
                                                    <option value="355">Albania</option>
                                                    <option value="213">Algeria</option>
                                                    <option value="1684">American Samoa</option>
                                                    <option value="376">Andorra</option>
                                                    <option value="244">Angola</option>
                                                    <option value="1264">Anguilla</option>
                                                    <option value="0">Antarctica</option>
                                                    <option value="1268">Antigua And Barbuda</option>
                                                    <option value="54">Argentina</option>
                                                    <option value="374">Armenia</option>
                                                    <option value="297">Aruba</option>
                                                    <option value="61">Australia</option>
                                                    <option value="43">Austria</option>
                                                    <option value="994">Azerbaijan</option>
                                                    <option value="1242">Bahamas The</option>
                                                    <option value="973">Bahrain</option>
                                                    <option value="880">Bangladesh</option>
                                                    <option value="1246">Barbados</option>
                                                    <option value="375">Belarus</option>
                                                    <option value="32">Belgium</option>
                                                    <option value="501">Belize</option>
                                                    <option value="229">Benin</option>
                                                    <option value="1441">Bermuda</option>
                                                    <option value="975">Bhutan</option>
                                                    <option value="591">Bolivia</option>
                                                    <option value="387">Bosnia and Herzegovina</option>
                                                    <option value="267">Botswana</option>
                                                    <option value="0">Bouvet Island</option>
                                                    <option value="55">Brazil</option>
                                                    <option value="246">British Indian Ocean Territory</option>
                                                    <option value="673">Brunei</option>
                                                    <option value="359">Bulgaria</option>
                                                    <option value="226">Burkina Faso</option>
                                                    <option value="257">Burundi</option>
                                                    <option value="855">Cambodia</option>
                                                    <option value="237">Cameroon</option>
                                                    <option value="1">Canada</option>
                                                    <option value="238">Cape Verde</option>
                                                    <option value="1345">Cayman Islands</option>
                                                    <option value="236">Central African Republic</option>
                                                    <option value="235">Chad</option>
                                                    <option value="56">Chile</option>
                                                    <option value="86">China</option>
                                                    <option value="61">Christmas Island</option>
                                                    <option value="672">Cocos (Keeling) Islands</option>
                                                    <option value="57">Colombia</option>
                                                    <option value="269">Comoros</option>
                                                    <option value="242">Republic Of The Congo</option>
                                                    <option value="242">Democratic Republic Of The Congo</option>
                                                    <option value="682">Cook Islands</option>
                                                    <option value="506">Costa Rica</option>
                                                    <option value="225">Cote D Ivoire (Ivory Coast)</option>
                                                    <option value="385">Croatia (Hrvatska)</option>
                                                    <option value="53">Cuba</option>
                                                    <option value="357">Cyprus</option>
                                                    <option value="420">Czech Republic</option>
                                                    <option value="45">Denmark</option>
                                                    <option value="253">Djibouti</option>
                                                    <option value="1767">Dominica</option>
                                                    <option value="1809">Dominican Republic</option>
                                                    <option value="670">East Timor</option>
                                                    <option value="593">Ecuador</option>
                                                    <option value="20">Egypt</option>
                                                    <option value="503">El Salvador</option>
                                                    <option value="240">Equatorial Guinea</option>
                                                    <option value="291">Eritrea</option>
                                                    <option value="372">Estonia</option>
                                                    <option value="251">Ethiopia</option>
                                                    <option value="61">External Territories of Australia</option>
                                                    <option value="500">Falkland Islands</option>
                                                    <option value="298">Faroe Islands</option>
                                                    <option value="679">Fiji Islands</option>
                                                    <option value="358">Finland</option>
                                                    <option value="33">France</option>
                                                    <option value="594">French Guiana</option>
                                                    <option value="689">French Polynesia</option>
                                                    <option value="0">French Southern Territories</option>
                                                    <option value="241">Gabon</option>
                                                    <option value="220">Gambia The</option>
                                                    <option value="995">Georgia</option>
                                                    <option value="49">Germany</option>
                                                    <option value="233">Ghana</option>
                                                    <option value="350">Gibraltar</option>
                                                    <option value="30">Greece</option>
                                                    <option value="299">Greenland</option>
                                                    <option value="1473">Grenada</option>
                                                    <option value="590">Guadeloupe</option>
                                                    <option value="1671">Guam</option>
                                                    <option value="502">Guatemala</option>
                                                    <option value="44">Guernsey and Alderney</option>
                                                    <option value="224">Guinea</option>
                                                    <option value="245">Guinea-Bissau</option>
                                                    <option value="592">Guyana</option>
                                                    <option value="509">Haiti</option>
                                                    <option value="0">Heard and McDonald Islands</option>
                                                    <option value="504">Honduras</option>
                                                    <option value="852">Hong Kong S.A.R.</option>
                                                    <option value="36">Hungary</option>
                                                    <option value="354">Iceland</option>
                                                    <option value="91">India</option>
                                                    <option value="62">Indonesia</option>
                                                    <option value="98">Iran</option>
                                                    <option value="964">Iraq</option>
                                                    <option value="353">Ireland</option>
                                                    <option value="972">Israel</option>
                                                    <option value="39">Italy</option>
                                                    <option value="1876">Jamaica</option>
                                                    <option value="81">Japan</option>
                                                    <option value="44">Jersey</option>
                                                    <option value="962">Jordan</option>
                                                    <option value="7">Kazakhstan</option>
                                                    <option value="254">Kenya</option>
                                                    <option value="686">Kiribati</option>
                                                    <option value="850">Korea North</option>
                                                    <option value="82">Korea South</option>
                                                    <option value="965">Kuwait</option>
                                                    <option value="996">Kyrgyzstan</option>
                                                    <option value="856">Laos</option>
                                                    <option value="371">Latvia</option>
                                                    <option value="961">Lebanon</option>
                                                    <option value="266">Lesotho</option>
                                                    <option value="231">Liberia</option>
                                                    <option value="218">Libya</option>
                                                    <option value="423">Liechtenstein</option>
                                                    <option value="370">Lithuania</option>
                                                    <option value="352">Luxembourg</option>
                                                    <option value="853">Macau S.A.R.</option>
                                                    <option value="389">Macedonia</option>
                                                    <option value="261">Madagascar</option>
                                                    <option value="265">Malawi</option>
                                                    <option value="60">Malaysia</option>
                                                    <option value="960">Maldives</option>
                                                    <option value="223">Mali</option>
                                                    <option value="356">Malta</option>
                                                    <option value="44">Man (Isle of)</option>
                                                    <option value="692">Marshall Islands</option>
                                                    <option value="596">Martinique</option>
                                                    <option value="222">Mauritania</option>
                                                    <option value="230">Mauritius</option>
                                                    <option value="269">Mayotte</option>
                                                    <option value="52">Mexico</option>
                                                    <option value="691">Micronesia</option>
                                                    <option value="373">Moldova</option>
                                                    <option value="377">Monaco</option>
                                                    <option value="976">Mongolia</option>
                                                    <option value="1664">Montserrat</option>
                                                    <option value="212">Morocco</option>
                                                    <option value="258">Mozambique</option>
                                                    <option value="95">Myanmar</option>
                                                    <option value="264">Namibia</option>
                                                    <option value="674">Nauru</option>
                                                    <option value="977">Nepal</option>
                                                    <option value="599">Netherlands Antilles</option>
                                                    <option value="31">Netherlands The</option>
                                                    <option value="687">New Caledonia</option>
                                                    <option value="64">New Zealand</option>
                                                    <option value="505">Nicaragua</option>
                                                    <option value="227">Niger</option>
                                                    <option value="234">Nigeria</option>
                                                    <option value="683">Niue</option>
                                                    <option value="672">Norfolk Island</option>
                                                    <option value="1670">Northern Mariana Islands</option>
                                                    <option value="47">Norway</option>
                                                    <option value="968">Oman</option>
                                                    <option value="92">Pakistan</option>
                                                    <option value="680">Palau</option>
                                                    <option value="970">Palestinian Territory Occupied</option>
                                                    <option value="507">Panama</option>
                                                    <option value="675">Papua new Guinea</option>
                                                    <option value="595">Paraguay</option>
                                                    <option value="51">Peru</option>
                                                    <option value="63">Philippines</option>
                                                    <option value="0">Pitcairn Island</option>
                                                    <option value="48">Poland</option>
                                                    <option value="351">Portugal</option>
                                                    <option value="1787">Puerto Rico</option>
                                                    <option value="974">Qatar</option>
                                                    <option value="262">Reunion</option>
                                                    <option value="40">Romania</option>
                                                    <option value="70">Russia</option>
                                                    <option value="250">Rwanda</option>
                                                    <option value="290">Saint Helena</option>
                                                    <option value="1869">Saint Kitts And Nevis</option>
                                                    <option value="1758">Saint Lucia</option>
                                                    <option value="508">Saint Pierre and Miquelon</option>
                                                    <option value="1784">Saint Vincent And The Grenadines</option>
                                                    <option value="684">Samoa</option>
                                                    <option value="378">San Marino</option>
                                                    <option value="239">Sao Tome and Principe</option>
                                                    <option value="966">Saudi Arabia</option>
                                                    <option value="221">Senegal</option>
                                                    <option value="381">Serbia</option>
                                                    <option value="248">Seychelles</option>
                                                    <option value="232">Sierra Leone</option>
                                                    <option value="65">Singapore</option>
                                                    <option value="421">Slovakia</option>
                                                    <option value="386">Slovenia</option>
                                                    <option value="44">Smaller Territories of the UK</option>
                                                    <option value="677">Solomon Islands</option>
                                                    <option value="252">Somalia</option>
                                                    <option value="27">South Africa</option>
                                                    <option value="0">South Georgia</option>
                                                    <option value="211">South Sudan</option>
                                                    <option value="34">Spain</option>
                                                    <option value="94">Sri Lanka</option>
                                                    <option value="249">Sudan</option>
                                                    <option value="597">Suricountry_name</option>
                                                    <option value="47">Svalbard And Jan Mayen Islands</option>
                                                    <option value="268">Swaziland</option>
                                                    <option value="46">Sweden</option>
                                                    <option value="41">Switzerland</option>
                                                    <option value="963">Syria</option>
                                                    <option value="886">Taiwan</option>
                                                    <option value="992">Tajikistan</option>
                                                    <option value="255">Tanzania</option>
                                                    <option value="66">Thailand</option>
                                                    <option value="228">Togo</option>
                                                    <option value="690">Tokelau</option>
                                                    <option value="676">Tonga</option>
                                                    <option value="1868">Trincountry_idad And Tobago</option>
                                                    <option value="216">Tunisia</option>
                                                    <option value="90">Turkey</option>
                                                    <option value="7370">Turkmenistan</option>
                                                    <option value="1649">Turks And Caicos Islands</option>
                                                    <option value="688">Tuvalu</option>
                                                    <option value="256">Uganda</option>
                                                    <option value="380">Ukraine</option>
                                                    <option value="971">United Arab Emirates</option>
                                                    <option value="44">United Kingdom</option>
                                                    <option value="1">United States</option>
                                                    <option value="1">United States Minor Outlying Islands</option>
                                                    <option value="598">Uruguay</option>
                                                    <option value="998">Uzbekistan</option>
                                                    <option value="678">Vanuatu</option>
                                                    <option value="39">Vatican City State (Holy See)</option>
                                                    <option value="58">Venezuela</option>
                                                    <option value="84">Vietnam</option>
                                                    <option value="1284">Virgin Islands (British)</option>
                                                    <option value="1340">Virgin Islands (US)</option>
                                                    <option value="681">Wallis And Futuna Islands</option>
                                                    <option value="212">Western Sahara</option>
                                                    <option value="967">Yemen</option>
                                                    <option value="38">Yugoslavia</option>
                                                    <option value="260">Zambia</option>
                                                    <option value="26">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group docAttached">
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control-file" id="idfile" name="idfile" value="" placeholder="<?= lang('App.add_id_doc'); ?>">
                                                <label for="idfile"><?= lang('App.add_id_doc'); ?></label>
                                            </div>
                                        </div>



                                        <div class="form-group ">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="taxnum" name="taxnum" value="" placeholder="<?= lang('App.taxid'); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group docAttached">
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control-file" id="niufile" name="niufile" value="" placeholder="<?= lang('App.add_taxid_doc'); ?>">
                                                <label for="niufile"><?= lang('App.add_taxid_doc'); ?></label>

                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group form-inline" style="text-align:left;">
                                                <span id="lbrequestor" style="margin-top: 5px;"><?= lang('App.applicant_status'); ?></span>
                                                <div style="margin-left:20px;">
                                                    <div id="radio-group-req" style="display:inline-block;">
                                                        <input type="radio" class="radiobox" name="requestor" id="requestor1" value="1" checked>
                                                        <span id="lbrequestor1" style="margin-top: 10px;color: #1B75BB; "><?= lang('App.landlord'); ?> </span><!-- <br> -->
                                                        <input type="radio" class="radiobox" style="margin-left: 10px;" name="requestor" id="requestor2" value="2">
                                                        <span id="lbrequestor2" style="margin-top: 10px;color: #1B75BB; "> <?= lang('App.tenant'); ?> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">


                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="formElt left">

                                        <div class="form-group col-sm-12 form-inline" style="text-align:left;">
                                            <span id="lbtypeBranch" style="margin-top: 10px;"><?= lang('App.requested_service'); ?> </span>
                                            <div style="margin-left:1px;">
                                                <div id="radio-group-branch" style="display:inline-block;">
                                                    <input type="radio" class="radiobox service_type" name="typeBranch" id="typeBranch" value="1" checked>
                                                    <span id="lbBranch1" style="margin-top: 5px;color: #1B75BB; "><?= lang('App.new_connection'); ?> </span><br>
                                                    <input type="radio" class="radiobox service_type" name="typeBranch" style="margin-left: 1px;" id="typeBranch" value="2">
						    <span id="lbBranch2" style="margin-top: 5px;color: #1B75BB; "><?= lang('App.submeter'); ?></span><br>
                                                    <input type="radio" class="radiobox service_type" name="typeBranch" style="margin-left: 1px;" id="typeBranch" value="4">
	                                            <span id="lbBranch4" style="margin-top: 5px;color: #1B75BB; "><?= lang('App.new_connection_with_submeter'); ?></span><br>
                                                    <input type="radio" class="radiobox service_type" name="typeBranch" style="margin-left: 1px;" id="typeBranch" value="3">
                                                    <span id="lbBranch3" style="margin-top: 5px;color: #1B75BB; "><?= lang('App.meter_conversion'); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12 newConnection subMeter">
                                            <input type="text" class="form-control" id="contract" name="contract" value="" placeholder="<?= lang('App.contract_number'); ?>">
                                        </div>
                                        <div class="form-group col-sm-12 newConnection subMeter">
                                            <input type="text" class="form-control" readonly id="agency" name="agency" value="" placeholder="<?= lang('App.agency'); ?>">
                                        </div>

                                        <div class="col-md-12 p-0 newConnection subMeter">
                                            <div class="col-md-12 form_field_outer p-0">
                                                <div class="row form_field_outer_row">

                                                    <div class="form-group col-sm-12 form-inline " style="text-align:left;">
                                                        <span id="lbtypeComp" style="margin-top:5px;"><?= lang('App.meter_type'); ?></span>
                                                        <div style="margin-left:5px;">
                                                            <div id="radio-group-comp" style="display:inline-block;">
                                                                <input type="radio" class="radiobox" name="typeCompteur" id="typeComp1" value="1" checked>
                                                                <span id="lbComp1" style="margin-top: 10px;color: #1B75BB; "><?= lang('App.postpaid'); ?></span><!-- <br> -->
                                                                <input type="radio" class="radiobox" style="margin-left: 5px;" name="typeCompteur" id="typeComp2" value="2">
                                                                <span id="lbComp2" style="margin-top: 10px;color: #1B75BB; "><?= lang('App.prepaid'); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-sm-12 form-inline ">
                                                        <select name="power" id="power" class="form-control">
                                                            <option value="" disabled="" selected=""><?= lang('App.requested_power'); ?></option>
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
                                                        <span id="lbmeterType" style="margin-left: 1px;"> <?= lang('App.connection_type'); ?> </span>
                                                        <div style="text-align:center; margin-left:3px;">
                                                            <div id="radio-group-met" style="display:inline-block;">
                                                                <input type="radio" class="radiobox" name="meterType" id="meterType1" value="01211" checked>
                                                                <span id="lbMet2" style="margin-top: 10px;color: #1B75BB; "> <?= lang('App.two_wires'); ?></span><br>
                                                                <input type="radio" class="radiobox" name="meterType" id="meterType2" value="01212">
                                                                <span id="lbMet2" style="margin-top: 10px;color: #1B75BB; "> <?= lang('App.four_wires'); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-sm-12 appliances ">
                                                        <input type="text" style="height: 100px;" data-toggle="tooltip" data-placement="top" title="<?= lang('App.appliances_desc'); ?>" class="form-control" id="appliances" name="appliances" value="" placeholder="<?= lang('App.appliances'); ?>">
                                                    </div>

                                                    <div class="form-group col-sm-12 newConnection networkDis ">
                                                        <input type="text" data-toggle="tooltip" data-placement="top" title="<?= lang('App.networkDis_desc'); ?> (m)" class="form-control" id="networkDis" name="networkDis" value="" placeholder="<?= lang('App.networkDis'); ?>">
                                                    </div>

                                                    <div class="form-group col-sm-12 form-inline newConnection " style="text-align:left;">
                                                        <span id="lbtypeComp" style="margin-top:5px;"><?= lang('App.cableExist'); ?></span>
                                                        <div style="margin-left:5px;">
                                                            <div id="radio-group-comp" style="display:inline-block;">
                                                                <input type="radio" class="radiobox" name="cableExist" id="cableExist1" value="1" checked>
                                                                <span id="lbComp1" style="margin-top: 10px;color: #1B75BB; "><?= lang('App.yes'); ?></span><!-- <br> -->
                                                                <input type="radio" class="radiobox" style="margin-left: 5px;" name="cableExist" id="cableExist2" value="2">
                                                                <span id="lbComp2" style="margin-top: 10px;color: #1B75BB; "><?= lang('App.no'); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6 form-inline subMeter" style="text-align:left;">
                                                        <span id="lbtypeComp" style="margin-top:5px;"><?= lang('App.meter_quantity'); ?> </span>
                                                        <input type="number" class="form-control" name="qty-0" access="false" id="qty-0" size="3">
                                                    </div>
                                                    <!--
                                                    <div class="form-group subMeter col-md-6 add_del_btn_outer">
                                                         <button class="btn_round add_node_btn_frm_field" title="Copy or clone this row">
                                                            <i class="fas fa-copy"></i>
                                                        </button> 

                                                        <button class="btn_round remove_node_btn_frm_field" disabled>
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                    -->

                                                </div>
                                            </div>
                                        </div>
                                        <!--
                                        <div class="col-md-12 subMeter">
                                            <button class="btn btn-outline-lite py-0 add_new_frm_field_btn"><i class="fas fa-plus add_icon"></i> <?= lang('App.add_new_block'); ?></button>
                                        </div>
                                         -->
                                    </div>
                                    <input type="hidden" id="submeter_groups" name="submeter_groups" value="" />


                                </div>
                                <div class="col-lg-6">
                                    <div class="formElt right">

                                        <div class="form-group col-sm-12 form-inline subMeter">
                                            <span id="lbtypeComp"><?= lang('App.nb_distribution_box'); ?></span>
                                            <div class="input-group number-spinner " style="margin-left:5px;">
                                                <input type="number" name="nbdistbox" id="nbdistbox" class="form-control text-center" size="3" value="">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12 form-inline newConnection subMeter">
                                            <select name="constType" id="constType" class="form-control house_type">
                                                <option value="" disabled="" selected=""><?= lang('App.construction_type'); ?></option>
                                                <option value="1">Studio </option>
                                                <option value="2">Appartement</option>
                                                <option value="3">Villa</option>
                                                <option value="4">Duplex</option>
                                                <option value="5">Building</option>
                                            </select>
                                            <select name="floor" id="floor" class="form-control buildings" style="margin-left:10px;">
                                                <option value="" disabled="" selected=""><?= lang('App.number_of_floor'); ?></option>
                                                <option value="R0">R+0</option>
                                                <option value="R1">R+1</option>
                                                <option value="R2">R+2</option>
                                                <option value="R3">R+3</option>
                                                <option value="RAutre">&gt;R+3</option>
                                            </select>
                                        </div>

                                        <div class="form-group premiseLoc newConnection subMeter">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="premiseLoc" name="premiseLoc" value="" placeholder="<?= lang('App.localisation'); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group docAttached  newConnection subMeter">
                                            <div class="col-sm-12" style="text-align : left; margin-left:5px;">
                                                <input type="file" class="form-control-file" id="billfile" name="billfile" value="" placeholder="<?= lang('App.add_bill_doc'); ?>">
                                                <label for="billfile"><?= lang('App.add_bill_doc'); ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group docAttached2  newConnection subMeter">
                                            <div class="col-sm-12" style="text-align : left; margin-left:5px;">
                                                <input type="file" class="form-control-file" id="letterfile" name="letterfile" value="" placeholder="<?= lang('App.add_request_doc'); ?>">
                                                <label for="letterfile"><?= lang('App.add_request_doc'); ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group docAttached3  newConnection subMeter">
                                            <div class="col-sm-12" style="text-align : left; margin-left:5px;">
                                                <input type="file" class="form-control-file" id="planfile" name="planfile" value="" placeholder="<?= lang('App.add_location_doc'); ?>">
                                                <label for="planfile"><?= lang('App.add_location_doc'); ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group docAttached4 newConnection subMeter">
                                            <div class="col-sm-12" style="text-align : left; margin-left:5px;">
                                                <input type="file" class="form-control-file" id="housefile" name="housefile" value="" placeholder="<?= lang('App.add_housepic_doc'); ?>">
                                                <label for="housefile"><?= lang('App.add_housepic_doc'); ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group docAttached4 newConnection subMeter">
                                            <div class="col-sm-12" style="text-align : left; margin-left:5px;">
                                                <input type="file" class="form-control-file" id="meterfile" name="meterfile" value="" placeholder="<?= lang('App.add_meterpic_doc'); ?>">
                                                <label for="meterfile"><?= lang('App.add_meterpic_doc'); ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group docAttached4 newConnection subMeter">
                                            <div class="col-sm-12" style="text-align : left; margin-left:5px;">
                                                <input type="file" class="form-control-file" id="permitfile" name="permitfile" value="" placeholder="<?= lang('App.add_permitfile_doc'); ?>">
                                                <label for="permitfile"><?= lang('App.add_permitfile_doc'); ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group form-inline conversion" style="text-align:left;">
                                            <span id="lbtypeComp" style="margin-top:5px;"><?= lang('App.conversion_message_head'); ?></span><br />
                                        </div>

                                        <div class="form-group form-inline conversion" style="text-align:left;">
                                            <?= lang('App.conversion_message_body'); ?>
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
                                                <?= lang('App.condition_of_use'); ?>
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
                                <button class="spinner-button btn btn-primary btn-lg btn-success" id="form_submit" aria-haspopup="true" aria-expanded="false" style="margin:auto;"><i class="fa fa-upload"></i><?= lang('App.submit_button'); ?></button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </form>
    </div>

    <?= "<script>var Messages = " . json_encode(lang('App.messages')) . ';</script>';
    echo "<script>var validationOptions = " . json_encode(lang('App.validationOptions')) . ';</script>'; ?>
    <script> 
        const prevIdentity = document.getElementById('oidnum');
    </script>
    <script src="<?= base_url(); ?>/V2/js/app.js"></script>
    <script>
        $("#form_submit").on("click", function() {
            event.preventDefault();
            //$(".toolbar-bottom").hide();
            //$(this).html('<i class="fa fa-circle-o-notch fa-spin"></i> ' + Messages.processing);
            $(this).hide();

            $("#message_recapitulatif").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + Messages.sending);

            var case_id = null;
            var form = $('#connection_form')[0];
            var formData = new FormData(form);
            //console.log(formData);


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
		   /*
		    * error: function(jqXHR, textStatus, errorThrown) {
                        var el = $('<div style="color:red;"></div>').html('<strong>' + Messages.errorcreate + errorThrown + '!</strong');
                        $("#message_recapitulatif").append(el);
            	    }
		    */
                })
                .done(function(resp) {

                    var el = $('<div id="error"></div>').html(Messages.backto + '<a href="<?= url_to('home') ?>">' + Messages.homepage + '</a>');
                    $("#message_recapitulatif").append(el);
                    $("#form_submit").prop("disabled", true);
                    $("#form_submit").hide();
                    $(".tab-content").height("auto");
                })


        });
    </script>
</body>

</html>
