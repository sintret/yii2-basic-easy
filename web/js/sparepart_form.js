$("input.number").number(true, 0);
$("#sparepart-klasid").on("change", function () {
    var url = $(this).data("url");
    var id = $(this).val();
    selectKlas(url, id, 0);
});

function selectKlas(url, id, thisValue) {
    $.ajax({
        url: url,
        type: "POST",
        data: {id: id, current: thisValue},
        success: function (data) {
            $("#sparepart-subclassid").html(data);
        }
    });
}

$(document).ready(function () {
    var url = $("#sparepart-klasid").data("url");
    var id = $("#sparepart-klasid").val();
    var thisValue = $("#sparepart-subclassid").val();

    if (id) {
        selectKlas(url, id, thisValue);
    }
});