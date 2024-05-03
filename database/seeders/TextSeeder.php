<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homepageContent = <<<EOF
            <h4>City-Residence</h4>
            <p>Die City-Residence GmbH ist die führende Agentur
                für möbliertes Wohnen im Großraum Frankfurt.</p>

            <h4>Laravel</h4>
            <p>Laravel ist das führende Web-Application-Framework
                für Web-Anwendungen in PHP.</p>

            <h4>Über diese Seite</h4>
            <p>Diese Seite dient zu internen Testzwecken.
                Alle dargestellten Inhalte sind als fiktiv
                und unverbindllich zu verstehen.</p>
EOF;

        $renterInfo = <<<EOF
            <h4>Mietpreise in Frankfurt</h4>
            <p> Frankfurt gehört zu den eher teuren Städten Deutschlands. Als eine der wichtigsten europäischen Zentren für den Finanzsektor, als Dienstleistungsmetropole und als internationaler Verkehrsknotenpunkt bietet es zahlreiche interessante Arbeitsplätze an, die ihrerseits viele neue Mietinteressenten in die Stadt locken. Besonders die Innenstadtlagen mit hohem Altbaubestand und guter Infrastruktur, wie das Nordend oder das Westend, sind seit längerem bei Mieter sehr begehrt und daher auch teuer. Wohnraum in weniger zentralen Stadtlagen ziehen preislich nach, sie sind aber immer noch deutlich günstiger zu haben. Dies gilt auch für den möblierten Bereich. </p>

            <table class="crMietpreisTabelle" width="450" height="120" cellspacing="0" cellpadding="3" bordercolor="#DDD" border="1">
                <tbody>
                    <tr>
                        <th>Ausstattung</th>
                        <th>normal</th>
                        <th>gut</th>
                        <th>exklusiv</th>
                    </tr>
                    <tr>
                        <td><b>1 - Zimmer-Wohnungen</b></td>
                        <td>€ 950 - € 1050</td>
                        <td>€ 1050 - € 1300</td>
                        <td>€ 1300 - € 2000</td>
                    </tr>
                    <tr>
                        <td><b>2 - Zimmer-Wohnungen</b></td>
                        <td>€ 1450 - € 1600</td>
                        <td>€ 1600 - € 1800</td>
                        <td>€ 1800 - € 2600</td>
                    </tr>
                    <tr>
                        <td><b>3-4 - Zimmer-Wohnungen</b></td>
                        <td>€ 1800 - € 2100</td>
                        <td>€ 2100 - € 2800</td>
                        <td>€ 2800 - € 4000</td>
                    </tr>
                </tbody>
            </table>
EOF;

        $contact = <<<EOF
            <h4>Impressum</h4>
 
            <p>
                City-Residence GmbH
                Hansaallee 154 · 60320 Frankfurt am Main
                Telefon 069/299 05 - 0
                Telefax 069/299 05 - 353
                Email: frankfurt@city-residence.de
            </p>
EOF;

        $landlordInfo = <<<EOF
            <h3>Ablauf der Vermittlung</h3>
            <h4>Wohnungsangebot</h4>
            <p>Nachdem Sie Ihr Wohnungsangebot telefonisch oder online aufgegeben haben, sprechen unsere Mitarbeiter alle Details mit Ihnen ab. Bei neuen Mietobjekten vereinbaren wir in der Regel einen Termin vor Ort, damit der Kundenberater sich von der Wohnung einen Eindruck verschaffen kann. Offene Fragen können dann in einem persönlichen Gespräch geklärt werden. Gerne beraten wir Sie auch zu Fragen der Möblierung oder des richtigen Preises.</p>
            <h4>Fotoservice</h4>
            <p>Mitarbeiter unserer Agentur werden bei einem Fototermin das Wohnungsangebot mit professionellen Mitteln fotographisch dokumentieren und aufbereiten. Denn nur so kann es attraktiv dem internationalen Publikum präsentiert werden.</p>
            <h4>Vermarktung</h4>
            <p>Wir erstellen aus diesen Informationen und den Fotos ein umfangreiches Exposé, das für die Vermarktung anonymisiert wird.
            Die in unserer Datei schon registrierten Mietsuchenden werden dann kontaktiert, soweit die wesentlichen Suchkriterien zu Ihrem Mietangebot passen. Zudem wird es auf der Homepage und auf den wichtigsten Internet-Wohnungsbörsen den Interessenten zugänglich gemacht. Enge Verbindungen zu den Personalabteilungen großer Firmen und allen Relocation-Unternehmen im Frankfurter Raum steigern die Vermietungschancen der Wohnungsangebote.</p>
            <h4>Besichtigungen</h4>
            <p>Sobald wir passende Mietinteressenten für das Angebot gefunden haben, nehmen wir Kontakt mit Ihnen auf.
            Besichtigungen werden häufig von unseren Mitarbeitern durchgeführt, sofern wir die Schlüssel oder anderweitig Zutritt zur Wohnung haben. Zunehmend verzichten die Mieter auch auf eine Besichtigung und bitten um eine Direktanmietung.</p>
            <h4>Sicherheit bei der Vermietung</h4>
            <p>City-Residence unterstützt Sie bei der sorgfältigen Auswahl des passenden Mieters. Wir kümmern uns um die Einholung von Gehaltsnachweisen und unterstützen Sie bei der Vorbereitung von Mietverträgen. Als Vertragspartner der Schufa und Mitglied der Creditreform prüfen wir die Bonität der Mieter, soweit hier Daten vorliegen.</p>
            <h4>Mietvertrag</h4>
            <p>Gern stellt Ihnen City-Residence bewährte, auf den möblierten Bereich zugeschnittene Mietverträge zur Verfügung. Der Mietvertrag wird zwischen Ihnen als Vermieter und dem Mietinteressenten abgeschlossen. Wir unterstützen Sie aber gern bei der Vorbereitung des Vertrages. Sofern die Wohnungsübergabe durch einen Mitarbeiter unserer Agentur durchgeführt wird, nutzen wir digitale Inventarlisten und Übergabeprotokolle, die differenziert und transparent den jeweiligen Zustand der Wohnung dokumentieren.</p>
            <h4>Über die Vermittlung hinaus</h4>
            <p><Auch während der Mietzeit sind wir für Sie Ansprechpartner und stehen Ihnen mit Rat und Tat zur Seite./p> 
EOF;

        $interiorDesign = <<<EOF
            <h4>Einrichtungsberatung und Möblierungsservice</h4>
            <p> Bei der optimalen Vermietung Ihrer möblierten Wohnung ist die marktgerechte Einrichtung der Wohnung elementar. Eine der Nachfrage angepasste Aufteilung der Wohnung, ein guter Möblierungsstil und eine attraktive Präsentation erhöhen deutlich die Vermarktungs- und Renditechancen im Bereich der möblierten Wohnungen. City-Residence unterstützt Sie auf Wunsch bei der Planung, Einrichtung und Ausstattung Ihrer Wohnung. </p>
EOF;

        $about = <<<EOF
        <h4>Das Team der City-Residence</h4>
        <p>In der Arbeit des mehrsprachigen Teams der City-Residence GmbH verbindet sich langjährige Erfahrung und Innovationskraft. Es garantiert einen routinierten Ablauf des Vermittlungsprozesses und die Fähigkeit zur Improvisation dort, wo sie nötig ist. Unsere Mitarbeiter sprechen, neben Deutsch, Englisch, Französisch, Spanisch, Italienisch und Russisch.</p>
EOF;


        $textEntries = [
            [
                'id' => 1,
                'text_type' => 'HOMEPAGE_BANNER',
                'text_content' => 'Wohnen auf Zeit - Möblierte Wohnungen in besten Lagen',
            ],
            [
                'id' => 2,
                'text_type' => 'HOMEPAGE_CONTENT',
                'text_content' => $homepageContent,
            ],
            [
                'id' => 3,
                'text_type' => 'RENTER_INFO',
                'text_content' => $renterInfo,
            ],
            [
                'id' => 4,
                'text_type' => 'CONTACT',
                'text_content' => $contact,
            ],
            [
                'id' => 5,
                'text_type' => 'LANDLORD_INFO',
                'text_content' => $landlordInfo,
            ],
            [
                'id' => 6,
                'text_type' => 'INTERIOR_DESIGN',
                'text_content' => $interiorDesign,
            ],
            [
                'id' => 7,
                'text_type' => 'ABOUT',
                'text_content' => $about,
            ],
        ];
        foreach ($textEntries as $entry) {
            DB::table('texts')->insert($entry);
        }
    }
}
