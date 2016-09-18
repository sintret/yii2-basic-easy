/*
 * This is for location form 
 */

$("#location-parent1").on("change", function () {
    var url = $("#url").val();

    $.ajax({
        url: url,
        type: "POST",
        data: {num: 1, current: $(this).val(), id: $("#modelid").val()},
        success: function (data) {
            if (data == "") {
                $(".parent2").hide();
                $(".parent2").html("");
            } else {
                $(".parent2").show();
                $(".parent2").html(data);
            }
        }
    });
});
$(document).on("change", "#location-parent2", function () {
    var url = $("#url").val();

    $.ajax({
        url: url,
        type: "POST",
        data: {num: 2, current: $(this).val(), id: $("#modelid").val()},
        success: function (data) {
            if (data == "") {
                $(".parent3").hide();
                $(".parent3").html("");
            } else {
                $(".parent3").show();
                $(".parent3").html(data);
            }
        }
    });
});

$(document).on("change", "#location-parent3", function () {
    var url = $("#url").val();

    $.ajax({
        url: url,
        type: "POST",
        data: {num: 3, current: $(this).val(), id: $("#modelid").val()},
        success: function (data) {
            if (data == "") {
                $(".parent4").hide();
                $(".parent4").html("");
            } else {
                $(".parent4").show();
                $(".parent4").html(data);
            }
        }
    });
});

$(document).on("change", "#location-parent4", function () {
    var url = $("#url").val();

    $.ajax({
        url: url,
        type: "POST",
        data: {num: 4, current: $(this).val(), id: $("#modelid").val()},
        success: function (data) {
            if (data == "") {
                $(".parent5").hide();
                $(".parent5").html("");
            } else {
                $(".parent5").show();
                $(".parent5").html(data);
            }
        }
    });
});


$(document).on("change", "#location-parent5", function () {
    var url = $("#url").val();
    $.ajax({
        url: url,
        type: "POST",
        data: {num: 5, current: $(this).val(), id: $("#modelid").val()},
        success: function (data) {
            if (data == "") {
                $(".parent6").hide();
                $(".parent6").html("");
            } else {
                $(".parent6").show();
                $(".parent6").html(data);
            }
        }
    });
});