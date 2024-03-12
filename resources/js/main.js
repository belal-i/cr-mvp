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

const offerTemplate = ({
    id,
    cssToggleSuffix,
    apartment__title,
    apartment__number_of_rooms,
    apartment__size_sq_m,
    address__neighborhood,
    address__street,
    address__nearby_public_transit,
    start_date,
    max_months,
    min_months,
    rent
}) => `
    <a href="/offers/${id}" class="row site-content offer-list-view-entry offer-list-view-entry-toggle-${cssToggleSuffix}">
        <div class="col-4">
            <img src="images/pexels-vecislavas-popa-1571463.jpg" width="300" height="200">
        </div>
        <div class="col-7">
            <h4><strong>${apartment__title}</strong></h4>
            <p>${apartment__number_of_rooms}, ${apartment__size_sq_m}m<sup>2</sup>${address__neighborhood}, ${address__street}</p>
            ${address__nearby_public_transit}
            <div style="text-align:right; width:100%;">
            <span style="float:left;"><strong>frei ab ${start_date}</strong>, ${max_months}, Mindestmietzeit ${min_months} Monate</span>Miete pro Monat: <strong>${rent}</strong>
            </div>
        </div>
    </a><!-- .row -->
`;

const emptyTemplate = `
    <div class="row site-content offer-list-view-entry">
        <p>Keine Angebote entsprechen Ihren Suchkriterien. Versuchen Sie es gerne erneut.</p>
    </div>
`;

$('#offer-filter-form').change(function () {
    serializedParams = '?status=F&ajax=1&'
        + $('#offer-filter-form').serialize();

    $.ajax({
        url: 'api/offers' + serializedParams,
        type: 'get',
        success: function (response) {
            offers = response['data'];
            cssToggleSuffix = 1;
            for (i = 0; i < offers.length; ++i) {
                offers[i]['cssToggleSuffix'] = cssToggleSuffix;
                cssToggleSuffix *= -1;
            }
            noun = offers.length == 1 ? 'Ergebnis' : 'Ergebnisse';
            $('#offer-filter-submit').prop('value',
                offers.length + ' ' + noun + ' anzeigen');
            if (offers.length > 0)
                $('#list-view-elements').html(offers.map(offerTemplate).join(''));
            else
                $('#list-view-elements').html(emptyTemplate);
        }
    });
});
