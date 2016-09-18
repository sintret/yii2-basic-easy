/* 
 * author : sintret@gmail.com
 * This function to dynamic parsing type new or update 
 * only in parsing form detect
 */

$('#modalParsing').modal('show');
var url = $('#modalParsing').data("url");
var urlAjax = $('#modalParsing').data("ajax");

var jqxhr = $.getJSON(url, function () {
    console.log("success");
})
        .done(function (jsonData) {
            console.log("second success");

            //alert(JSON.stringify(jsonData));

            var type = jsonData.type;
            var typeLabel = "Add";

            if (type == 2) {
                typeLabel = "Edt";
            }

            $(".modal-type").html("Please double check your work with type : '" + typeLabel + " '");
            
            var fields = jsonData.fields;
            var keys = jsonData.keys;
            var datas = jsonData.datas;
            var table = '';
            table += '<table class="table table-striped">';
            table += '<tr>';
            for (i = 0; i < fields.length; i++) {
                table += '<th>' + fields[i] + '</th>';
            }

            table += '<th> Info </th>';
            table += '</tr>';

            for (i = 0; i < datas.length; i++) {
                table += '<tr>';
                for (y = 0; y < keys.length; y++) {
                    var key = keys[y];
                    table += '<td>' + datas[i][key] + '</td>';
                }

                table += '<td>' + parsingProcess(type, urlAjax, datas[i]) + '</td>';

                table += '</tr>';
            }

            table += '</table>';
            //console.log(table);
            $(".modal-body").html(table);
        })
        .fail(function () {
            console.log("error");
            alert("error!");
        })
        .always(function () {
            console.log("complete");
        });

// Set another completion function for the request above
jqxhr.complete(function () {
    console.log("second complete");
});


function parsingProcess(type, url, datas) {
    var result = "";
    $.ajax({
        url: url,
        async: false,
        type: "POST",
        data: datas,
        success: function (data) {
            result = data;
        }
    });
    return result;
}



