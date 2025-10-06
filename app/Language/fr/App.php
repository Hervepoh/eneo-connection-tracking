<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// Validation language settings
return [
	// Core Messages
	'home'       => 'Accueil',
	'welcome'       => 'Bienvenue sur le portail client',
	'connection_form' => 'Nouvelle demande de branchement',
	'welcomeConnectionTitle'    => "Tant d'avantages !",
	'welcome_connection_lbl' => 'Profitez de tous nos services digitaux en quelques clics. Choisissez le service , entrez vos données personnelles.',
	'welcome_connection_btn'     => 'Demande de branchement',
	'welcome_AddPanel_btn'     => 'Ajout de Panneau supplémentaire',
	'welcome_subcription_btn'     => 'Abonnement à la e-facture ',
	'welcomeFollowupTitle'     => 'Suivi des demandes',
	'welcome_followUp_lbt'     => 'Vous avez déjà fait une demande et vous souhaitez la suivre ? Suivez votre demande en utilisant votre numéro de ticket',
	'welcome_followUp_btn'     => 'Suivi',
	'welcome_claim_btn'     => 'Réclamation',
	'welcome_apply_lbl'     => "Vous souhaitez initier une demande de branchement ? c'est très simple, il vous suffit de suivre les instructions.",
	'welcome_apply_btn'     => 'Faire une demande',

	'welcome_search_txt'     => 'Suivez votre demande en utilisant votre numéro de ticket',
	'welcome_search_lbl'     => 'Numéro du ticket de la demande',
	'welcome_search_btn'     => 'Rechercher',

	'pageTitle'    => 'Demande de Branchement en Ligne',
	'step1BoldMessage' => 'Bienvenus !',
	'step2BoldMessage' => 'Votre Besoin !',
	'step3BoldMessage' => 'Finalement !',
	'step1ThinMessage' => 'A propos de vous !',
	'step2ThinMessage' => 'Decrivez votre besoin !',
	'step3ThinMessage' => 'Allons-y !',
	'ruleNotFound'    => '{0} n\'est pas une règle valide.',
	'groupNotFound'   => '{0} n\'est pas un groupe de règles de validation.',
	'groupNotArray'   => 'Le groupe de règles {0} doit être un tableau.',
	'invalidTemplate' => '{0} n\'est pas un modèle de Validation valide.',

	'request' => 'Demande',
	'request_in_process'  => 'en cours de traitement , revenez plus tard pour avoir votre devis ! ',
	'request_in_sucess' => ', Votre devis est disponible',
	'not_found' => 'introuvable',
	'view_more' => 'plus d informations',
	'work_request' => 'Référence de travail',
	'amount' => 'Montant',
	'quotation' => 'Devis',
	'payment' => 'Paiement',
	'period' => 'Date',
	'connection' => 'Branchement',
	'back_home' => 'Retour à la page d\'accueil!',
	'unavailable' => 'non disponible',

	// Region	
        'west'   => 'Ouest',
        'north_west'   => 'Nord-Ouest',
        'south_west'   => 'Sud-Ouest',

	// Form Labels Messages
	'youare' 	=> 'Vous êtes',
	'physical'  => 'Personne Physique',
	'moral'     => 'Personne Morale',
	'courtesy'                 => 'Civilité',
	'firstname'            => 'Prénom(s)',
	'lastname'         => 'Nom(s)*',
	'residential_area'   => 'Region de residence *',
	'town'   => 'Ville de residence *',
	'email'           => 'Courriel',
	'cellphone'               => 'Téléphone *',
	'cellphone2'       => 'Téléphone 2',
	'is_whatsapp'               => 'Est WhatsApp?',
	'activity'               => 'Occupation *',
	'premise_activity'          => 'Activité du Lieu *',
	'document_type'          => 'Pièce d\'identité *',
	'document_number'          => 'Numéro Pièce d\'identité *',
	'new_id' => 'Nouvelle Carte',
	'old_id'                        => 'Ancienne Carte',
	'receip'                        => 'Recipissé',
	'passport'                      => 'Passport',
	'delivered_at'                  => 'Delivré à *',
	'expires_on'                    => 'Expire le *',
	'delivery_country'              => 'Pays de delivrance *',
	'add_id_doc'                    => 'Joindre pièce d\'identité *',
	'taxid'                         => 'Numéro d\'identification unique *',
	'tax_number'                    => 'NIU',
	'or'                            => 'ou',
	'add_taxid_doc'                 => 'Joindre le NIU *',
	'applicant_status'              => 'Statut requérant *',
	'landlord'                      => 'Propriétaire', //'Bailleur',
	'tenant'                        => 'Locataire',
	'requested_service'             => 'Service sollicité ',
	'new_connection'                => 'Nouveau Branchement',
	'submeter'                      => 'Panneau Supplementaire',
	'new_connection_with_submeter'  => 'Nouveau Branchement + Panneau Supplementaire',
	'meter_conversion'              => 'Conversion Postpayé-->Prépayé',
	'contract_number'               => 'Contrat Branchement mère ou du Voisin *',
	'agency'		=> 'Agence',
	'filesize'	     	=> 'Taille maximum de fichier : 500KB,types de fichiers(pdf,jpg,png)',
	'meter_type'                   => 'Type Compteur *',
	'postpaid'           => 'Postpayé',
	'prepaid'          => 'Prépayé',
	'next'	=> 'Suivant',
	'previous'  => 'Précédent',
	'yes'       => 'Yes',
	'no'	=> 'No',
	'requested_power'              => 'Puissance solicitée *',
	'connection_type'              => 'Type de connection *',
	'two_wires'             => '2 Fils',
	'four_wires'            => '4 Fils',
	'appliances'              => 'Utilisation principale *',
	'networkDis'              => 'Distance avec le réseau (m) *',
	'cableExist'	    => 'Existe-t-il déjà un câble électrique, partant d‘un poteau Eneo vers votre domicile? *',
	'appliances_desc'              => 'Please Describe Your Main Electrical Appliances, for Power Budget Estimation. E.G: 1 Frige, 2 TV, 1 AC Split *',
	'meter_quantity'              => 'Quantité *',
	'add_new_block'              => 'Ajouter un block',
	'nb_distribution_box'              => 'Nombre de Distributeurs *',
	'construction_type'             => 'Type de construction *',
	'number_of_floor'             => 'Nombre de niveaux',
	'localisation'            => 'Localisation *',
	'add_bill_doc'              => 'Joindre une facture',
	'add_request_doc'             => 'Joindre la demande *',
	'add_location_doc'            => 'Joindre Plan de Localisation *',
	'add_housepic_doc'              => 'Joindre la  photo de la maison *',
	'add_permitfile_doc'             => 'Joindre Accord d\'abonnement',
	'add_meterpic_doc'	=> 'Joindre la photo de l\'emplacement du compteur *',
	'conversion_message_head'              => 'Rendez vous à votre Agence ENEO ou contacter l\'agence en Ligne: ',
	'conversion_message_body'              => '<address>
	<strong>Agence En Ligne</strong><br>
	Avenue Koumassi<br>
	Bali, Douala I<br>
	<abbr title="Phone">Tel:</abbr> (237)695 51 11 11 
	</address>',
	'condition_of_use'            => 'J\'accepte ces termes de service et <a href="conditions_utilisation.pdf" class="link-condition" style="color: #1B75BB;" target="_blank"> conditions d\'utilisation </a>',
	'submit_button'            => 'Soumettre',


	'premise_activity_fields' => [
		'APARTMENTS_BUILDING' => 'IMMEUBLES D\'HABITATION',
		'BUILDING'            => 'BUILDING',
		'CHURCH'              => 'EGLISE',
		'CINEMA'              => 'CINEMA',
		'CITY_CENTRE'         => 'CENTRE VILLE',
		'CLINIC'              => 'CLINIQUE',
		'COMPOUND'            => 'COMPOUND',
		'EDUCATIONAL_CENTRE'  => 'CENTRE DE FORMATION',
		'FACTORY'             => 'FACTORY',
		'FARM'                => 'FERME',
		'GAS_STATION'         => 'STATION D\'ESSENCE',
		'HOSPITAL'            => 'HOPITAL',
		'HOTEL'               => 'HOTEL',
		'HOUSE'               => 'MAISON',
		'MARKET'              => 'MARKET',
		'MOSQUE'              => 'MOSQUE',
		'PALACE'              => 'PALACE',
		'PARKING_LOT'         => 'PARKING',
		'PRISON'              => 'PRISON',
		'RESTAURANT'          => 'RESTAURANT',
		'SHOP'                => 'SHOP',
		'SPORT_CLUB'          => 'SPORT CLUB',
		'SQUARE'              => 'SQUARE',
		'STADIUM'             => 'STADE',
		'ELECTRIC_SUB_STATION' => 'STATION SECONDAIRE ÉLECTRIQUE',
		'TERRAIN'              => 'TERRAIN',
		'WAREHOUSE'            => 'ENTREPOT',
		'WATER_PUMP'           => 'POMPE À EAU (USINE)',
		'WORKSHOP'             => 'ATELIER',
		'AIRLINE'              => 'AIRLINE',
		'CONSTRUCTION'         => 'CONSTRUCTION',
		'MILL'                 => 'MOULIN',
		'RECREATIONAL_CENTRE'  => 'CENTRE DE LOISIRS',
		'STREET_LIGHT'         => 'ECLAIRAGE PUBLIC',
		'INDIVIDUAL'           => 'INDIVIDUEL',
		'COMPANY'              => 'SOCIETE',
		'INSTITUTION'          => 'INSTITUTION',
		'GOVERNMENT'           => 'GOUVERNEMENT',
		'MUNICIPAL'            => 'MUNICIPAL',
		'PARASTATALS'          => 'PARASTATALS',
		'SCHOOLS'              => 'ECOLE'
	],

	// js
	'messages' => [
		'sending' => 'Envoi des information au serveur...',
		'success' => 'Succès',
		'ticket_number' => 'Votre numero de ticket est ',
		'processing' => 'Traitement',
		'backto' => 'Retour à la ',
		'homepage' => 'Page d\'accueil!',
		'complete' => 'Terminé!',
		'errorcreate' => 'Erreur lors de la creation du ticket, revenez plus tard'
	],
	'validationOptions' => [
		// Specify validation rules
		'rules' => [
			'region' => "required",
			'lastname' => "required",
			'raisonsociale' => "required",
			'phone' => ['required' => true, 'digits' => true,'minlength' => 9,'maxlength' => 9],
			'phone_2' => ["digits" => true, 'maxlength' => 9],
			'activity' => "required",
			'premise_activity' => "required",
			'document_type' => "required",
			'DeliveredAt' => "required",
			'ExpiresOn' => "required",
			'nbdistbox' => "required",
			'meter_quantity' => ['required' => true, 'digits' => true],
			'qty-0' =>  ['required' => true, 'digits' => true, 'min' => 0, 'max' => 50],
			//'contract' => ['required' => true, 'digits' => true, 'minlength' => 9, 'maxlength' => 9],
						'contract' => ['required' => true, 'contractFormat' => true , 'contractExist' => true],
			'typeCompteur' => "required",
			'connection_type' => "required",
			'networkDis' => ["required" => true, 'digits' => true],
			'power' => "required",
			'appliances' => "required",
			'constType' => "required",
			'premiseLoc' => "required",
			'CheckCondition' => "required",
			'conditionAccepted' => "required",
			'cableExist' => "required",
			'idfile' => [
				'required' => true,
				'extension' => "png|jpeg|jpg|pdf",
				'filesize' => 524288,
			],
			'niufile' => [
				'required' => true,
				'extension' => "png|jpeg|jpg|pdf",
				'filesize' => 524288,
			],

			'letterfile' => [
				'required' => true,
				'extension' => "png|jpeg|jpg|pdf",
				'filesize' => 524288,
			],
			'planfile' => [
				'required' => true,
				'extension' => "png|jpeg|jpg|pdf",
				'filesize' => 524288,
			],
			'housefile' => [
				'required' => true,
				'extension' => "png|jpeg|jpg|pdf",
				'filesize' => 524288,
			],
			'meterfile' => [
				'required' => true,
				'extension' => "png|jpeg|jpg|pdf",
				'filesize' => 524288,
			],


			'doccountry' => "required",
			'taxnum' => "required",
			'requestor' => "required"


		],
		// Specify validation error messages
		'messages' => [
			'region' => "Votre région est requise",
			'lastname' => "Votre nom est requis",
			'raisonsociale' => "Votre Raison Sociale est requise",
			'phone' => [
				'required' => "Votre téléphone est requis",
				'digits' => "Le numéro de téléphone doit contenir uniquement des chiffres ex: 699999909",
				'minlength' => 'Le numéro de téléphone doit contenir 9 chiffres',
				'maxlength' => 'Le numéro de téléphone doit contenir 9 chiffres'
			],
			'phone_2' => "Le numéro de téléphone doit contenir uniquement des chiffres ex: 699999909",
			'activity' => "Votre activité est requise",
			'premise_activity' => "Indiquer l'activité menée",
			'document_type' => "Type du document d'identité requis",
			'DeliveredAt' => "Indiquer le lieu de delivrance",
			'ExpiresOn' => "Indiquer la date d'expiration",
			'nbdistbox' => "Indiquer le nombre de Distributeurs présents",
			'typeCompteur' => "Indiquer le type de compteur voulu",
			'networkDis' => [
				'required' => "Indiquer la distance au réseau",
				'digits' => "La distance au réseau ne doit contenir que des chiffres"
			],
			'meter_type' => "Indiquer le type de connection désiré",
			'power' => "Indiquer l' Ampérage désiré",
			'appliances' => "Citer les appareils électriques",
			'constType' => "Indiquer le type de construction",
			'premiseLoc' => "Indiquer la localisation",
			'CheckCondition' => "Accepter les termes et conditions",
			'conditionAccepted' => "Accepter les termes et conditions",
			'cableExist' => "Indiquer si un cable electrique Eneo existe",
			'meter_quantity' => [
				'required' => "Indiquer le nombre de panneaux suppléméntaires désirés",
				'digits' => "La quantité doit contenir uniquement des chiffres",
				'max' => "Veuillez entrer une valeur inférieure ou égale à 50",
			],
			'qty-0' => [
				'required' => "Indiquer le nombre de panneaux suppléméntaires désirés",
				'digits' => "La quantité doit contenir uniquement des chiffres",
				'max' => "Veuillez entrer une valeur inférieure ou égale à 50",
				'min' => "Le nombre de panneau supplémentaire doit etre supérieur ou égale à 1"
			],
			'contract' => [
				'required' => 'Indiquer le numéro de contrat',
				'digits' => 'Le numéro de contrat ne contient que des lettres',
				'minlength' => 'La taille du contrat est de 9 chars',
				'maxlength' => 'La taille du contract est de 9 chars',
				'contractFormat' => 'Contract must be either 9 digits or you can provide a quotation start with P OR E followed by 14 digits'
			],
			'idfile' => [
				'required' => "La pièce d'identité est requise",
				'extension' => "File must be JPEG, PNG or PDF",
				'filesize' => "Le fichier doit avoir une taille inférieure à  500KB"
			],
			'niufile' => [
				'required' => "Le NIU est requis",
				'extension' => "Le fichier doit etre de type JPEG, PNG or PDF",
				'filesize' => "Taille maximale du fichier  500KB"
			],
			'letterfile' => [
				'required' => "La demande est requise",
				'extension' => "Le fichier doit etre de type JPEG, PNG or PDF",
				'filesize' => "Taille maximale du fichier 500KB"
			],
			'planfile' => [
				'required' => "Le Plan de Localisation est requis",
				'extension' => "File must be JPEG, PNG or PDF",
				'filesize' => "Le fichier doit avoir une taille inférieure à  500KB"
			],
			'housefile' => [
				'required' => "Une Image de la maison est reuise",
				'extension' => "File must be JPEG, PNG or PDF",
				'filesize' => "Le fichier doit avoir une taille inférieure à  500KB"
			],
			'meterfile' => [
				'required' => "L' image de l'emplacement souhaité est requise",
				'extension' => "File must be JPEG, PNG or PDF",
				'filesize' => "Le fichier doit avoir une taille inférieure à  500KB"
			],

			'doccountry ' => "Le Pays de délivrance est requis",
			'taxnum' => "Entrez un numéro valide",
			'requestor' => "Le statut du demandeur est requis"
		]

	]


];
