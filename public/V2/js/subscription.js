$(function() {
    $('#myForm').on('submit', function(e) {
        e.preventDefault();
        $test = true;

        if($('.radiobox').is(":checked")){

        } else {
            $test = false;
        }

        if($('#tel').val()==''){
            $('#tel').removeClass("valid").addClass("invalid");
            $test = false;
        } else {
            $('#tel').removeClass("invalid").addClass("valid");
        }

        if(!$.isNumeric($('#contract').val()) || $('#contract').val().length!=9 ) {
            $('#contract').removeClass("valid").addClass("invalid");
            $test = false;
        } else {
            $('#contract').removeClass("invalid").addClass("valid");
        }

        if($('#nom').val()==''){
            $('#nom').removeClass("valid").addClass("invalid");
            $test = false;
        } else {
            $('#nom').removeClass("invalid").addClass("valid");
        }

        if(!$('#language').val()){

            $('#language').removeClass("select-valid").addClass("select-invalid");
            $test = false;
        } else {

            $('#language').removeClass("select-invalid").addClass("select-valid");
        }

        if($('#choix-mail').is(":checked")){

            if(!$('#email').val()){
                $('#email').removeClass("select-valid").addClass("select-invalid");
                $test = false;
            } else
                $('#email').removeClass("select-invalid").addClass("select-valid");
        } else {
            $('#email').removeClass("select-invalid").addClass("select-valid");
        }

        if($('#CheckCondition').is(":checked")){
            $('.link-condition').css('color','#007bff')
        } else {
            $test = false;
            $('.link-condition').css('color','red')
        }

        if($test == true)
        {
            document.getElementById('myForm').submit();
        }

    });

    $('#email').on('input', function() {
        var input=$(this);
        var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var is_email=re.test(input.val());
        if(is_email){
            input.removeClass("invalid").addClass("valid");
        } else {
            input.removeClass("valid").addClass("invalid");
        }
    });

    $(".radiobox").change(function() {
        if(this.checked) {
            if($(this).val()=='MAIL')
                if(langChoice() == 'fr')
                    $('#email').attr("placeholder", "Votre Email *");
                else
                    $('#email').attr("placeholder", "Your Email *");
            else {
                if(langChoice() == 'fr')
                    $('#email').attr("placeholder", "Votre Email (optionnel)");
                else
                    $('#email').attr("placeholder", "Your Email (optional)");
                $('#email').removeClass("select-invalid").addClass("select-valid");
            }

        } else {
            if($(this).val()=='MAIL') {
                if(langChoice() == 'fr')
                    $('#email').attr("placeholder", "Votre Email (optionnel)");
                else
                    $('#email').attr("placeholder", "Your Email (optional)");
                $('#email').removeClass("select-invalid").addClass("select-valid");
            }

        }
    });

//        $("#tel").keyup(function () {
//
//            var val_old = $(this).val();
//            var input=$(this);
//            var newString = new libphonenumber.AsYouType('CM').input(val_old);
//            $(this).focus().val('').val(newString);
//
//            if(val_old.length>13){
//                $(this).val(val_old.slice(0,13));
//            }
//
//            if(val_old.length==13)
//            {input.removeClass("invalid").addClass("valid");}
//            else{input.removeClass("valid").addClass("invalid");}
//        });

    $("#tel").intlTelInput({
        initialCountry: "auto",
        geoIpLookup: function(callback) {
            $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                callback(countryCode);
            });
        },
        nationalMode: false,
        utilsScript: getBaseUrl() + "/js/intl-tel-input-12.1.0/build/js/utils.js" // just for formatting/placeholders etc
    });

});

function getBaseUrl() {
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1] + "/" + l.pathname.split('/')[2];
    return base_url;
}

function langChoice(){
    return $('#lang').data('id');
}
