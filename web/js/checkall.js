function checkthis(elm) {
    var cElem = $("#all" + elm);
    if (cElem.is(":checked")) {
        $("input." + elm).prop("checked", true);
    } else {
        $("input." + elm).prop("checked", false);
    }
}