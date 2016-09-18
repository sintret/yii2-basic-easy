/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$("#type").on("change", function () {
    if ($(this).val() == 2) {
        $(".clientId").hide();
        $(".enddatelast").hide();
    } else {
        $(".clientId").show();
        $(".enddatelast").show();
    }
});