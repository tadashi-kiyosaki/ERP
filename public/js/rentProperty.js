$(document).ready(function() {
    $( "#datepickerStart" ).datepicker({
        changeMonth: true,
        changeYear: true
    });
    $( "#datepickerEnd" ).datepicker({
        changeMonth: true,
        changeYear: true
    });

    $('select[name="landlord"]').on('change', function() {
        var landlordId = $(this).val();
        propertyList = [];

        if(landlordId) {
            $.ajax({
                url: '/properties/rent_property/ajax/'+encodeURI(landlordId),
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[name="propertyType"]').empty();
                    $.each(data, function(key, value) {
                        propertyList[value.id] = value;
                        $('select[name="propertyType"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        if ($('input[name="propertySize"]').val() == '')
                            $('input[name="propertySize"]').val(value.size);
                        if ($('input[name="propertyUnit"]').val() == '')
                            $('input[name="propertyUnit"]').val(value.unit_rent);
                    });
                }
            });
        }else{
            $('select[name="propertyType"]').empty();
        }
    });

    $('select[name="propertyType"]').on('change', function() {
        var pid = $(this).val();
        if (pid) {
            $('input[name="propertySize"]').val(propertyList[pid].size);
            $('input[name="propertyUnit"]').val(propertyList[pid].unit_rent);
        }
    });

});

var propertyList = [];