/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$("#submit-parts").on("click", function () {
    
    var url = $(this).data("url");
    var jsonData = $("#parts-form").serializeArray();
    if (window.confirm("are you sure to submit ? ")) {
        $.ajax({
            url: url,
            type:"POST",
            data: jsonData,
            success: function (html) {
                if (html == 1) {
                    location.href = "";
                } else {
                    alert(html);
                }

            }
        });

    }
});