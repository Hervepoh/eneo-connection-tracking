var form = $("#connection_form");
var keepOptions = validationOptions;
var next = next;

$.validator.addMethod("contractFormat", function (value, element) {
    return this.optional(element) || /^\d{9}$/.test(value) || /^[PE]\d{14}$/.test(value);
}, "Le contrat doit être composé de 9 chiffres ou vous pouvez entrer une numéro de devis qui commencer par P OU E suivi de 14 chiffres.");


$.validator.addMethod("contractExist", function (value, element) {
	const url = "http://localhost:8080/index.php/search/"+value;
    axios.get(url).then(function (response) {
      
	  if (response.data.status != 'success') {
		 return this.optional(element) || false
	  }
    });
    return this.optional(element) || true
}, "Le contrat ou le numéro de devis n'existe pas");

form.validate(validationOptions);



$("input[type=radio][name=person_type]").change(function () {
  var personType = this.value;

  validationOptions = form.validate().settings;
  /*form.validate().resetForm();*/

  if (personType === "1") {
    delete validationOptions.rules.raisonsociale;
    delete validationOptions.messages.raisonsociale;

    validationOptions.rules.lastname = { required: true };
    validationOptions.messages.lastname = keepOptions.messages.lastname;

    $(".pMorale").hide();
    $(".pPhysique").show();
  } else if (personType === "2") {
    delete validationOptions.rules.lastname;
    delete validationOptions.messages.lastname;

    validationOptions.rules.raisonsociale = { required: true };
    validationOptions.messages.raisonsociale =
      keepOptions.messages.raisonsociale;

    $(".pPhysique").hide();
    $(".pMorale").show();
  }
});

/* Smart Wizard section begining  */

$("#smartwizard").smartWizard({
  selected: 0,
  showPreviousButton: false,
  theme: "arrows" /* default, arrows, dots, progress
	darkMode: true,*/,
  transition: {
    animation:
      "slide-horizontal" /* Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing*/,
  },
  /*	toolbarSettings: {
			toolbarPosition: 'bottom',//bottom both
			showPreviousButton: false, // show/hide a Previous button
				   
		/*	toolbarExtraButtons: [btnFinish, btnCancel]*/
  /*	},*/
  lang: {
    /* Language variables for button*/

    next: next,
    previous: previous,
  },
  anchorSettings: {
    anchorClickable: true /* Enable/Disable anchor navigation*/,
    enableAllAnchors: false /* Activates all anchors clickable all times*/,
    markDoneStep: true /* Add done state on navigation*/,
    markAllPreviousStepsAsDone: true /* When a step selected by url hash, all previous steps are marked done*/,
    removeDoneStepOnNavigateBack: false /* While navigate back done step after active step will be cleared*/,
    enableAnchorOnDoneStep: true /* Enable/Disable the done steps navigation*/,
  },
  disabledSteps: [] /* Array Steps disabled*/,
  errorSteps: [] /* Highlight step with errors*/,
  hiddenSteps: [] /* Hidden steps*/,
});

$("#smartwizard").on(
  "showStep",
  function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
    if (stepPosition === "first") {
      $("#smartwizard").smartWizard({
        toolbarSettings: {
          toolbarPosition: "bottom", // none, top, bottom, both
          toolbarButtonPosition: "right", // left, right, center
          showNextButton: true, // show/hide a Next button
          showPreviousButton: false, // show/hide a Previous button
          toolbarExtraButtons: [], // Extra buttons to show on toolbar, array of jQuery input/buttons elements
        },
      });
      $("#prev-btn").hide();
      $("#prev-btn").addClass("disabled");
    } else if (stepPosition === "last") {
      $("#next-btn").addClass("disabled");
      $("#next-btn").hide();
    } else {
      $(".prev").show();
      $("#smartwizard").smartWizard({
        toolbarSettings: {
          toolbarPosition: "bottom", // none, top, bottom, both
          toolbarButtonPosition: "right", // left, right, center
          showNextButton: true, // show/hide a Next button
          showPreviousButton: true, // show/hide a Previous button
          toolbarExtraButtons: [], // Extra buttons to show on toolbar, array of jQuery input/buttons elements
        },
      });
      $(".sw-btn-previous").show();
      $("#prev-btn").show();
      $("#next-btn").removeClass("disabled");
    }

    switch (stepNumber) {
      case 0:
        /*personType(); 
				documentType();*/
        $("#person_type").trigger("change");
        $("#identity_type_id").trigger("change");
        $("#smartwizard").smartWizard({
          toolbarSettings: {
            toolbarPosition: "bottom", // none, top, bottom, both
            toolbarButtonPosition: "right", // left, right, center
            showNextButton: true, // show/hide a Next button
            showPreviousButton: false, // show/hide a Previous button
            toolbarExtraButtons: [], // Extra buttons to show on toolbar, array of jQuery input/buttons elements
          },
        });

        //	$("#prev-btn").hide();
        break;
      case 1:
        validationOptions = form.validate().settings;

        $("#typeBranch").trigger("change");
        $("#constType").trigger("change");
        break;
      case 2:
        /* code block*/

        break;
    }
  }
);

$("#smartwizard").on(
  "leaveStep",
  function (e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
    var validation = true;

    if (stepDirection === "forward") {
      form.removeData("validator");
      form.validate(validationOptions);
      $(".tab-content").height("auto");
      validation = form.valid();
    }
    $(".tab-content").height("auto");
    //verifier la direction ici
    return validation;
  }
);

$("#constType").change(function () {
  var construction_type = this.value;

  if (construction_type == "5") {
    $("#floor").show();
  } else {
    $("#floor").hide();
  }
});
$("#qty-0").change(function () {
  var qty = this.value;
  if (qty < 0 || qty > 50) {
    validationOptions = form.validate().settings;
  }
});

$("#contract").change(async function () {
  const contract = this.value;
  let agency = "";
  const url = "http://localhost:8080/index.php/search/"+contract;

  function handleRequest(url) {
    axios.get(url).then(function (response) {
      agency = response.data.data.branch;
	  if (response.data.status != 'success') {
			 $("#agency").val(agency);
	  }
      $("#agency").val(agency);
      $("#agency").show();
      $("#agency").prop("disable", true);
      console.log(response.data.data.branch);
    });
  }
  handleRequest(url);
});

$("[type=file]").on("change", function () {
  /* Name of file and placeholder*/
  var file = this.files[0].name;
  var dflt = $(this).attr("placeholder");
  if ($(this).val() != "") {
    $(this).next().text(file);
  } else {
    $(this).next().text(dflt);
  }
});

$.validator.addMethod("filesize", function (value, element, param) {
  /* 
		param = size (in bytes) 
	    element = element to validate (<input>)
	    value = value of the element (file name)
	*/
  return this.optional(element) || element.files[0].size <= param;
});

$("input[type=radio][name=typeBranch]").change(function () {
  var serviceType = this.value;

  switch (serviceType) {
    case "1" /*New connection*/:
      validationOptions = form.validate().settings;

      $(".subMeter").hide();
      $(".conversion").hide();
      $(".newConnection").show();

      break;
    case "2" /* Submeter	*/:
      validationOptions = form.validate().settings;
      //validationOptions.rules.meter_quantity = {required: true};
      //validationOptions.messages.meter_quantity = "Meter quantity is required";

      delete validationOptions.rules.networkDis;
      delete validationOptions.messages.networkDis;

      delete validationOptions.rules.cableExist;
      delete validationOptions.messages.cableExist;

      $(".newConnection").hide();
      $(".conversion").hide();
      $(".subMeter").show();

      break;
    case "3": // Conversion Postpaid-->Prepaid
      delete validationOptions.rules.contract;
      delete validationOptions.messages.contract;

      delete validationOptions.rules.power;
      delete validationOptions.messages.power;

      delete validationOptions.rules.appliances;
      delete validationOptions.messages.appliances;

      delete validationOptions.rules.constType;
      delete validationOptions.messages.constType;

      delete validationOptions.rules.networkDis;
      delete validationOptions.messages.networkDis;

      delete validationOptions.rules.cableExist;
      delete validationOptions.messages.cableExist;

      $(".newConnection").hide();
      $(".subMeter").hide();
      $(".conversion").show();

      break;
    case "4" /* NewConnection + SubMeter	*/:
      validationOptions = form.validate().settings;

      $(".newConnection").show();
      $(".conversion").hide();
      $(".subMeter").show();

      break;
    default:
    /* code block*/
  }
});

$("#identity_type_id").change(function () {
  var doc_type = this.value;
  validationOptions = form.validate().settings;
  /*form.validate().resetForm();*/
  switch (doc_type) {
    case "":
      $("#nidnum").val(null);
      $("#oidnum").val(null);
      $("#ridnum").val(null);
      $("#pidnum").val(null);
      $("#oidnum").hide();
      $("#ridnum").hide();
      $("#pidnum").hide();
      $("#nidnum").hide();
      break;
    case "1":
      validationOptions.rules.nidnum = { required: true };
      validationOptions.messages.nidnum = "New ID Card is required";
      $("#oidnum").val(null);
      $("#ridnum").val(null);
      $("#pidnum").val(null);
      $("#oidnum").hide();
      $("#ridnum").hide();
      $("#pidnum").hide();
      $("#nidnum").show();
      break;
    case "2":
      validationOptions.rules.oidnum = { required: true };
      validationOptions.messages.oidnum = "Old ID is required";
      $("#nidnum").val(null);
      $("#ridnum").val(null);
      $("#pidnum").val(null);
      $("#ridnum").hide();
      $("#pidnum").hide();
      $("#nidnum").hide();
      $("#oidnum").show();

      break;
    case "3":
      validationOptions.rules.ridnum = { required: true };
      validationOptions.messages.ridnum = "Receip ID is required";
      $("#nidnum").val(null);
      $("#oidnum").val(null);
      $("#pidnum").val(null);
      $("#oidnum").hide();
      $("#pidnum").hide();
      $("#nidnum").hide();
      $("#ridnum").show();
      break;
    case "4":
      validationOptions.rules.pidnum = { required: true };
      validationOptions.messages.pidnum = "Passpport ID is required";
      $("#nidnum").val(null);
      $("#oidnum").val(null);
      $("#ridnum").val(null);
      $("#oidnum").hide();
      $("#ridnum").hide();
      $("#nidnum").hide();
      $("#pidnum").show();
      break;
  }
});

$("#phone").intlTelInput({
  initialCountry: "cm",
  geoIpLookup: function (callback) {
    $.get("https://ipinfo.io", function () {}, "jsonp").always(function (resp) {
      var countryCode = resp && resp.country ? resp.country : "";
      countryCode = countryCode.substring(2);
      console.log(countryCode);
      callback(countryCode);
    });
  },
  nationalMode: true,
  utilsScript:
    getBaseUrl() +
    "/V2/js/intl-tel-input-12.1.0/build/js/utils.js" /* just for formatting/placeholders etc*/,
});

$("#phone_2").intlTelInput({
  initialCountry: "cm",
  geoIpLookup: function (callback) {
    $.get("https://ipinfo.io", function () {}, "jsonp").always(function (resp) {
      var countryCode = resp && resp.country ? resp.country : "";
      countryCode = countryCode.substring(2);
      callback(countryCode.substring(2));
    });
  },
  nationalMode: true,
  utilsScript: getBaseUrl() + "/V2/js/intl-tel-input-12.1.0/build/js/utils.js", // just for formatting/placeholders etc
});
//
//});

$(document).ready(function () {
  $("#smartwizard").smartWizard("reset");

  $("#oidnum").hide();
  $("#ridnum").hide();
  $("#pidnum").hide();
  $("#nidnum").hide();
  $(".subMeter").hide();
  $(".conversion").hide();
  $(".newConnection").show();

  var qLines = 0;
  $("body").on("click", ".add_new_frm_field_btn", function () {
    event.preventDefault();
    qLines = qLines + 1;
    console.log(qLines);
    $("#submeter_groups").val(qLines);
    var index = $(".form_field_outer").find(".form_field_outer_row").length + 1;
    $(".form_field_outer").append(
      `
		
		<div class="row form_field_outer_row" style="border-top: dotted 1px;">			
		<div class="form-group col-sm-12 form-inline " style="text-align:left;">
		<span id="lbtypeComp" style="margin-top:5px;">Meter Type: </span>
		<div style="margin-left:5px;">
		<div id="radio-group-comp" style="display:inline-block;">
		<input type="radio" class="radiobox" name="typeCompteur` +
        qLines +
        `" id="typeComp1" value="1" checked>
		<span id="lbComp1" style="margin-top: 10px;color: #1B75BB; ">Postpaid</span><!-- <br> -->
		<input type="radio" class="radiobox" style="margin-left: 5px;" name="typeCompteur` +
        qLines +
        `" id="typeComp2" value="2">
		<span id="lbComp2" style="margin-top: 10px;color: #1B75BB; ">Prepaid</span>
		</div>
		</div>
		</div>
		
		
		
		<div class="form-group col-sm-12 form-inline ">
		<select name="power` +
        qLines +
        `" id="power" class="form-control">
		<option value="" disabled="" selected="">Requested Power *</option>
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
		<span id="lbmeterType" style="margin-left: 1px;"> Connection Type: </span>
		<div style="text-align:center; margin-left:3px;">
		<div id="radio-group-met" style="display:inline-block;">
		<input type="radio" class="radiobox" name="meterType` +
        qLines +
        `" id="meterType1" value="01211" checked>
		<span id="lbMet2" style="margin-top: 10px;color: #1B75BB; "> 2 Wires</span><br>
		<input type="radio" class="radiobox" name="meterType` +
        qLines +
        `" id="meterType2" value="01212">
		<span id="lbMet2" style="margin-top: 10px;color: #1B75BB; "> 4 Wires</span>
		</div>
		</div>
		</div>
		
		<div class="form-group col-sm-12 appliances ">
		<input type="text" style="height: 100px;" data-toggle="tooltip" data-placement="top" title="Please Describe Your Main Electrical Appliances, for Power Budget Estimation. E.G: 1 Frige, 2 TV, 1 AC Split" class="form-control" id="appliances" name="appliances` +
        qLines +
        `" value="" placeholder="Main Electrical Appliances *">
		</div>	
		<div class="form-group col-md-6 form-inline subMeter" style="text-align:left;">
		<span id="lbtypeComp" style="margin-top:5px;">Quantity: </span>
		<input type="number" class="form-control" name="qty-` +
        qLines +
        `" access="false" id="qty-0" size="3">
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
        `
    );

    $(".form_field_outer")
      .find(".remove_node_btn_frm_field:not(:first)")
      .prop("disabled", false);
    $(".form_field_outer")
      .find(".remove_node_btn_frm_field")
      .first()
      .prop("disabled", true);
    $(".tab-content").height("auto");
  });
});
/*
$("#form_submit").on("click", function () {
	event.preventDefault();

	$(".toolbar-bottom").hide();
	/*$("#next-btn").hide();
 * 	
 * 		$(this).prop("disabled", true);***

	$(this).html('<i class="fa fa-circle-o-notch fa-spin"></i> ' + Messages.processing);

	$("#message_recapitulatif").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + Messages.sending);

	var case_id = null;
	var form = $('#connection_form')[0];
	var formData = new FormData(form);
	/*console.log(formData);***
	$.ajax({
		url: "Home/saveRequest",
		type: "POST",
		cache: false,
		data: formData,
		processData: false,
		contentType: false,
		dataType: "JSON",
		success: function (data) {
			/*case_id = data.id;***

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
		error: function (jqXHR, textStatus, errorThrown) {
			var el = $('<div style="color:red;"></div>').html('<strong>' + Messages.errorcreate + errorThrown + '!</strong');
			$("#message_recapitulatif").append(el);
		}
	})

		.done(function (resp) {
			/*handle final response here***
			var el = $('<div id="error"></div>').html(Messages.homepage);
			$("#message_recapitulatif").append(el);
			$("#form_submit").prop("disabled", true);
			$("#form_submit").hide();
			/*$("#form_submit").html(
			'<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> '+Messages.complete
			);***
			$(".tab-content").height("auto");
		})

});
*/
getBaseUrl();
function getBaseUrl() {
  var l = window.location;
  // console.log("window.location orign",l);
  // var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1] + "/" + l.pathname.split('/')[2];
  var base_url = l.origin;
  //console.log("base_url orign",base_url);
  return base_url;
}

///======Clone method

$(document).ready(function () {
  $("body").on("click", ".add_node_btn_frm_field", function (e) {
    var index =
      $(e.target).closest(".form_field_outer").find(".form_field_outer_row")
        .length + 1;
    var cloned_el = $(e.target).closest(".form_field_outer_row").clone(true);

    $(e.target)
      .closest(".form_field_outer")
      .last()
      .append(cloned_el)
      .find(".remove_node_btn_frm_field:not(:first)")
      .prop("disabled", false);

    $(e.target)
      .closest(".form_field_outer")
      .find(".remove_node_btn_frm_field")
      .first()
      .prop("disabled", true);

    /*change id*/
    $(e.target)
      .closest(".form_field_outer")
      .find(".form_field_outer_row")
      .last()
      .find("input[type='text']")
      .attr("id", "mobileb_no_" + index);

    $(e.target)
      .closest(".form_field_outer")
      .find(".form_field_outer_row")
      .last()
      .find("select")
      .attr("id", "no_type_" + index);

    console.log(cloned_el);
    /*count++;*/
  });

  //===== delete the form fieed row
  $("body").on("click", ".remove_node_btn_frm_field", function () {
    $(this).closest(".form_field_outer_row").remove();
  });
});
