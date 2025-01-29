@extends ('layouts/site')
@section ('content')
<form class="site-content" method="post" action="/send-inquiry">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="source_id" value="{{ $offer->source_id }}">
    <div class="row cr-beige mt-5">
        <h3>Angebotsanfrage</h3>
        <p><span class="cr-reqfield">*</span>Pflichtfelder</p>
    </div>
    <div class="row mt-3">
        <h4>Objekt <?php echo $offer->getInfoAtAGlanceText(); ?></h4>
    </div>
    <div class="mt-3">
        <input type="radio" name="appointment-wanted" id="no" value="no"
            <?php echo old('appointment-wanted') == 'no' ? 'checked="checked"' : ''; ?>>
        <label for="no">Ich möchte das Objekt ohne Besichtigung mieten.</label><br>
        <input type="radio" name="appointment-wanted" id="yes" value="yes"
            <?php echo old('appointment-wanted') == 'yes' ? 'checked="checked"' : ''; ?>>
        <label for="yes">Ich möchte einen Besichtigungstermin vereinbaren.</label><br>
    </div>
    <div class="mt-3">
        <label>Ich habe zu dem Angebot folgende Fragen:</label><br>
        <textarea name="apartment-questions" id="apartment-questions" rows=3 cols=40
        >{{ old('apartment-questions') }}</textarea>
    </div>

    <div class="row cr-beige mt-5">
        <h4>Meine Suchkriterien:</h4>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Maximaler Mietpreis in Euro/pro Monat inkl. Nebenkosten<span class="cr-reqfield">*</span>
        </div>
        <input class="col-sm-12 col-md-3 @error('max-rent') is-invalid @enderror" type="number" name="max-rent"
            value="{{ old('max-rent') }}">
    </div>
    <div class="row mt-1">
        @error('max-rent')
            <div class="col-md-3"></div>
            <div class="alert alert-danger col-sm-12 col-md-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Welche Art von Wohnraum benötigen Sie mindestens:
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Zimmer mindestens<span class="cr-reqfield">*</span>
        </div>
        <input class="col-sm-12 col-md-3 @error('number_of_rooms-min') is-invalid @enderror"
            type="number" name="number_of_rooms-min"
            value="{{ old('number_of_rooms-min') }}">
    </div>
    <div class="row mt-1">
        @error('number_of_rooms-min')
            <div class="col-md-3"></div>
            <div class="alert alert-danger col-sm-12 col-md-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Ab wann<span class="cr-reqfield">*</span>
        </div>
        <input class="col-sm-12 col-md-2 @error('start_date') is-invalid @enderror"
            type="date" name="start_date"
            value="{{ old('start_date') }}">
    </div>
    <div class="row mt-1">
        @error('start_date')
            <div class="col-md-3"></div>
            <div class="alert alert-danger col-sm-12 col-md-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Spätester Einzugstermin
        </div>
        <input class="col-sm-12 col-md-2" type="date" name="latest-move-in-date"
            value="{{ old('latest-move-in-date') }}">
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Wie lange möchten Sie mieten?<span class="cr-reqfield">*</span>
        </div>
        <span class="col-sm-12 col-md-9">Voraussichtlich <input type="number" name="min_months"
            class="@error('min_months') is-invalid @enderror"
            value="{{ old('min_months') }}"> Monate</span>
    </div>
    <div class="row mt-1">
        @error('min_months')
            <div class="col-md-3"></div>
            <div class="alert alert-danger col-sm-12 col-md-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Anzahl und Status der Personen
            (Einzelperson/Paar/Kinder/Kollegen)
            (Name der miteinziehenden Personen, Alter der Kinder)<span class="cr-reqfield">*</span>
        </div>
        <textarea class="col-sm-12 col-md-6 @error('persons-info') is-invalid @enderror"
            name="persons-info" rows=4
        >{{ old('persons-info') }}</textarea>
    </div>
    <div class="row mt-1">
        @error('persons-info')
            <div class="col-md-3"></div>
            <div class="alert alert-danger col-sm-12 col-md-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Gewünschte Lage / Stadtteil bzw. Beschäftigungsort
        </div>
        <input type="text" class="col-sm-12 col-md-6" name="neighborhood"
            value="{{ old('neighborhood') }}">
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Bringen Sie Haustiere mit? (Wenn ja welche?)
        </div>
        <textarea class="col-sm-12 col-md-6" name="pets-info" rows=4
        >{{ old('pets-info') }}</textarea>
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Beschäftigung/Einkommensart<span class="cr-reqfield">*</span>
        </div>
        <input type="text" class="col-sm-12 col-md-6 @error('job_type') is-invalid @enderror"
            name="job_type" value="{{ old('job_type') }}">
    </div>
    <div class="row mt-1">
        @error('job_type')
            <div class="col-md-3"></div>
            <div class="alert alert-danger col-sm-12 col-md-3">{{ $message }}</div>
        @enderror
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
            old('salutation'),
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
        <input type="text" class="col-sm-12 col-md-6" name="title"
            value="{{ old('title') }}">
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Nachname<span class="cr-reqfield">*</span>
        </div>
        <input type="text" class="col-sm-12 col-md-6 @error('last_name') is-invalid @enderror"
            name="last_name" value="{{ old('last_name') }}">
    </div>
    <div class="row mt-1">
        @error('last_name')
            <div class="col-md-3"></div>
            <div class="alert alert-danger col-sm-12 col-md-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3">
            Vorname
        </div>
        <input type="text" class="col-sm-12 col-md-6" name="first_name"
            value="{{ old('first_name') }}">
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Firma
        </div>
        <input type="text" class="col-sm-12 col-md-6" name="company"
            value="{{ old('company') }}">
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3 @error('email') is-invalid @enderror">
            Email<span class="cr-reqfield">*</span>
        </div>
        <input type="text" class="col-sm-12 col-md-6" name="email"
            value="{{ old('email') }}">
    </div>
    <div class="row mt-1">
        @error('email')
            <div class="col-md-3"></div>
            <div class="alert alert-danger col-sm-12 col-md-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="row mt-3">
        <div class="col-sm-12 col-md-3 @error('phone') is-invalid @enderror">
            Telefon<span class="cr-reqfield">*</span>
        </div>
        <input type="text" class="col-sm-12 col-md-6" name="phone"
            value="{{ old('phone') }}">
    </div>
    <div class="row mt-1">
        @error('phone')
            <div class="col-md-3"></div>
            <div class="alert alert-danger col-sm-12 col-md-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="row mt-3 cr-beige">
        <div class="col-sm-12 col-md-3">
            Sonstiges
        </div>
        <textarea class="col-sm-12 col-md-6" name="other"
            placeholder="Ihre Erreichbarkeit, weitere Angebotsnummern usw." rows=4
            >{{ old('other') }}</textarea>
    </div>
    <div class="row mt-3">
        <h5>Allgemine Geschäftsbedingungen<span class="cr-reqfield">*</span></h5>
        <span>
            <?php echo make_checkbox(
                'tos',
                "Mit Absenden dieses Auftrages erkennt
                der Auftraggeber die <a href=\"/tos\">Allgemeinen Geschäftsbedingungen</a>
                der City-Residence GmbH an.",
                old('tos') == 'on',
                'tos'
            ); ?>
        </span>
    </div>
    <div class="row mt-1">
        @error('tos')
            <div class="alert alert-danger col-sm-12 col-md-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="row mt-3">
        <h5>Datenschutzerklärung<span class="cr-reqfield">*</span></h5>
        <span>
            <?php echo make_checkbox(
                'privacy',
                "Mit Absenden dieses Auftrages bestätigt der Auftraggeber die
                <a href=\"/privacy-policy\">Datenschutzerklärung</a> gelesen zu
                haben und nimmt diese an.",
                old('privacy') == 'on',
                'privacy'
            ); ?>
        </span>
    </div>
    <div class="row mt-1">
        @error('privacy')
            <div class="alert alert-danger col-sm-12 col-md-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="row mt-3 cr-beige">
        <div class="row m-2">
            <input class="col-sm-12 col-md-6 @error('captcha') is-invalid @enderror"
                type="text" name="captcha" placeholder="Please enter the following CAPTCHA:">
        </div>
        <div class="row m-2">
            <?php echo captcha_img(attrs: ['class'=> 'col-sm-12 col-md-4']); ?>
        </div>
    </div>
    <div class="row mt-1">
        @error('captcha')
            <div class="alert alert-danger col-sm-12 col-md-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="row mt-3">
        <input class="cr-submit-button col-2" type="submit" value="Anfrage senden">
    </div>
    <div class="row mt-3 cr-beige">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>
</form>
@endsection
