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

        $tos = <<<EOF
        <h4>Allgemeine Geschäftsbedingungen für Mietinteressenten der City-Residence GmbH</h4>
        <p>Gültig ab 1. Juni 2015</p>

        <h5>Provisionsfreiheit für Mieter</h5>
        <p>Die Anmietung von Wohnraum, der unter Vermittlung der City-Residence GmbH erfolgt, ist für Mieter § 2 Abs.1a WohnVermittG provisionsfrei.</p>

        <h5>Angebotsnachweis</h5>
        <p>City-Residence GmbH ist als Auftragnehmer beauftragt, ein den angegebenen Bedingungen entsprechendes Mietobjekt nachzuweisen oder zu vermitteln. Der Nachweis bzw. die Vermittlung kann vom Auftragnehmer in jeder Form, auch telefonisch, per Fax oder per Email gegenüber den Mietinteressenten geführt werden.</p>

        <h5>Informationspflicht</h5>
        <p>Kommt durch die Inanspruchnahme des Auftragnehmers ein Mietverhältnis zustande, ist die City-Residence GmbH sofort, spätestens am nächsten Werktag zu informieren.</p>
        <p>Diese Informationspflicht gilt auch, wenn kein Mietvertrag zustande gekommen ist. Der Mietsuchende erklärt zugleich, dass er von den nachgewiesenen Angeboten keinen Gebrauch gemacht hat und auch in Zukunft nicht tun wird. Für Kosten, die City-Residence GmbH aus der Nichtbeachtung dieser Informationspflicht entstehen, haftet der Mietinteressent als Auftraggeber.</p>

        <h5>Weitergabe von Daten</h5>
        <p>Die Daten des Mietinteressenten (Name, Kontaktdaten, Informationen zum Arbeitgeber etc.) werden von City-Residence vertraulich behandelt und nur in bestimmten Fällen an Wohnungsanbieter bzw. deren Vertreter oder Beauftragte weitergegeben.</p>
        <p>Der Mietinteressent verpflichtet sich ebenso, die von City-Residence erhaltenen Daten von Wohnraumanbietern (Name, Kontaktdaten, etc.) vertraulich zu behandeln und nicht an Dritte weiterzugegeben.</p>

        <h5>Einverständnis zur Abfrage bei Auskunfteien</h5>
        <p>City-Residence holt i.d.R. spätestens bei der Vorbereitung des Mietvertrages Informationen zum Mietinteressenten bei Auskunfteien wie der Schufa und der Creditreform ein. Der Auftraggeber erklärt hiermit vorab seine Zustimmung.</p>

        <h5>Haftung</h5>
        <p>Die Tätigkeit von City-Residence GmbH erstreckt sich auf die Vermittlungs- bzw. Nachweistätigkeit. Eine weitergehende Haftung, insbesondere aus dem bestehenden Unterkunftsverhältnis oder auch für den Fall der Stornierung einer Mietzusage, ist ausdrücklich ausgeschlossen.</p>

        <h5>Salvatorische Klausel</h5>
        <p>Die Rechtsunwirksamkeit einzelner Bestimmungen dieses Vertrages berührt nicht die Gültigkeit der übrigen Bestimmungen. In diesem Fall ist der Vertrag sinngemäß zu verstehen.</p>

        <h5>Gerichtsstand</h5>
        <p>Gerichtsstand ist, sofern der Auftraggeber Kaufmann im Sinne des HGB ist, Frankfurt am Main.</p>

        <h5>Datenschutz</h5>
        <p>Die City-Residence GmbH nimmt den Schutz personenbezogener Daten sehr ernst. Wir möchten, dass Sie wissen, wann wir welche Daten speichern und wie wir sie verwenden. Als privatrechtliches Unternehmen unterliegen wir den Bestimmungen des Bundesdatenschutzgesetzes (BDSG) und des Telemediengesetzes (TMG). Wir haben technische und organisatorische Maßnahmen getroffen, die sicherstellen, dass die Vorschriften über den Datenschutz sowohl von uns als auch von externen Dienstleistern beachtet werden. Unsere Datenschutzerklärung finden sie hier.</p>

EOF;

        $privacyPolicy = <<<EOF
        <h5>Der Schutz Ihrer Daten ist uns wichtig.</h5>

        Die City-Residence GmbH legt großen Wert auf den Schutz Ihrer personen-bezogenen Daten. Wir möchten, dass Sie wissen, wann wir welche Daten speichern und wie wir sie verwenden. Als privatrechtliches Unternehmen unterliegen wir den Bestimmungen der EU-Datenschutzgrundverordnung (DSGVO) vom 26.04.2016. Wir haben technische und organisatorische Maßnahmen getroffen, die sicherstellen, dass die Vorschriften über den Datenschutz sowohl von uns als auch von externen Dienstleistern beachtet werden.

        <h5>Datenschutzerklärung der City-Residence GmbH, Frankfurt am Main</h5>

        <h5>Hinweis zur verantwortlichen Stelle</h5>

        Die verantwortliche Stelle für die Datenverarbeitung auf dieser Website ist:

        City-Residence GmbH
        vertreten durch die Geschäftsführer Martin Bernemann und Guido Anders
        Hansaallee 154
        60320 Frankfurt
        069-29905-0
        E-Mail: info@city-residence.de

        Verantwortliche Stelle ist die natürliche oder juristische Person, die allein oder gemeinsam mit anderen über die Zwecke und Mittel der Verarbeitung von personenbezogenen Daten (z.B. Namen, E-Mail-Adressen o. ä.) entscheidet.

        <h5>1. Erfassung allgemeiner Informationen</h5>

        Wenn Sie auf unsere Webseite zugreifen, werden automatisch Informationen allgemeiner Natur erfasst. Diese Informationen (Server-Logfiles) beinhalten etwa die Art des Webbrowsers, das verwendete Betriebssystem, den Domainnamen Ihres Internet Service Providers und Ähnliches. Hierbei handelt es sich ausschließlich um Informationen, welche keine Rückschlüsse auf Ihre Person zulassen. Diese Informationen sind technisch notwendig, um von Ihnen angeforderte Inhalte von Webseiten korrekt auszuliefern und fallen bei Nutzung des Internets zwingend an. Anonyme Informationen dieser Art werden von uns statistisch ausgewertet, um unseren Internetauftritt und die dahinterstehende Technik zu optimieren.

        <h5>2. Personenbezogene Daten</h5>

        Personenbezogene Daten sind Informationen, die dazu genutzt werden können, Ihre Identität zu erfahren. Darunter fallen Informationen wie Ihr richtiger Name, Adresse, Postanschrift, Telefonnummer. Informationen, die nicht direkt mit Ihrer wirklichen Identität in Verbindung gebracht werden (wie zum Beispiel favorisierte Webseiten oder Anzahl der Nutzer einer Site) fallen nicht darunter. Sie können unser Online-Angebot grundsätzlich ohne Offenlegung Ihrer Identität nutzen. Wenn Sie sich für einen unserer personalisierten Dienste registrieren lassen, ein Miet-  oder Vermietgesuch oder ein Kauf- oder Verkaufsgesuch einstellen, fragen wir Sie nach Ihrem Namen und nach anderen persönlichen Informationen. Es unterliegt Ihrer

        freien Entscheidung, ob Sie diese Daten eingeben. Ihre Angaben speichern wir auf besonders geschützten Servern in Deutschland. Der Zugriff darauf ist nur wenigen besonders befugten Personen möglich, die mit der technischen, kaufmännischen oder redaktionellen Betreuung der Server befasst sind. In Verbindung mit Ihrem Zugriff werden auf unseren Servern Daten für Sicherungszwecke gespeichert, die möglicherweise eine Identifizierung zulassen (zum Beispiel IP-Adresse, Datum, Uhrzeit und betrachtete Seiten). Es findet keine personenbezogene Verwertung statt. Die statistische Auswertung anonymisierter Datensätze bleibt vorbehalten.

        <h5>3. Zweck der Datenverarbeitung</h5>

        Vermittlung von möbliertem Wohnraum sowie Immobilienverkauf.

        <h5>4. Weitergabe personenbezogener Informationen an Dritte</h5>

        Wir verwenden Ihre personenbezogenen Daten im Falle von Miet-/Vermietgesuchen, Kauf- /Verkaufsgesuchen sowie Bewertungs- und Berateranfragen nur innerhalb der City-Residence GmbH und geben Sie nur an Dritte weiter, soweit das zur erfolgreichen Wohnungsvermittlung notwendig ist. Dritte im vorgenannten Sinne sind im Fall eines Mietgesuchs potentielle Vermieter und deren Beauftragte, im Falle eines Vermietgesuchs potentielle Mieter und deren Beauftragte und im Falle eines Kauf-/Verkaufsgesuches potentielle Käufer und Verkäufer sowie deren Beauftragten.  Die erfolgreiche Durchführung unseres Vermittlungsauftrags beinhaltet auch Nachfragen zur Qualität unserer Dienstleistung.

        Eine Weitergabe Ihrer Daten an Dritte ohne ausdrückliche Zustimmung, etwa zu Zwecken der Werbung, erfolgt nicht. Grundlage für die Datenverarbeitung  ist Art. 6 Abs. 1 Nr. b DSGVO, der die Verarbeitung von Daten zur Erfüllung eines Vertrages oder vorvertraglicher Maßnahmen gestattet. Soweit wir im Rahmen der Auftragsdatenverarbeitung Daten an unsere Dienstleister weitergeben, so erfolgt dies nur, wenn diese Dienstleister sich gemäß ihrer eigenen Datenschutzerklärung auf die Einhaltung der DSGVO verpflichtet haben. Soweit wir gesetzlich oder per Gerichtsbeschluss dazu verpflichtet sind, werden wir Ihre Daten an auskunftsberechtigte Stellen übermitteln.

        Die City-Residence GmbH leitet keine Daten an Drittländer oder internationale Organisationen weiter..

        <h5>5. Recht auf Widerruf</h5>

        Sie haben das Recht, Ihre Einwilligung zur Datenerhebung jederzeit zu widerrufen. Durch den Widerruf der Einwilligung wird die Rechtmäßigkeit der aufgrund der Einwilligung bis zum Widerruf erfolgten Verarbeitung der erhobenen Daten nicht berührt. Sollten Sie von Ihrem Recht auf Widerspruch Gebrauch machen, senden Sie bitte eine formlose Mitteilung per E-Mail an uns.

        <h5>6. Beschwerderecht bei der zuständigen Aufsichtsbehörde</h5>

        Sie haben das Recht auf Beschwerde bei der zuständigen Aufsichtsbehörde, wenn Sie der Ansicht sind, dass die Verarbeitung der Sie betreffenden Daten rechtswidrig ist.

        <h5>7. Rechte auf Auskunft, Berichtigung, Sperre, Löschung und Datenübertragung</h5>

        Sie haben das Recht, jederzeit Auskunft über Ihre bei uns gespeicherten personenbezogenen Daten zu erhalten. Ebenso haben Sie das Recht auf Berichtigung, Sperrung oder, abgesehen von der vorgeschriebenen Datenspeicherung zur Geschäftsabwicklung, Löschung Ihrer personenbezogenen Daten. Bitte wenden Sie sich dazu an unseren Datenschutzbeauftragten. Die Kontaktdaten finden Sie ganz unten.

        Sie können Änderungen oder den Widerruf einer Einwilligung durch entsprechende Mitteilung an uns mit Wirkung für die Zukunft vornehmen.
        Wir halten uns an die Grundsätze der Datenvermeidung und Datensparsamkeit. Wir speichern Ihre personenbezogenen Daten daher nur so lange, wie dies zur Erreichung der hier genannten Zwecke erforderlich ist oder wie es die vom Gesetzgeber vorgesehenen vielfältigen Speicherfristen vorsehen. Nach Fortfall des jeweiligen Zweckes bzw. Ablauf dieser Fristen werden die entsprechenden Daten routinemäßig und entsprechend den gesetzlichen Vorschriften gesperrt oder gelöscht.
        Sie haben das Recht, Daten, die wir auf Grundlage Ihrer Einwilligung oder in Erfüllung eines Vertrages automatisiert verarbeiten, an sich oder an einen Dritten in einem gängigen, maschinenlesbaren Format aushändigen zu lassen. Sofern Sie die direkte Übertragung der Daten an einen anderen Verantwortlichen verlangen, erfolgt dies nur, soweit es technisch machbar ist..

        <h5>8. SSL-Verschlüsselung</h5>

        Um die Sicherheit Ihrer Daten bei der Übertragung zu schützen, verwenden wir das dem aktuellen Stand der Technik entsprechende Verschlüsselungsverfahren SSL (Secure Socket Layer) über HTTPS.
        Dieses Verfahren gewährleistet ein sehr hohes Maß an Sicherheit bei der Übertragung von Daten an City-Residence GmbH.

        <h5>9. Datenschutzerklärung in Bezug auf Verwendung „Google Analytics</h5>

        Diese Webseite benutzt Google Analytics, einen Webanalysedienst der Google Inc. (folgend: Google). Google Analytics verwendet sog. „Cookies“, also Textdateien, die auf Ihrem Computer gespeichert werden und die eine Analyse der Benutzung der Webseite durch Sie ermöglichen. Die durch das Cookie erzeugten Informationen über Ihre Benutzung dieser Webseite werden in der Regel an einen Server von Google in den USA übertragen und dort gespeichert. Aufgrund der Aktivierung der IP-Anonymisierung auf diesen Webseiten, wird Ihre IP-Adresse von Google jedoch innerhalb von Mitgliedstaaten der Europäischen Union oder in anderen Vertragsstaaten des Abkommens über den Europäischen Wirtschaftsraum zuvor gekürzt. Nur in Ausnahmefällen wird die volle IP-Adresse an einen Server von Google in den USA übertragen und dort gekürzt. Im Auftrag des Betreibers dieser Webseite wird Google diese Informationen benutzen, um Ihre Nutzung der Webseite auszuwerten, um Reports über die Webseitenaktivitäten zusammenzustellen und um weitere mit der Webseitennutzung und der Internetnutzung verbundene Dienstleistungen gegenüber dem Webseitenbetreiber zu erbringen. Die im Rahmen von Google Analytics von Ihrem Browser übermittelte IP-Adresse wird nicht mit anderen Daten von Google zusammengeführt.
        Sie können die Speicherung der Cookies durch eine entsprechende Einstellung Ihrer Browser-Software verhindern; wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht sämtliche Funktionen dieser Webseite vollumfänglich werden nutzen können. Sie können darüber hinaus die Erfassung der durch das Cookie erzeugten und auf Ihre Nutzung der Webseite bezogenen Daten (inkl. Ihrer IP-Adresse) an Google sowie die Verarbeitung dieser Daten durch Google verhindern, indem sie das unter dem folgenden Link verfügbare Browser-Plugin herunterladen und installieren: Browser-Add-on zur Deaktivierung von Google Analytics.
        Zusätzlich oder als Alternative zum Browser-Add-On können Sie das Tracking durch Google Analytics auf unseren Seiten unterbinden, indem Sie diesen Link anklicken. Dabei wird ein Opt-Out-Cookie auf Ihrem Gerät installiert. Damit wird die Erfassung durch Google Analytics für diese Website und für diesen Browser zukünftig verhindert, so lange der Cookie in Ihrem Browser installiert bleibt.

        <h5>10. Datenschutzerklärung für die Nutzung von Etracker</h5>

        Diese Webseite benutzt den Webanalysedienst der Firma etracker GmbH, Erste Brunnenstraße 1, 20459 Hamburg. Mit etracker Analytics ist tracken datenschutzkonform ohne Einwilligung. etracker Analytics und etracker Optimiser wurden in einem umfänglichen technischen wie juristischen Verfahren von unabhängigen Datenschutz-Experten geprüft. Die Einhaltung der Regelungen von EU-DSGVO und BDSG neu wurde bestätigt, zertifiziert und mit dem Datenschutz-Gütesiegel ePrivacyseal ausgezeichnet. Die Datenverarbeitung ist mit etracker Analytics und Optimiser durch Art. 6 Abs. 1 f EU-DSGVO zu rechtfertigen. Art. 6 Abs. 1 f der EU-DSGVO besagt, dass die Datenverarbeitung von personenbezogenen Daten auch ohne Einwilligung rechtmäßig ist, wenn sie einem berechtigten Interesse wie der Optimierung des eigenen Online-Angebotes dient und die Privatsphäre nicht verletzt. Zum Schutz der Privatsphäre werden bei etracker Daten wie die IP-Adresse, Anmelde- oder Gerätekennungen frühestmöglich pseudonymisiert, so dass ein Bezug zu einer bestimmten Person nicht mehr herstellbar ist. Eine andere Verwendung, Zusammenführung mit anderen Daten von etracker oder eine Weitergabe an Dritte erfolgt nicht.

        <h5>11. Verwendung von Scriptbibliotheken (Google Webfonts)</h5>

        Um unsere Inhalte browserübergreifend korrekt und grafisch ansprechend darzustellen, verwenden wir auf dieser Website Scriptbibliotheken und Schriftbibliotheken wie z. B. Google Webfonts (https://www.google.com/webfonts/). Google Webfonts werden zur Vermeidung mehrfachen Ladens in den Cache Ihres Browsers übertragen. Falls der Browser die Google Webfonts nicht unterstützt oder den Zugriff unterbindet, werden Inhalte in einer Standardschrift angezeigt.
        Der Aufruf von Scriptbibliotheken oder Schriftbibliotheken löst automatisch eine Verbindung zum Betreiber der Bibliothek aus. Dabei ist es theoretisch möglich – aktuell allerdings auch unklar ob und ggf. zu welchen Zwecken – dass Betreiber entsprechender Bibliotheken Daten erheben.
        Die Datenschutzrichtlinie des Bibliothekbetreibers Google finden Sie hier: https://www.google.com/policies/privacy/

        <h5>12. Verwendung von Google Maps</h5>

        Diese Webseite verwendet Google Maps API, um geographische Informationen visuell darzustellen. Bei der Nutzung von Google Maps werden von Google auch Daten über die Nutzung der Kartenfunktionen durch Besucher erhoben, verarbeitet und genutzt. Nähere Informationen über die Datenverarbeitung durch Google können Sie den Google-Datenschutzhinweisenentnehmen. Dort können Sie im Datenschutzcenter auch Ihre persönlichen Datenschutz-Einstellungen verändern.

        <h5>13. Facebook</h5>

        Auf unseren Webseiten werden Programme (Social Plug-ins) des sozialen Netzwerks Facebook eingesetzt. Diese werden ausschließlich von der Facebook Inc. 1601 S. California Ave - Palo Alto - CA 94304 – USA, betrieben. Die Plug-ins können Sie daran erkennen, dass sie mit dem entsprechenden Logo gekennzeichnet sind.
        Über diese Plugins werden unter Umständen Informationen, zu denen auch personenbezogene Daten gehören können, an den Dienstebetreiber gesendet und ggf. von diesem genutzt. Wir verhindern die unbewusste und ungewollte Erfassung und Übertragung von Daten an den Diensteanbieter durch eine 2-Klick-Lösung. Um ein gewünschtes Social Plug-in zu aktivieren, muss dieses erst durch Klick auf den entsprechenden Schalter aktiviert werden. Erst durch diese Aktivierung des Plug-ins wird auch die Erfassung von Informationen und deren Übertragung an den Diensteanbieter ausgelöst. Wir erfassen selbst keine personenbezogenen Daten mittels der Social Plug-ins oder über deren Nutzung.
        Wir haben keinen Einfluss darauf, welche Daten ein aktiviertes Plugin erfasst und wie diese durch den Anbieter verwendet werden. Derzeit muss davon ausgegangen werden, dass eine direkte Verbindung zu den Diensten des Anbieters ausgebaut wird sowie mindestens die IP-Adresse und gerätebezogene Informationen erfasst und genutzt werden. Ebenfalls besteht die Möglichkeit, dass die Diensteanbieter versuchen, Cookies auf dem verwendeten Rechner zu speichern. Welche konkreten Daten hierbei erfasst und wie diese genutzt werden, entnehmen Sie bitte den Datenschutzhinweisen des jeweiligen Diensteanbieters. Hinweis: Falls Sie zeitgleich bei Facebook angemeldet sind, kann Facebook Sie als Besucher einer bestimmten Seite identifizieren.

        <h5>14. Google AdWords</h5>

        Unsere Webseite nutzt das Google Conversion-Tracking. Sind Sie über eine von Google geschaltete Anzeige auf unsere Webseite gelangt, wird von Google Adwords ein Cookie auf Ihrem Rechner gesetzt. Das Cookie für Conversion-Tracking wird gesetzt, wenn ein Nutzer auf eine von Google geschaltete Anzeige klickt. Diese Cookies verlieren nach 30 Tagen ihre Gültigkeit und dienen nicht der persönlichen Identifizierung. Besucht der Nutzer bestimmte Seiten unserer Website und das Cookie ist noch nicht abgelaufen, können wir und Google erkennen, dass der Nutzer auf die Anzeige geklickt hat und zu dieser Seite weitergeleitet wurde. Jeder Google AdWords-Kunde erhält ein anderes Cookie. Cookies können somit nicht über die Websites von AdWords-Kunden nachverfolgt werden. Die mithilfe des Conversion-Cookies eingeholten Informationen dienen dazu, Conversion-Statistiken für AdWords-Kunden zu erstellen, die sich für Conversion-Tracking entschieden haben. Die Kunden erfahren die Gesamtanzahl der Nutzer, die auf ihre Anzeige geklickt haben und zu einer mit einem Conversion-Tracking-Tag versehenen Seite weitergeleitet wurden. Sie erhalten jedoch keine Informationen, mit denen sich Nutzer persönlich identifizieren lassen.
        Möchten Sie nicht am Tracking teilnehmen, können Sie das hierfür erforderliche Setzen eines Cookies ablehnen – etwa per Browser-Einstellung, die das automatische Setzen von Cookies generell deaktiviert oder Ihren Browser so einstellen, dass Cookies von der Domain „googleleadservices.com“ blockiert werden.
        Bitte beachten Sie, dass Sie die Opt-out-Cookies nicht löschen dürfen, solange Sie keine Aufzeichnung von Messdaten wünschen. Haben Sie alle Ihre Cookies im Browser gelöscht, müssen Sie das jeweilige Opt-out Cookie erneut setzen.

        <h5>15. Digitale Signatur (E-Signature) mit DocuSign</h5>

        Für die digitale Unterzeichnung von Mietverträgen und Mietvertragsverlängerungen nutzen wir DocuSign eSignature von DocuSign. Anbieter ist die DocuSign Inc. 221 Main Street, Suite 1550, San Francisco, CA 94105, USA. Die Nutzung von DocuSign dient unserem berechtigten Interesse, den Prozess der rechtsgültigen Unterzeichnung von Verträgen und Dokumenten durch die Nutzung einer elektronischen Signatur zu vereinfachen und zu beschleunigen. Rechtsgrundlage für die Verarbeitung Ihrer personenbezogenen Daten ist Art. 6 Abs.1 lit f) DSGVO. DocuSign ist als Auftragsverarbeiter von City-Residence GmbH tätig. Zum Schutz Ihrer Daten haben wir eine Auftragsverarbeitungsvereinbarung nach Art. 28 DSGVO geschlossen. Bei der Bereitstellung des Dienstes kann eine Weitergabe personenbezogener Daten in die USA nicht ausgeschlossen werden. DocuSign garantiert als Datenverarbeiter verbindliche interne Datenschutzvorschriften (Binding Corporate Rules-BCR). Die nach Art. 46 Abs. 1 DSGVO erforderlichen geeigneten Garantien für die Datenübermittlung in ein Drittland stellt DocuSign sicher durch die behördlich genehmigten BCR gem. Art. 46 Abs. 2 lit. b) i.V.m. Art. 47 DSGVO sicher.  (Siehe: https:/www.docusign.com/trust/privacy/bcrp-privacy-code) Weitere Informationen zum Datenschutz in Bezug auf DocuSign finden Sie unter  https://www.docusign.com/de-de/datenschutzerklaerung/datenschutz

         

        <h5>16. Newsletter</h5>

        Wir nutzen die personenbezogenen Daten unserer Anbieter auch, um Sie über die aktuellen Marktentwicklungen (Marktbericht) und Neuerungen zu informieren. Die Einwilligung zum Versand des Newsletters können Sie jederzeit widerrufen. In jedem Newsletter findet sich dazu ein entsprechender Link.

        <h5>17. Links zu anderen Websites</h5>

        Unser Online-Angebot enthält Links zu anderen Websites. Wir haben keinen Einfluss darauf, dass deren Betreiber die Datenschutzbestimmungen einhalten.

        <h5>18. Datenschutzbeauftragte</h5>

        Gesetzlich vorgeschriebene Datenschutzbeauftragte ist:

        Dipl.-Volkswirtin Iris Anders
        Kontakt: datenschutz@city-residence.de

        <h5>19. Fragen und Kommentare</h5>

        Für Fragen, Anregungen oder Kommentare zum Thema Datenschutz wenden Sie sich bitte per E-Mail an unseren Datenschutzbeauftragten datenschutz@city-residence.de (siehe oben).
        Wir behalten uns vor, diese Datenschutzerklärung gelegentlich anzupassen, damit sie stets den aktuellen rechtlichen Anforderungen entspricht oder um Änderungen unserer Leistungen in der Datenschutzerklärung umzusetzen, z. B. bei der Einführung neuer Services. Für Ihren erneuten Besuch gilt dann die neue Datenschutzerklärung.
        (Diese Datenschutzerklärung wurde mit dem Datenschutzerklärungs-Generator der activeMindAG erstellt) 

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
            [
                'id' => 8,
                'text_type' => 'TOS',
                'text_content' => $tos,
            ],
            [
                'id' => 9,
                'text_type' => 'PRIVACY_POLICY',
                'text_content' => $privacyPolicy,
            ],
        ];
        foreach ($textEntries as $entry) {
            DB::table('texts')->insert($entry);
        }
    }
}
