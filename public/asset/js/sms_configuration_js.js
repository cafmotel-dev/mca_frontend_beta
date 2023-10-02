function displayVals() {
        var singleValues = $( "#message" ).val();
        var multipleValues = $( "#multiple_labels" ).val() || [];
        $( "#message" ).val(singleValues+' '+ multipleValues.join( " " ) );
        $( "#multiple_labels" ).val('');
    }

$( "#multiple_labels" ).on('change',function() { 
    displayVals();
});

function displayValsNames() {
    var singleValues = $( "#message" ).val();
    var multipleValues = $( "#multiple_names" ).val() || [];
    var input = singleValues+','+ multipleValues.join( " " );
    var splitted = input.split(',');
    var collector = {};

    for (i = 0; i < splitted.length; i++) {
        key = splitted[i].replace(/^\s*/, "").replace(/\s*$/, "");
        collector[key] = true;
    }

    var out = [];
    for (var key in collector) {
        out.push(key);
    }
    var output = out.join('');
    $( "#message" ).val(output);

    $( "#multiple_names" ).val('');
}

$( "#multiple_names" ).on('change',function() { 
    displayValsNames();
});

$('#multiple_labels').on('select2:select', function (e) {
    var data = e.params.data;
    $("#multiple_labels").val(null).trigger("change");
});

$('#multiple_names').on('select2:select', function (e) {
    $("#multiple_names").val(null).trigger("change");
});

$(".alert").delay(10000).slideUp(300);
$(function () {
    $('.select2').select2()
});

var maxLength = 160;
$('#message').keyup(function() {
    var textlen = maxLength - $(this).val().length;
    $('#rchars').text(textlen);
});

