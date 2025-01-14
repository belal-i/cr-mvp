@extends ('layouts/site')
@section ('content')

<form class="site-content" method="post" action="/send-inquiry">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="source_id" value="{{ $offer->source_id }}">
    <div class="row cr-beige mt-5">
        <h3>Angebotsanfrage</h3>
        <p>Pflichtfelder</p>
    </div>
    <div class="row mt-3">
        <h4>Objekt <?php echo $offer->getInfoAtAGlanceText(); ?></h4>
    </div>
    <div class="mt-3">
        <input type="radio" name="appointment-wanted" id="no" value="no">
        <label for="no">Ich möchte das Objekt ohne Besichtigung mieten.</label><br>
        <input type="radio" name="appointment-wanted" id="yes" value="yes">
        <label for="no">Ich möchte einen Besichtigungstermin vereinbaren.</label><br>
    </div>
    <div class="mt-3">
        <label>Ich habe zu dem Angebot folgende Fragen:</label><br>
        <textarea name="apartment-questions" id="apartment-questions" rows=3 cols=40></textarea>
    </div>

    <div class="row cr-beige mt-5">
        <h4>Meine Suchkriterien:</h4>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Maximaler Mietpreis in Euro/pro Monat inkl. Nebenkosten
        </div>
        <input class="col-sm-12 col-md-3" type="number" name="max-rent" id="max-rent">
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Welche Art von Wohnraum benötigen Sie mindestens:
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Zimmer mindestens
        </div>
        <input class="col-sm-12 col-md-3" type="number" name="number_of_rooms-min" id="number_of_rooms-min">
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Ab wann
        </div>
        <input class="col-sm-12 col-md-2" type="date" name="start_date" id="start_date">
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Spätester Einzugstermin
        </div>
        <input class="col-sm-12 col-md-2" type="date" name="latest-move-in-date" id="latest-move-in-date">
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Wie lange möchten Sie mieten?
        </div>
        <span class="col-sm-12 col-md-9">Voraussichtlich <input type="number" name="min_months"> Monate</span>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Anzahl und Status der Personen
            (Einzelperson/Paar/Kinder/Kollegen)
            (Name der miteinziehenden Personen, Alter der Kinder)
        </div>
        <textarea class="col-sm-12 col-md-6" name="persons-info" rows=4></textarea>
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Gewünschte Lage / Stadtteil bzw. Beschäftigungsort
        </div>
        <input type="text" class="col-sm-12 col-md-6" name="neighborhood">
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Bringen Sie Haustiere mit? (Wenn ja welche?)
        </div>
        <textarea class="col-sm-12 col-md-6" name="pets-info" rows=4></textarea>
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Beschäftigung/Einkommensart
        </div>
        <input type="text" class="col-sm-12 col-md-6" name="job_type">
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Anrede
        </div>
        <?php echo make_select_html(
            'salutation',
            [
                # TODO: See Redmine #1277.
                '' => '',
                'Familie' => 'Familie',
                'Frau Dr.' => 'Frau Dr.',
                'Herr Dr.' => 'Herr Dr.',
                'Frau' => 'Frau',
                'Herr' => 'Herr',
            ],
            null,
            [
                'col-sm-12',
                'col-md-6',
            ],
        ); ?>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Titel
        </div>
        <input type="text" class="col-sm-12 col-md-6" name="title">
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Nachname
        </div>
        <input type="text" class="col-sm-12 col-md-6" name="last_name">
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Vorname
        </div>
        <input type="text" class="col-sm-12 col-md-6" name="first_name">
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Firma
        </div>
        <input type="text" class="col-sm-12 col-md-6" name="company">
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Email
        </div>
        <input type="text" class="col-sm-12 col-md-6" name="email">
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Telefon
        </div>
        <input type="text" class="col-sm-12 col-md-6" name="phone">
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Sonstiges
        </div>
        <textarea class="col-sm-12 col-md-6" name="other" placeholder="Ihre Erreichbarkeit, weitere Angebotsnummern usw." rows=4></textarea>
    </div>
    {{-- TODO : Links for this legal stuff. --}}
    <div class="row mt-3">
        <h5>Allgemine Geschäftsbedingungen</h5>
        <span>
            <input type="checkbox" id="tos" name="tos">
            <label for="tos">Mit Absenden dieses Auftrages erkennt der Auftraggeber die <a href="#">Allgemeinen Geschäftsbedingungen</a> der City-Residence GmbH an.</label>
        </span>
    </div>
    <div class="row mt-3">
        <h5>Datenschutzerklärung</h5>
        <span>
            <input type="checkbox" id="privacy" name="privacy">
            <label for="privacy">Mit Absenden dieses Auftrages bestätigt der Auftraggeber die <a href="#">Datenschutzerklärung</a> gelesen zu haben und nimmt diese an.</label>
        </span>
    </div>
    <div class="row mt-3 cr-beige">
        <div class="row m-2">
            <input class="col-sm-12 col-md-6 @error('captcha') is-invalid @enderror" type="text" name="captcha" placeholder="Please enter the following CAPTCHA:">
        </div>
        @error('captcha')
        <div class="invalid-feedback">{{ $message }}</div> @enderror
        <div class="row m-2">
            <?php echo captcha_img(attrs: ['class'=> 'col-sm-12 col-md-4']); ?>
        </div>
    </div>
    <div class="row mt-3">
        <input class="cr-submit-button col-2" type="submit" value="Anfrage senden">
    </div>
</form>
@endsection
