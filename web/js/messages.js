function reloadchat(message, clearChat) {
    var url = $("#btn-send-comment").data("url");
    $.ajax({
        url: url,
        type: "POST",
        data: {message: message},
        success: function (html) {
            if (clearChat == true) {
                $("#chat_message").val("");
            }
            $("#chat-box").html(html);
        }
    });
}

function reloadnum() {
    var url = $("#num").data("url");
    
    $.ajax({
        url: url,
        type: "POST",
        success: function (html) {
           $("#num").html(html);
           $("#num").attr("title",html + " New Messages");
        }
    });
}
setInterval(function () {
    reloadchat('', false);
    reloadnum();
}, 3000);
$("#btn-send-comment").on("click", function () {
    var message = $("#chat_message").val();
    reloadchat(message, true);
     $("#chat_message").val("");
});
