<!doctype html>
<html>
    <head>
        <title>Anfrage zur Vermittlung</title>
    </head>
    <body>
        <img src="{{ $message->embed(public_path() . '/images/logo.svg') }}"
            id="logo-image" width=300>
        <h3>Anfrage zur Vermittlung</h3>
        <style>
            .cr-beige {
                background-color: #f3f0dd;
            }
        </style>
        <table>
            <tr class="cr-beige">
                <td>Angebotsnummer</td>
                <td>{{ $sourceId }}</td>
            </tr>
            <tr>
                <td>Besichtigung gewünscht</td>
                <?php
                if ($appointmentWanted === true) {
                    $appointmentText = 'Ja';
                } else if ($appointmentWanted === false) {
                    $appointmentText = 'Nein';
                } else {
                    $appointmentText = '';
                }
                ?>
                <td>{{ $appointmentText }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Maximale Miete</td>
                <td>{{ $maxRent }}</td>
            </tr>
            <tr>
                <td>Anrede</td>
                <td>{{ $salutation }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Titel</td>
                <td>{{ $title }}</td>
            </tr>
            <tr>
                <td>Vorname</td>
                <td>{{ $firstName }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Nachname</td>
                <td>{{ $lastName }}</td>
            </tr>
            <tr>
                <td>Firma</td>
                <td>{{ $company }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Email</td>
                <td>{{ $email }}</td>
            </tr>
            <tr>
                <td>Telefon</td>
                <td>{{ $phone }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Fragen zum Objekt</td>
                <td>{{ $apartmentQuestions }}</td>
            </tr>
            <tr>
                <td>Anzahl Zimmer mindestens</td>
                <td>{{ $numberOfRoomsMin }}</td>
            </tr>
            <tr class="cr-beige">
                <td>Ab</td>
                <td>{{ format_date($startDate) }}</td>
            </tr>
            <tr>
                <td>Spätestes Einzugsdatum</td>
                <td>{{ format_date($latestMoveInDate) }}</td>
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
            <tr>
                <td>Sonstiges</td>
                <td>{{ $other }}</td>
            </tr>
        </table>
    </body>
</html>
