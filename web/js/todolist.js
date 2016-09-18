function getajax(url,classid) {
    $.ajax({
        url: url,
        type: "POST",
        success: function (data) {
            $("." + classid).html(data);
        }
    });
}

setInterval(function () {
    var url = $(".todolisttable").data("url");
    
    var url2 = $(".historytable").data("url");

    getajax(url, 'todolisttable');
    getajax(url2, 'historytable');
   
}, 60000);