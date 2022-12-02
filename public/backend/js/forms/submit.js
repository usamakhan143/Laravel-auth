(function () {
    $('.prevent-form-multiple-submit').on('submit', function () {
        $('.prevent-button-multiple-submit').attr('disabled', 'true');
        $('.spinner').show();
    })

    $(".anchor-links").on("click", function (event) {
    
        $('.punch').css("display", "none");
        $('.spinner').show();
            event.preventDefault();
            var href = $(this).attr('data-url');
            $(this).attr('data-url', 'javascript:void(0);');
            window.location.href = href;
    });

})();