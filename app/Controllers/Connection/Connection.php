<?php

namespace App\Controllers\Connection;

use App\Controllers\BaseController;
use App\Models\AttachmentModel;
use App\Models\ConnectionModel;
use App\Models\TownModel;

class Connection extends BaseController
{

    public function index()
    {
        // to be able to share session data 
        $session = session();
        helper(['form', "url", 'multi_language']);
        $townModel = new \App\Models\TownModel();
        $townsList = $townModel->findAll();
        $title =  'Eneo Cameroon - New Connection Form';

        return view('connection/connection_form', compact('title','townsList'));
    }

    public function save()
    {
        if ($this->request->getMethod() == "post") {
        //if ($this->request->getMethod() == "post" && $this->request->isAJAX()) {

            $error = [];
            $rules = [
                "person_type" => "required",
                "phone"       => "required|regex_match[/^[0-9]{9}$/]",
                "typeBranch"  => "required"
            ];

            if (!$this->validate($rules)) {
                $response = [
                    'success' => false,
                    'msg' => lang('App.messages.errorcreate')
                ];
                return $this->response->setJSON($response);
            } else {
                $person_type                   = $_POST['person_type'];
                $civility                      = $_POST['civility'] ?? "";
                $social_reason                 = $this->cleanText($_POST['social_reason']);
                $firstname                     = $person_type == '2' ?  "" : $this->cleanText($_POST['firstname']);
                $lastname                      = $person_type == '2' ?  $social_reason : $this->cleanText($_POST['lastname']);
                $appliances                    = $this->cleanText($_POST['appliances']);
                $email                         = $_POST['email'];
                # capture town information
                $town                          = $_POST['town'];
                $townModel = new TownModel();
		$townInfo = $townModel->select(['town.id','town.region_administrative','town.region','region.name','region_administrative.code_region'])
			              ->join('region_administrative','town.region_administrative=region_administrative.id')
			              ->join('region','town.region=region.id')->find($town);
		
		$region                        = ($townInfo) ? $townInfo['code_region'] : '';
                $region_administrative         = ($townInfo) ? $townInfo['name'] : '';
	       
	 	$phone                         = $_POST['phone'];
                $phone_2                       = $_POST['phone_2'];
                $is_whatsapp_2                 = !empty($_POST['is_whatsapp_2']) ? $_POST['is_whatsapp_2'] : "";
                $is_whatsapp                   = !empty($_POST['is_whatsapp']) ? $_POST['is_whatsapp'] : "";
                $taxnum                        = $this->cleanText($_POST['taxnum']);
                $identity_type_id              = $_POST['identity_type_id'];
                $identity_country              = $_POST['identity_country'];
                $identity_delivered_at         = $this->cleanText($_POST['identity_delivered_at']);
                $identity_expires_on           = $_POST['identity_expires_on'];
                $meter_type                    = $_POST['meterType'];
                $type_compteur                 = $_POST['typeCompteur'];
                $requestor                     = $_POST['requestor'];
                $premise_activity              = $_POST['premise_activity'];
                $activity                      = $this->cleanText($_POST['activity']);
                $construction_type             = !empty($_POST['constType']) ? $_POST['constType'] : "";
                $number_floor                  = !empty($_POST['floor']) ? $_POST['floor'] : "";
                $connection_type               = $_POST['typeBranch'];
                $networkDis                    = $_POST['networkDis'];
                $premise_location              = $this->cleanText($_POST['premiseLoc']);
                $agency                        = $_POST['agency'];
                $contract_number               = $_POST['contract'];
                $submeter_groups               = $_POST['submeter_groups'];
                $requested_power               = !empty($_POST['power']) ? $_POST['power'] : "";
                $existing_wire                 = $_POST['cableExist'];
                $meter_quantity                = $_POST['qty-0'];
                $distrib_number                = $_POST['nbdistbox'];

                if (($connection_type == 2 || $connection_type == 4) && ($meter_quantity <= 0 || $meter_quantity > 50)) {
                    $response = [
                        'success' => false,
                        'msg' => lang('App.validationOptions.messages.meter_quantity'),
                    ];
                    return $this->response->setJSON($response);
                }
                // DATA FORMATING
                $title            = $this->getFormatedTitle($person_type, $social_reason, $firstname, $lastname);
                $identity         = $this->getFormatedIdentity($identity_type_id, $_POST);
                $identity_type    = $identity['idtype'];
                $identity_number  = $identity['idnum'];

                $connection_type_label  = $this->getFormatedLabelMessage($connection_type);
                $sub_category           = $this->getFormatedCategory($connection_type);
                $sub_category_detail    = "commercial_" . $sub_category;

                //dd($connection_type,$submeter_groups,$_POST);
                $appliances       = $this->getFormatedAppliances($appliances, $connection_type, $submeter_groups, $_POST);
                $usage_description     = $connection_type_label . $appliances;
                $data = compact(
                    'title',
                    'social_reason',
                    "civility",
                    "person_type",
                    "lastname",
                    "firstname",
                    "region",
                    "region_administrative",
                    "town",   # capture town information
                    "email",
                    "phone",
                    "phone_2",
                    "is_whatsapp",
                    "is_whatsapp_2",
                    "activity",
                    "premise_activity",
                    "identity_type_id",
                    "identity_type",
                    "identity_number",
                    "identity_delivered_at",
                    "identity_expires_on",
                    "identity_country",
                    "taxnum",
                    "connection_type",
                    "connection_type_label",
                    "usage_description",
                    "appliances",
                    "contract_number",
                    "agency",
                    "type_compteur",
                    "requestor",
                    "requested_power",
                    "meter_type",
                    "networkDis",
                    "number_floor",
                    "existing_wire",
                    "construction_type",
                    "premise_location",
                    "meter_quantity",
                    "distrib_number",
                    "sub_category",
                    "sub_category_detail"
                );

                $requestModel = new ConnectionModel();
                $createCase = $requestModel->insert($data);       
	        $getCreateCaseId = $requestModel->find($createCase);
                $ticket_public = $this->getFormatedTicketNumber($getCreateCaseId['id_request']);
                //$requestModel->update($createCase, compact('ticket_public'));
		if ($getCreateCaseId['id_request'] <> 0) {
		    $requestModel->update($getCreateCaseId['id_request'], compact('ticket_public'));
                }

                foreach ($_FILES as $key => $file) {
                    $note = $this->getFormatedNoteInfo($key);

                    $file = $this->request->getFile($key);

                    if ($file->isValid() && !$file->hasMoved()) {
                        $filePath = WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . date('Y-m-d') . DIRECTORY_SEPARATOR . $createCase . DIRECTORY_SEPARATOR;
                        $fileName = $key . '.' . $file->guessExtension();
                        $file->move($filePath, $fileName);
                        $new_attachment = [
                            'file'          => $filePath . $fileName,
                            'filename'      => $fileName,
                            'id_request'    => $createCase,
                            'title'         => $note['title'] . $title,
                            'description'   => $note['description'],
                            'status'        => 'pending',
                        ];
                        $attachmentModel = new AttachmentModel();
                        $attachmentModel->save($new_attachment);
                        log_message('critical', 'file: ' . $file);
                    } else {
                        $error[$key] = $file->getErrorString();
                    }
                }

                $response = [
                    'success' => true,
                    'case_number' => $ticket_public,
                ];

                return $this->response->setJSON($response);
            }
        }
    }

    public function follow_middleware()
    { 
        if ($this->request->getMethod() == "post") {
            $rules = [
                "ticket_public" => "required",
                "taxnum"       => "required",
            ];
            if (!$this->validate($rules)) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }else{
                $ticket_public = $this->request->getPost("ticket_public");
                $taxnum = $this->request->getPost("taxnum");
                $connection = new ConnectionModel();
                $condition = array('ticket_public' => $ticket_public, 'taxnum' => $taxnum);
                if (!$data = $connection->where($condition)->first()) {
                    return redirect()->back()->with('error', "Ticket $ticket_public ".lang('App.or') ." ".lang('App.tax_number'). " $taxnum " .lang('App.not_found'));
                    //throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
                return redirect()->to('connection/follow/'.$data['ticket_public'].'/'.$data['taxnum']);
            }
        }
        
    }

    public function follow($ticket, $nui)
    {
        // to be able to share session data 
        $session = session();
        helper(['form', "url", 'multi_language']);
        $title =  'Eneo Cameroon - Request follow-up';
        $requestModel = new ConnectionModel();
        $condition = array('ticket_public' => $ticket, 'taxnum' => $nui);
        if (!$data = $requestModel->where($condition)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $attachmentModel = new AttachmentModel();
        $attachments = $attachmentModel->where('id_request', $data['id_request'])->findAll();


        return view('connection/connection_follow', compact('title', 'data', 'attachments'));
    }


    /**
     * Display the specified resource.
     * @param  string  $ticket
     * return \Illuminate\Http\Response
     */
    public function show($ticket,$nui)
    {
        $condition = array('ticket_public' => $ticket, 'taxnum' => $nui);
        $response = [
            'success' => false,
            'status' => 400,
            'message' => "Ressource $ticket " . lang("App.not_found")
        ];
        $requestModel = new ConnectionModel();
        $result = $requestModel->where($condition)
            ->first();

        if ($result) {
            $work_request = $result['work_request_number'];
            $quotation_amount = $result['quotation_amount'];
            $quotation_date = $result['quotation_date'];
            $msg = lang("App.request") . " $ticket ";
            $msg .=  ($work_request && $quotation_amount) ? lang("App.request_in_end") : lang("App.request_in_process");
            $response = [
                'success' => true,
                'status' => 200,
                'message' => $msg,
                'ticket_public' => $result['ticket_public'],
                'work_request' => $result['work_request_number'],
                'quotation_amount' => $result['quotation_amount'],
                'quotation_date' => $result['quotation_date']
            ];
        }

        return $this->response->setJSON($response);
        //return view('connection/connection_follow', compact('ticket','work_request','quotation_amount','quotation_date'));

    }


    private function getFormatedTicketNumber(string $ticket_number, $length = 5): string
    {
        return date("ym") . str_pad($ticket_number, $length, "0", STR_PAD_LEFT);
        // return date("y-m-d") .'-'. substr(str_repeat(0, $length).$ticket_number, - $length);

    }


    private function getFormatedTitle(string $type, string $social_reason = "", string $firstname = "", string $lastname = ""): string
    {
        $title = "";
        switch ($type) {
            case '1':  //Personne physique
                $title = implode('_', [$firstname, $lastname, "(Physique)"]);
                break;
            case '2': //Personne Morale
                $title = implode('_', [$social_reason, "(Morale)"]);
                break;
        }
        return $title;
    }


    private function getFormatedIdentity(string $type, $data): array
    {
        $result = [];
        switch ($type) {
            case "1":
                $result['idtype'] = "New ID";
                $result['idnum']  = $data['nidnum'];
                break;
            case "2":
                $result['idtype'] = "Old ID";
                $result['idnum']  = $data['oidnum'];
                break;
            case "3":
                $result['idtype'] = "ID Receip";
                $result['idnum'] = $data['ridnum'];
                break;
            case "4":
                $result['idtype'] = "Passport";
                $result['idnum'] = $data['pidnum'];
                break;
        }
        return $result;
    }


    private function getFormatedLabelMessage($type)
    {
        $result = "";
        switch ($type) {
            case 1:
                $result = "Nouvelle demande de branchement. Appareil Prévus: ";
                break;
            case 2:
                $result = "Nouvelle demande de panneaux supplementaires. Details: ";
		break;
            case 3:
                $result = "Nouvelle demande de convertion Postpaid-Prepaid. Details: ";
                break;
            case 4:
                $result = "Nouvelle demande de branchement avec panneaux supplementaires. Details: ";
                break;
        }
        return $result;
    }


    private function getFormatedCategory($type)
    {
        $result = "";
        switch ($type) {
            case 1:
                $result = "branchement_branchementneuf";
                break;
            case 2:
                $result = "branchement_branchementsupplementaire";
                break;
            case 3:
                $result = "Conversion_Postpaye-Prepaye";
		break;
	    case 4:
                $result = "branchement_branchementneufpanneausupplementaire";
                break;
        }
        return $result;
    }


    private function getFormatedAppliances($appliances, $type, $submeter_groups, $data)
    {
        $result = $appliances;
        if (($type == 2 || $type == 4) && ($submeter_groups > 0)) {
            for ($i = 1; $i < $submeter_groups; $i++) {
                $result .= isset($data['qty-' . $i]);
                $result .= " compteurs de type ";
                $result .= $data['typeCompteur' . $i];
                $result .= "  reglés à ";
                $result .= $data['power' . $i];
                $result .= " en ";
                $result .= $data['meterType' . $i];
                $result .= " Usage: ";
                $result .= $data['appliances' . $i];
            }
        }
        return  $result;
    }


    private function getFormatedNoteInfo($key)
    {
        $result = [
            'title' => "Attachment",
            'description' => ""
        ];
        switch ($key) {
            case 'idfile':
                $result['title'] .= "ID";
                $result['description']   = "ID Document file";
                break;
            case 'niufile':
                $result['title'] .= "NIU";
                $result['description'] = "NIU Document file";
                break;
            case 'billfile':
                $result['title'] .= "Bill";
                $result['description'] = "Bill Document file";
                break;
            case 'letterfile':
                $result['title'] .= "Letter";
                $result['description'] = "Connection Request file";
                break;
            case 'planfile':
                $result['title'] .= "Plan";
                $result['description'] = "Localisation Plan file";
                break;
            case 'housefile':
                $result['title'] .= "House";
                $result['description'] = "House Picture file";
                break;
            case 'permitfile':
                $result['title'] .= "ConnectionPermit";
                $result['description'] = "Connection Permission";
                break;
            case 'meterfile':
                $result['title'] .= "MeterPlace";
                $result['description'] = "Meter Place Picture";
                break;
        }
        return  $result;
    }

    private function formatPhoneNumber($phoneNumber)
    {
        // TODO format phone number
        // https://www.delftstack.com/fr/howto/php/php-format-phone-number/
        return str_replace(" ", "", $phoneNumber);
    }
 
   private function cleanText($text)
    {
        // TODO clean all text
        return str_replace('"', "",trim($this->replaceSpecialChar($text)));
    }


    private function replaceSpecialChar($str) {
          $ch0 = array(
            "æ"=>"ae",
            "&#256;" => "A",
            "&#258;" => "A",
            "&#461;" => "A",
            "&#7840;" => "A",
            "&#7842;" => "A",
            "&#7844;" => "A",
            "&#7846;" => "A",
            "&#7848;" => "A",
            "&#7850;" => "A",
            "&#7852;" => "A",
            "&#7854;" => "A",
            "&#7856;" => "A",
            "&#7858;" => "A",
            "&#7860;" => "A",
            "&#7862;" => "A",
            "&#506;" => "A",
            "&#260;" => "A",
            "ä" => "a",
            "å" => "a",
            "&#257;" => "a",
            "&#259;" => "a",
            "&#462;" => "a",
            "&#7841;" => "a",
            "&#7843;" => "a",
            "&#7845;" => "a",
            "&#7847;" => "a",
            "&#7849;" => "a",
            "&#7851;" => "a",
            "&#7853;" => "a",
            "&#7855;" => "a",
            "&#7857;" => "a",
            "&#7859;" => "a",
            "&#7861;" => "a",
            "&#7863;" => "a",
            "&#507;" => "a",
            "&#261;" => "a",
            "&#262;" => "C",
            "&#264;" => "C",
            "&#266;" => "C",
            "&#268;" => "C",
            "ç" => "c",
            "&#263;" => "c",
            "&#265;" => "c",
            "&#267;" => "c",
            "&#269;" => "c",
            "&#270;" => "D",
            "&#272;" => "D",
            "&#271;" => "d",
            "&#273;" => "d",
            "&#274;" => "E",
            "&#276;" => "E",
            "&#278;" => "E",
            "&#280;" => "E",
            "&#282;" => "E",
            "&#7864;" => "E",
            "&#7866;" => "E",
            "&#7868;" => "E",
            "&#7870;" => "E",
            "&#7872;" => "E",
            "&#7874;" => "E",
            "&#7876;" => "E",
            "&#7878;" => "E",
            "è" => "e",
            "é" => "e",
            "ê" => "e",
            "ë" => "e",
            "&#275;" => "e",
            "&#277;" => "e",
            "&#279;" => "e",
            "&#281;" => "e",
            "&#283;" => "e",
            "&#7865;" => "e",
            "&#7867;" => "e",
            "&#7869;" => "e",
            "&#7871;" => "e",
            "&#7873;" => "e",
            "&#7875;" => "e",
            "&#7877;" => "e",
            "&#7879;" => "e",
            "&#284;" => "G",
            "&#286;" => "G",
            "&#288;" => "G",
            "&#290;" => "G",
            "&#285;" => "g",
            "&#287;" => "g",
            "&#289;" => "g",
            "&#291;" => "g",
            "&#292;" => "H",
            "&#294;" => "H",
            "&#293;" => "h",
            "&#295;" => "h",
            "&#296;" => "I",
            "&#298;" => "I",
            "&#300;" => "I",
            "&#302;" => "I",
            "&#304;" => "I",
            "&#463;" => "I",
            "&#7880;" => "I",
            "&#7882;" => "I",
            "&#308;" => "J",
            "&#309;" => "j",
            "&#310;" => "K",
            "&#311;" => "k",
            "&#313;" => "L",
            "&#315;" => "L",
            "&#317;" => "L",
            "&#319;" => "L",
            "&#321;" => "L",
            "&#314;" => "l",
            "&#316;" => "l",
            "&#318;" => "l",
            "&#320;" => "l",
            "&#322;" => "l",
            "&#323;" => "N",
            "&#325;" => "N",
            "&#327;" => "N",
            "ñ" => "n",
            "&#324;" => "n",
            "&#326;" => "n",
            "&#328;" => "n",
            "&#329;" => "n",
            "&#332;" => "O",
            "&#334;" => "O",
            "&#336;" => "O",
            "&#416;" => "O",
            "&#465;" => "O",
            "&#510;" => "O",
            "&#7884;" => "O",
            "&#7886;" => "O",
            "&#7888;" => "O",
            "&#7890;" => "O",
            "&#7892;" => "O",
            "&#7894;" => "O",
            "&#7896;" => "O",
            "&#7898;" => "O",
            "&#7900;" => "O",
            "&#7902;" => "O",
            "&#7904;" => "O",
            "&#7906;" => "O",
            "ò" => "o",
            "ó" => "o",
            "ô" => "o",
            "õ" => "o",
            "ö" => "o",
            "ø" => "o",
            "&#333;" => "o",
            "&#335;" => "o",
            "&#337;" => "o",
            "&#417;" => "o",
            "&#466;" => "o",
            "&#511;" => "o",
            "&#7885;" => "o",
            "&#7887;" => "o",
            "&#7889;" => "o",
            "&#7891;" => "o",
            "&#7893;" => "o",
            "&#7895;" => "o",
            "&#7897;" => "o",
            "&#7899;" => "o",
            "&#7901;" => "o",
            "&#7903;" => "o",
            "&#7905;" => "o",
            "&#7907;" => "o",
            "ð" => "o",
            "&#340;" => "R",
            "&#342;" => "R",
            "&#344;" => "R",
            "&#341;" => "r",
            "&#343;" => "r",
            "&#345;" => "r",
            "&#346;" => "S",
            "&#348;" => "S",
            "&#350;" => "S",
            "&#347;" => "s",
            "&#349;" => "s",
            "&#351;" => "s",
            "&#354;" => "T",
            "&#356;" => "T",
            "&#358;" => "T",
            "&#355;" => "t",
            "&#357;" => "t",
            "&#359;" => "t",
            "&#360;" => "U",
            "&#362;" => "U",
            "&#364;" => "U",
            "&#366;" => "U",
            "&#368;" => "U",
            "&#370;" => "U",
            "&#431;" => "U",
            "&#467;" => "U",
            "&#469;" => "U",
            "&#471;" => "U",
            "&#473;" => "U",
            "&#475;" => "U",
            "&#7908;" => "U",
            "&#7910;" => "U",
            "&#7912;" => "U",
            "&#7914;" => "U",
            "&#7916;" => "U",
            "&#7918;" => "U",
            "&#7920;" => "U",
            "ù" => "u",
            "ú" => "u",
            "û" => "u",
            "ü" => "u",
            "&#361;" => "u",
            "&#363;" => "u",
            "&#365;" => "u",
            "&#367;" => "u",
            "&#369;" => "u",
            "&#371;" => "u",
            "&#432;" => "u",
            "&#468;" => "u",
            "&#470;" => "u",
            "&#472;" => "u",
            "&#474;" => "u",
            "&#476;" => "u",
            "&#7909;" => "u",
            "&#7911;" => "u",
            "&#7913;" => "u",
            "&#7915;" => "u",
            "&#7917;" => "u",
            "&#7919;" => "u",
            "&#7921;" => "u",
            "&#372;" => "W",
            "&#7808;" => "W",
            "&#7810;" => "W",
            "&#7812;" => "W",
            "&#373;" => "w",
            "&#7809;" => "w",
            "&#7811;" => "w",
            "&#7813;" => "w",
            "&#374;" => "Y",
            "&#7922;" => "Y",
            "&#7928;" => "Y",
            "&#7926;" => "Y",
            "&#7924;" => "Y",
            "ý" => "y",
            "ÿ" => "y",
            "&#375;" => "y",
            "&#7929;" => "y",
            "&#7925;" => "y",
            "&#7927;" => "y",
            "&#7923;" => "y",
            "&#377;" => "Z",
            "&#379;" => "Z"
            );
            $str = strtr($str,$ch0);
            return $str;
        }


    
}
