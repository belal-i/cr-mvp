$('#quickfilter-form').change(function () {
    serializedParams = '?status=F&' + $('#quickfilter-form').serialize();
    $.ajax({
        url: 'api/offers/count' + serializedParams,
        type: 'get',
        async: false,
        success: function (number) {
            if (number == 1)
                noun = 'Angebot';
            else
                noun = 'Angebote';
            $('#quickfilter-submit-button').html(number + ' ' + noun + ' zeigen');
        }
    });
});
