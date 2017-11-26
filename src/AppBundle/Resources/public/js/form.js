(function($){
    "use strict";

    $(function(){
        $(".delete-feature").click(function() {
            $("#data-container-deletion").data("url", "");
            $('#delete-modal').modal('toggle');
            $("#data-container-deletion").data("url", $(this).attr("href"));
            return false;
        });
        $("#btn-validate-deletion").click(function(){
            if ($("#data-container-deletion").data("url") !== "") {
                window.location.href = $("#data-container-deletion").data("url");
            }
        });
    });
})(jQuery);
