
$(document).ready(function() {

    //Phone number default setting
    $('input[name="primaryPhoneCode"]').val("254");
    $('input[name="alternatePhoneCode"]').val("254");
    $('input[name="primaryCountryCode"]').val("ke");
    $('input[name="alternateCountryCode"]').val("ke");

    if (iti)
        iti.setCountry($('input[name="primaryCountryCode"]').val());
    if (iti_alternate)
        iti_alternate.setCountry($('input[name="alternateCountryCode"]').val());

    $('select[name="country"]').on('change', function() {
        var countryName = $(this).val();

        if(countryName) {
            $.ajax({
                url: '/landlord/new_landlord/state/ajax/'+encodeURI(countryName),
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[name="state"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="state"]').append('<option value="'+ value.name +'">'+ value.name +'</option>');
                    });
                }
            });
        }else{
            $('select[name="state"]').empty();
        }
    });
    $('select[name="state"]').on('change', function() {
        var stateName = $(this).val();
        if(stateName) {
            $.ajax({
                url: '/landlord/new_landlord/city/ajax',
                type: "GET",
                data: {country: encodeURI($('select[name="country"]').val()), state: encodeURI(stateName)},
                dataType: "json",
                success:function(data) {
                    $('select[name="city"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="city"]').append('<option value="'+ value.name +'">'+ value.name +'</option>');
                    });
                }
            });
        }else{
            $('select[name="city"]').empty();
        }
    });
});
//Phone number Inputbox setting
var input = document.querySelector("#primaryPhoneNumber");
var iti, iti_alternate;
if (input){
    iti = window.intlTelInput(input, {
        // allowDropdown: false,
        // autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: false,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
        // initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
        // nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        preferredCountries: ['ke'],
        separateDialCode: true,
        utilsScript: "/intl-tel-input-master/build/js/utils.js",
    });

    input.addEventListener("countrychange", function(){
        var getCode = iti.getSelectedCountryData().dialCode;
        var countryCode = iti.getSelectedCountryData().iso2;
        $('input[name="primaryPhoneCode"]').val(getCode);
        $('input[name="primaryCountryCode"]').val(countryCode);

    });
}
//Phone number Inputbox setting
var inputAlternate = document.querySelector("#alternatePhoneNumber");
if (inputAlternate){
    iti_alternate = window.intlTelInput(inputAlternate, {
        // allowDropdown: false,
        // autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: false,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
        // initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
        // nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        // customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
        //     return selectedCountryPlaceholder;
        // },
        separateDialCode: true,
        preferredCountries: ['ke'],
        utilsScript: "/intl-tel-input-master/build/js/utils.js",
    });

    inputAlternate.addEventListener("countrychange", function(){
        var getCode = iti_alternate.getSelectedCountryData().dialCode;
        var countryCode = iti_alternate.getSelectedCountryData().iso2;
        $('input[name="alternatePhoneCode"]').val(getCode);
        $('input[name="alternateCountryCode"]').val(countryCode);
    });
}


