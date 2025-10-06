<!DOCTYPE html>

<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="{{ asset('img/favicon.ico') }}" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('js/intl-tel-input-12.1.0/build/css/intlTelInput.css') }}">
    <title>Eneo Cameroon - MyEasyLight par SMS, WhatsApp ou Email: Ma facture d'electricité, quand je veux!</title>
    <meta name="rights" content="Eneo Cameroon S.A." />
    <meta name="description"
          content="Service d'accès simplifié aux factures d'electricité, paiement en ligne et reçu électronique. Envoi ton N° Contrat au 667 90 90 90" />
    <meta name="keywords" content="Eneo, cameroun, cameroon, energy, energie, fournisseur d'électricité, Electricité cameroun, Particuliers, entreprises, professionnels, industriels,Electricity Cameroon, ménages, abonnement, branchement, facture, paiement, mobile money, actualité, Economie d'énergie, Conseils sécurité, MyEasyLight, EasyLight, easyconnection, compteur,Centre de Presse, Alertes réseau, compteur,courant, Orange, MTN, Express Union, Express Exchange,Agence en ligne, Online Agency,Logo Eneo,Centrale gaz,Joel Nana Kontchou, Courant, Facture électronique, ebills, e-bills, electronic bills, Mobile Payement, Online Payement,Impayés,délestages,

coupures,Outages,Emploi " />

    <script language="javascript" src="{{ asset('js/jquery.min.js') }}"></script>

    <script language="javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/libphonenumber-js/1.7.7/libphonenumber-js.min.js"></script>
    <script src="{{ asset('js/intl-tel-input-12.1.0/build/js/intlTelInput.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-170927595-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-170927595-1');
    </script>
</head>
<body class="text-center">

<div class="container global" style=" margin:10px auto;">
    @include ('flash::message')
    <form action="{{ url('fr/customer/store') }}" method="POST" id="myForm">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-md-6" style="padding-top:20px;">
                <img src="{{ asset('img/enteteMK.png') }}" class="headImg" >
                <div class="content_lang"><a href="{{ url('/en/home') }}" id="lang" data-id="fr">[ English ]</a> </div>
                <br/><br/>
            </div>

            <div class="col-md-6" style="padding-top:20px;">
                <img src="{{ asset('img/Enep-eBills-Service-FR.png') }}" class="headImg" >
            </div>

        </div>

        <div class="row" style="padding-top:20px;">

            <div class="col-md-6">


                <div class="row ">
                    <div class="col-md-12">
                        <div class="descrip">Par quel canal souhaitez-vous dorénavant recevoir votre facture d'électricité d'Eneo ?</div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 " style="text-align : left; margin-left:20px;" ><label class="radio-inline check">
                            <input type="radio" class="radiobox" name="choix" value="WHA" @if(old('choix') == "WHA") {{'checked="checked"'}} @endif>
                            <span style="margin-top:10px; margin-left:20px; position: absolute;">WhatsApp</span></label></div>
                    <div class="col-md-12 " style="text-align : left; margin-left:20px;" ><label class="radio-inline check">
                            <input type="radio" class="radiobox" name="choix" value="SMS" @if(old('choix') == "SMS") {{'checked="checked"'}} @endif>
                            <span style="margin-top:10px; margin-left:20px; position: absolute;">SMS</span></label></div>
                    <div class="col-md-12 " style="text-align : left; margin-left:20px;" ><label class="radio-inline check">
                            <input type="radio" class="radiobox" name="choix" id="choix-mail" value="MAIL" @if(old('choix') == "MAIL") {{'checked="checked"'}} @endif>
                            <span style="margin-top:10px; margin-left:20px; position: absolute;">Email</span></label></div>

                </div>

            </div>
            <div class="col-md-6">

                <div class="formElt left">
                    @include('errors.list')
                    <div class="form-group row">
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="tel" name="tel" value="{{ old('tel') }}" placeholder="N° Téléphone *">
                        </div>
                        <div class="col-sm-5">
                            <label class="checkbox-inline check">
                                <input type="checkbox" name="isWatsapp" class="checkbox-c" value="1" @if(old('isWatsapp') == "1") {{'checked="checked"'}} @endif>
                                <span> Cochez si c'est un numéro WhatsApp. </span></label>

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="contract" name="contract" value="{{ old('contract') }}" placeholder="N° Contrat Eneo *" >
                        </div>
                        <div class="col-sm-5">
                            <label class="checkbox-inline check">
                                <input type="checkbox" class="checkbox-c" name="isyourContract" value="1"  @if(old('isyourContract') == "1") {{'checked="checked"'}} @endif>
                                <span> Cochez si ce N° contrat n'est pas en votre nom. </span></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" placeholder="Votre Nom *">
                        </div>
                    </div>
                    <div class="form-group row e-mail" >
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Votre Email (optionnel)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select name="language" id="language" class="form-control">
                                <option value="" disabled selected>Langue du Message *</option>
                                <option value="en" @if (old('language') == 'en') selected="selected" @endif>Anglais</option>
                                <option value="fr" @if (old('language') == 'fr') selected="selected" @endif>Français</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            {{--{!! NoCaptcha::display() !!}--}}
                            {!! NoCaptcha::renderJs('fr') !!}
                            {!! app('captcha')->display(); !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">

                        <input class="form-check-input check-condition" type="checkbox" id="CheckCondition" value="1" name="conditionAccepted">
                        <label class="checkbox-inline conditions_utilisation" for="CheckCondition">
                            J'accepte les 	<a href="{{ url('conditions_utilisation.pdf') }}" class="link-condition" target="_blank"> conditions d'utilisation </a>
                            de ce service 						</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="submit" value="JE VALIDE MON CHOIX " class="btn btn-primary ">
                    </div>
                </div>

            </div>

        </div>
    </form>
</div>

<script language="javascript" src="{{ asset('js/subscription.js') }}"></script>
</body>

</html>