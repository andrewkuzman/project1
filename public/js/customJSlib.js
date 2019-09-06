//To check which gender is selected in gender radio button
function checkGender(){
    $(".gender").click(function(){
        $("#numberofChildren").val("0");
        $(".genderssn").remove();
        if($('#female').is(':checked')){
            $(".generatessn").remove();
            $(".deaconLevelDiv").attr("hidden", true);
            $("#deaconLevel").val($("#deaconLevel Option:first").val());
            if (!$("#socialState_single").is(':checked')){
                $(genderssn()).prependTo(".generateHusbandWifeData");
            }
        }
        else{
            $(".generatessn").remove();
            if (!$("#socialState_single").is(':checked')){
                $(genderssn()).prependTo(".generateHusbandWifeData");
            }
            $(".deaconLevelDiv").attr("hidden", false);
        }
    });
}

function genderssn(){
    if($('#female').is(':checked')){
        return '<div class="socialStateDiv genderssn form-group row" >\n' +
            '    <label for="husbandssn" class="col-md-4 col-form-label text-md-right"> الرقم القومي للزوج</label>\n' +
            '\n' +
            '    <div class="col-md-6">\n' +
            '        <input id="husbandssn" type="number" min="0" oninput="validity.valid||(value=\'\');" class="form-control" name="husbandssn" value="{{ old(\'husbandssn\') }}" required autocomplete="husbandssn" autofocus>\n' +
            '\n' +
            '    </div>\n' +
            '</div>\n';
    }
    else{
        return '<div class="socialStateDiv genderssn form-group row" >\n' +
            '    <label for="wifessn" class="col-md-4 col-form-label text-md-right"> الرقم القومي للزوجة</label>\n' +
            '\n' +
            '    <div class="col-md-6">\n' +
            '        <input id="wifessn" type="number" min="0" oninput="validity.valid||(value=\'\');" class="form-control" name="wifessn" value="{{ old(\'wifessn\') }}" required autocomplete="wifessn" autofocus>\n' +
            '\n' +
            '    </div>\n' +
            '</div>\n';
    }
}

//To check which social state is selected
function checkSocialState(){
    $(".socialState").click(function(){
        if(!$('#socialState_single').is(':checked')){
            $(".socialStateDiv").remove();
$(genderssn()  +
    '\n' +
'         <div class="socialStateDiv form-group row" >\n' +
'             <label for="marriageDate" class="col-md-4 col-form-label text-md-right">تاريخ الزواج</label>\n' +
'\n' +
'             <div class="col-md-6">\n' +
'                 <input id="marriageDate" type="date" class="date form-control" value="{{ old(\'marriageDate\') }}" name="marriageDate" required autocomplete="marriageDate" autofocus>\n' +
    '\n' +
'             </div>\n' +
'         </div>\n' +
    '\n' +
'         <div class="socialStateDiv form-group row" >\n' +
'             <label for="numberofChildren" class="col-md-4 col-form-label text-md-right">عدد الابناء</label>\n' +
'\n' +
'             <div class="col-md-6">\n' +
'                 <input id="numberofChildren" type="number" value="0" max="15"  min="0" oninput="validity.valid||(value=\'\');" class="form-control" name="numberofChildren" value="{{ old(\'numberofChildren\') }}" required autocomplete="numberofChildren" autofocus>\n' +
    '\n' +
'             </div>\n' +
'         </div>\n').appendTo(".generateHusbandWifeData");
            preventFuture();
            createChildssnInput();

        }
        else{
            $(".socialStateDiv").remove();
        }
    });
}

//Create children snn text inputs

function createChildssnInput(){
    $("#numberofChildren").change(function(){
    if($('#male').is(':checked')){
        var number = parseInt($("#numberofChildren").val());
        if(number==1){
            childNumber=[""];
        }else{
            var childNumber = ["الاول", "الثاني", "الثالث", "الرابع", "الخامس", "السادس", "السابع", "الثامن", "التاسع", "العاشر", "الحادي عشر", "الثاني عشر", "الثالث عشر", "الرابع عشر", "الخامس عشر"];
        }
        $(".generatessn").remove();
        for (var i = 1; i <= number; i++) {
            $(' <div class="generatessn socialStateDiv form-group row">\n\
                <div class="col-md-6 offset-md-2">\n\
                    <input id="childssn'+i+'" type="number" min="0" oninput="validity.valid||(value='+"''"+');" class="form-control" name="childssn'+i+'" value="{{ old('+"childssn"+i+') }}" required autocomplete="childssn'+i+'" autofocus>\n\
                    \n\
                </div>\n\
                \n\
                <label for="childssn'+i+'" class="col-md-4 col-form-label text-md-left"> الرقم القومي للابن/الابنة '+childNumber[i-1]+'</label>\n\
            </div>\n\
            \n\
        ').appendTo(".generateChildrenssnDiv");
        }
    }
    });
}

//Prevent future dates
function preventFuture(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
     if(dd<10){
            dd='0'+dd
        }
        if(mm<10){
            mm='0'+mm
        }

    today = yyyy+'-'+mm+'-'+dd;
    $(".date").attr("max", today);
}

//Prevent past dates
function preventPast(){
    if ($("#marriageDate").val() != null){
        var birthDate = $("#birthDate").val();
        $("#marriageDate").attr("min", birthDate);
    }
    else{
        $("#marriageDate").attr("disabled", true);
    }
}

//To write only Arabic letters in text input
function arabicOnly(e){
  var unicode=e.charCode? e.charCode : e.keyCode;
  if (unicode!==8 && unicode!==32){ //if the key isn't the backspace or the whitespace key (which we should allow)
      if (unicode < 0x0600 || unicode > 0x06FF) //if not arabic
        return false; //disable key press
  }
}

//To choose search by name
function searchByName(){
    $(".nameSearchOption").click(function(){
        if($('#nameSearchNo').is(':checked')){
            $(".searchNameDiv").attr("hidden", true);
            $("#nameSearch").val("");
        }
        else{
            $(".searchNameDiv").attr("hidden", false);
        }
    });
}

//To choose search by ssn
function searchByssn(){
    $(".ssnSearchOption").click(function(){
        if($('#ssnSearchNo').is(':checked')){
            $(".searchssnDiv").attr("hidden", true);
            $("#ssnSearch").val("");
        }
        else{
            $(".searchssnDiv").attr("hidden", false);
        }
    });
}

//To choose search by mobile number
function searchByMobile(){
    $(".mobileSearchOption").click(function(){
        if($('#mobileSearchNo').is(':checked')){
            $(".searchMobileDiv").attr("hidden", true);
            $("#mobileSearch").val("");
        }
        else{
            $(".searchMobileDiv").attr("hidden", false);
        }
    });
}

//To choose search by email address
function searchByEmail(){
    $(".emailSearchOption").click(function(){
        if($('#emailSearchNo').is(':checked')){
            $(".searchEmailDiv").attr("hidden", true);
            $("#emailSearch").val("");
        }
        else{
            $(".searchEmailDiv").attr("hidden", false);
        }
    });
}

//To choose search by mother's name
function searchByMother(){
    $(".motherSearchOption").click(function(){
        if($('#motherSearchNo').is(':checked')){
            $(".searchMotherDiv").attr("hidden", true);
            $("#motherSearch").val("");
        }
        else{
            $(".searchMotherDiv").attr("hidden", false);
        }
    });
}

//To prevent gender being unchecked
function preventGenderUncheck(){
$("#gender_femaleSearch").on("click", function (e) {
    var checkbox = $("#gender_maleSearch");
    if (!(checkbox.is(":checked"))) {
        // do the confirmation thing here
        e.preventDefault();
        return false;
    }
});

$("#gender_maleSearch").on("click", function (e) {
    var checkbox = $("#gender_femaleSearch");
    if (!(checkbox.is(":checked"))) {
        // do the confirmation thing here
        e.preventDefault();
        return false;
    }
});}

//To choose search by birth date
function searchByBirthDate(){
    $(".birthDateSearchOption").click(function(){
        if($('#birthDateSearchNo').is(':checked')){
            $(".searchBirthDateDiv").attr("hidden", true);
            $("#birthDateSearch").val("");
        }
        else{
            $(".searchBirthDateDiv").attr("hidden", false);
        }
    });
}

//To choose search by educational qualification
function searchByEdcQual(){
    $(".edcQualSearchOption").click(function(){
        if($('#edcQualSearchNo').is(':checked')){
            $(".searchEdcQualDiv").attr("hidden", true);
            $("#edcQualSearch_high").prop("checked", false);
            $("#edcQualSearch_aboveAverage").prop("checked", false);
            $("#edcQualSearch_average").prop("checked", false);
            $("#edcQualSearch_secondary").prop("checked", false);
            $("#edcQualSearch_preparatory").prop("checked", false);
            $("#edcQualSearch_primary").prop("checked", false);
            $("#edcQualSearch_non").prop("checked", false);
        }
        else{
            $(".searchEdcQualDiv").attr("hidden", false);
        }
    });
}

//To choose search by educational qualification
function searchByAddress(){
    $(".addressSearchOption").click(function(){
        if($('#addressSearchNo').is(':checked')){
            $(".searchAddressDiv").attr("hidden", true);
            $("#citySearch").val("");
            $("#governorateSearch").val("");
            $("#streetSearch").val("");
            $("#buildingSearch").val("");
        }
        else{
            $(".searchAddressDiv").attr("hidden", false);
        }
    });
}

//To prevent social state being unchecked
function preventSocialStateUncheck(){
$("#socialStateSearch_single").on("click", function (e) {
    var checkbox1 = $("#socialStateSearch_married");
    var checkbox2 = $("#socialStateSearch_widow");
    if (!(checkbox1.is(":checked") || checkbox2.is(":checked")) ) {
        // do the confirmation thing here
        e.preventDefault();
        return false;
    }
});

$("#socialStateSearch_married").on("click", function (e) {
    var checkbox1 = $("#socialStateSearch_single");
    var checkbox2 = $("#socialStateSearch_widow");
    if (!(checkbox1.is(":checked") || checkbox2.is(":checked")) ) {
        // do the confirmation thing here
        e.preventDefault();
        return false;
    }
});

$("#socialStateSearch_widow").on("click", function (e) {
    var checkbox1 = $("#socialStateSearch_single");
    var checkbox2 = $("#socialStateSearch_married");
    if (!(checkbox1.is(":checked") || checkbox2.is(":checked")) ) {
        // do the confirmation thing here
        e.preventDefault();
        return false;
    }
});}

//To choose search by wife or husband name
function searchByHusband_wifeName(){
    $(".husband_wifeNameSearchOption").click(function(){
        if($('#husband_wifeNameSearchNo').is(':checked')){
            $(".searchHusband_wifeDiv").attr("hidden", true);
            $("#husband_wifeName").val("");
        }
        else{
            $(".searchHusband_wifeDiv").attr("hidden", false);
        }
    });
}

//To choose search by marriage date
function searchByMarriageDate(){
    $(".marriageDateSearchOption").click(function(){
        if($('#marriageDateSearchNo').is(':checked')){
            $(".searchMarriageDateDiv").attr("hidden", true);
            $("#marriageDateSearch").val("");
        }
        else{
            $(".searchMarriageDateDiv").attr("hidden", false);
        }
    });
}

//To choose search by number of children
function searchByNumberofChildren(){
    $(".numberofChildrenSearchOption").click(function(){
        if($('#numberofChildrenSearchNo').is(':checked')){
            $(".searchNumberofChildrenDiv").attr("hidden", true);
            $("#numberofChildrenSearch").val("");
        }
        else{
            $(".searchNumberofChildrenDiv").attr("hidden", false);
        }
    });
}

//To choose search by serving type
function searchByServingType(){
    $(".servingTypeSearchOption").click(function(){
        if($('#servingTypeSearchNo').is(':checked')){
            $(".searchServingTypeDiv").attr("hidden", true);
            $("#servingTypeSearch_preparatory").prop("checked", false);
            $("#servingTypeSearch_secondary").prop("checked", false);
            $("#servingTypeSearch_youth").prop("checked", false);
            $("#servingTypeSearch_primary").prop("checked", false);
            $("#servingTypeSearch_poor").prop("checked", false);
            $("#servingTypeSearch_old").prop("checked", false);
            $("#servingTypeSearch_orphans").prop("checked", false);
        }
        else{
            $(".searchServingTypeDiv").attr("hidden", false);
        }
    });
}

//To choose search by deaconate level
function searchByDeaconLevel(){
    $(".deaconLevelSearchOption").click(function(){
        if($('#deaconLevelSearchNo').is(':checked')){
            $(".searchDeaconLevelDiv").attr("hidden", true);
            $("#deaconLevelSearch_epsaltos").prop("checked", false);
            $("#deaconLevelSearch_anaghnostos").prop("checked", false);
            $("#deaconLevelSearch_epideacon").prop("checked", false);
            $("#deaconLevelSearch_deacon").prop("checked", false);
            $("#deaconLevelSearch_archdeacon").prop("checked", false);
        }
        else{
            $(".searchDeaconLevelDiv").attr("hidden", false);
        }
    });
}

//To choose search by church name
function searchByChurchName(){
    $(".churchNameSearchOption").click(function(){
        if($('#churchNameSearchNo').is(':checked')){
            $(".searchChurchNameDiv").attr("hidden", true);
            $("#churchNameSearch").val("");
        }
        else{
            $(".searchChurchNameDiv").attr("hidden", false);
        }
    });
}

//To choose search by confession father name
function searchByConfessFather(){
    $(".confessFatherSearchOption").click(function(){
        if($('#confessFatherSearchNo').is(':checked')){
            $(".searchConfessFatherDiv").attr("hidden", true);
            $("#confessFatherSearch").val("");
        }
        else{
            $(".searchConfessFatherDiv").attr("hidden", false);
        }
    });
}

//To check if male is checked in gender checkbox
function checkGenderSearch(){
    $(".genderSearch").click(function(){
        if($('#maleSearch').prop("checked")== false){
            $(".deaconLevelOptionDiv").attr("hidden", true);
            $("#deaconLevelSearch_epsaltos").prop("checked", false);
            $("#deaconLevelSearch_anaghnostos").prop("checked", false);
            $("#deaconLevelSearch_epideacon").prop("checked", false);
            $("#deaconLevelSearch_deacon").prop("checked", false);
            $("#deaconLevelSearch_archdeacon").prop("checked", false);
        }
        else{
            $(".deaconLevelOptionDiv").attr("hidden", false);
        }
    });
}

//To check if married or widow is checked in gender checkbox
function checkSocialStateSearch(){
    $(".socialStateSearch").click(function(){
        if($('#socialStateSearch_married').prop("checked")== false && $('#socialStateSearch_widow').prop("checked")== false){
            $(".socialStateCheck").attr("hidden", true);
            $(".searchHusband_wifeDiv").attr("hidden", true);
            $(".searchNumberofChildrenDiv").attr("hidden", true);
            $(".searchMarriageDateDiv").attr("hidden", true);
            $("#husband_wifeNameSearchYes").prop("checked", false);
            $("#husband_wifeNameSearchNo").prop("checked", true);
            $("#numberofChildrenSearchYes").prop("checked", false);
            $("#numberofChildrenSearchNo").prop("checked", true);
            $("#marriageDateSearchYes").prop("checked", false);
            $("#marriageDateSearchNo").prop("checked", true);
            $(".socialStateCheck").attr("hidden", true);
            $("#husband_wifeName").val("");
            $("#marriageDateSearch").val("");
            $("#numberofChildrenSearch").val("");
        }
        else{
            $(".socialStateCheck").attr("hidden", false);
        }
    });
}

//preview profile pic before submiting
function changeImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#previewPersonalPic')
                .attr('src', e.target.result).prop('hidden',false);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
