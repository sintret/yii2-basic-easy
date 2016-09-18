/* 
 * author : sintret@gmail.com
 * This function to dynamic parsing type new or update 
 * only in parsing form detect
 */

$("#logupload-type").on("change", function () {
    var id = $(this).val();
    var name = $(this).data("name");
    var add = $("#sample-parsing").data("add");
    var edit = $("#sample-parsing").data("edit");

    if (id == 1) {
        $("#sample-parsing").html(name + "_add_data_sample.xls");
        $("#sample-parsing").attr("href", add);
    } else {
        $("#sample-parsing").html(name + "_edit_data_sample.xls");
        $("#sample-parsing").attr("href", edit);
    }
});

