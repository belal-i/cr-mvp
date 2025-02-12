<!doctype html>
<html>
    <head>
        <title>Anfrage zur Vermittlung</title>
    </head>
    <body>
        <img src="{{ $message->embed(public_path() . '/images/city-residence-logo.svg') }}"
            id="logo-image" width=300>
        <h3>Anfrage zur Vermittlung</h3>
        <style>
            .cr-beige {
                background-color: #f3f0dd;
            }
        </style>
        <table>
            <tr class="cr-beige">
                <td>Legacy-ID</td>
                <td>{{ $sourceId }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Besichtigung gewünscht</td>
                <td>{{ $appointmentWanted ? 'Ja' : 'Nein' }}</td>
            </tr>
            <tr>
                <td>Maximale Miete</td>
                <td>{{ $maxRent }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Anrede</td>
                <td>{{ $salutation }}</td>
            </tr>
            <tr>
                <td>Titel</td>
                <td>{{ $title }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Vorname</td>
                <td>{{ $firstName }}</td>
            </tr>
            <tr>
                <td>Nachname</td>
                <td>{{ $lastName }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Firma</td>
                <td>{{ $company }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $email }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Telefon</td>
                <td>{{ $phone }}</td>
            </tr>
            <tr>
                <td>Fragen zum Objekt</td>
                <td>{{ $apartmentQuestions }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Anzahl Zimmer mindestens</td>
                <td>{{ $numberOfRoomsMin }}</td>
            </tr>
            <tr>
                <td>Ab</td>
                <td>{{ $startDate }}</td>
            </tr>
            <tr>
                <td>Spätestes Einzugsdatum</td>
                <td>{{ $latestMoveInDate }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Monate mindestens</td>
                <td>{{ $minMonths }}</td>
            </tr>
            <tr>
                <td>Info zu Personen</td>
                <td>{{ $personsInfo }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Gewünschte Lage</td>
                <td>{{ $neighborhood }}</td>
            </tr>
            <tr>
                {{-- TODO: In the frontend, it's an unnecessarily verbose text field.
                    Fields like this would be better boolean values
                --}}
                <td>Haustiere</td>
                <td>{{ $petsInfo }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Einkommensart</td>
                <td>{{ $jobType }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Sonst</td>
                <td>{{ $other }}</td>
            </tr>
        </table>
    </body>
</html>
