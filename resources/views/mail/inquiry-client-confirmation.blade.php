<div>
    <img src="{{ $message->embed(public_path() . '/images/logo.svg') }}"
        id="logo-image" width=300>
    <p>{{ $greeting }}</p>
    <p>Die Daten wurden an uns übermittelt. Wir werden uns umgehend mit Ihnen in Verbindung setzten.</p>
    <p>Ihre Anfragedaten lauten:</p>
    <style>
        .cr-beige {
            background-color: #f3f0dd;
        }
    </style>
    <table>
        @if ($offerLegacyId)
            <tr class="cr-beige">
                <td>Angebotsnummer</td>
                <td>{{ $offerLegacyId }}</td>
            </tr>
        @endif
        <tr>
            <td>Maximale Miete</td>
            <td>{{ $maxRent }}</td>
        </tr>
        <tr class="cr-beige">
            <td>Anzahl Zimmer</td>
            <td>{{ $numberOfRoomsMin }}</td>
        </tr>
        <tr>
            <td>Ab</td>
            <td>{{ format_date($startDate) }}</td>
        </tr>
        <tr class="cr-beige">
            <td>Mietdauer</td>
            <td>{{ $minMonths }}</td>
        </tr>
    </table>
    @if ($offerId)
        <?php $href = env('APP_URL') . '/offers/' . $offerId; ?>
        <p>Ihr angefragtes Objekt: <a href="{{ $href }}">{{ $href }}</a></p>
    @endif
</div>
