
$(document).ready(function() {
    switch (title) {
        case "Mr":
            document.getElementById("inline-radio1").checked = true;
            break;
        case "Mrs":
            document.getElementById("inline-radio2").checked = true;
            break;
        case "Ms":
            document.getElementById("inline-radio3").checked = true;
            break;
        case "Dr":
            document.getElementById("inline-radio4").checked = true;
            break;
    }
    //Setting stored country
    var myDropdownList = document.getElementById("country");

    for (var iLoop = 0; iLoop< myDropdownList.options.length; iLoop++)
    {
        if (myDropdownList.options[iLoop].value == country)
        {
            // Item is found. Set its selected property, and exit the loop
            myDropdownList.options[iLoop].selected = true;
            break;
        }
    }
    //Setting stored state
    if(country) {
        $.ajax({
            url: '/landlord/new_landlord/state/ajax/'+encodeURI(country),
            type: "GET",
            dataType: "json",
            success:function(data) {
                $('select[name="state"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="state"]').append('<option value="'+ value.name +'">'+ value.name +'</option>');
                    if (value.name == state){
                        var last_index = document.getElementById('state').options.length;
                        document.getElementById('state').options[last_index - 1].selected = true;
                    }
                });
            }
        });
    }else{
        $('select[name="state"]').empty();
    }
    //Setting stored city
    if(state) {
        $.ajax({
            url: '/landlord/new_landlord/city/ajax',
            type: "GET",
            data: {country: encodeURI($('select[name="country"]').val()), state: encodeURI(state)},
            dataType: "json",
            success:function(data) {
                $('select[name="city"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="city"]').append('<option value="'+ value.name +'">'+ value.name +'</option>');
                    if (value.name == city){
                        var last_index = document.getElementById('city').options.length;
                        document.getElementById('city').options[last_index - 1].selected = true;
                    }
                });
            }
        });
    }else{
        $('select[name="city"]').empty();
    }

    //Phone number default setting
    $('input[name="primaryPhoneCode"]').val(ppc);
    $('input[name="alternatePhoneCode"]').val(apc);

    $('input[name="primaryCountryCode"]').val(pcc);
    $('input[name="alternateCountryCode"]').val(acc);

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
// Phone number Input box setting
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
// Phone number Input box setting
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


