var Index = (function () {
    var handlePrint = function () {
        setTimeout(() => {
            var mode = "iframe";
            var close = mode == "popup";
            var options = { mode: mode, popClose: close };
            $("div.prsection").printArea(options);
        }, 2000);
    };
    return {
        init: function () {
            handlePrint();
        },
    };
})();

$(document).ready(function () {
    Index.init();
});
