<?php
function get_start_text_from_date($start_date)
{
    $today = date('Y-m-d');
    if ($start_date > $today) {
        // TODO: Make this German.
        return $start_date;
    } else {
        return 'sofort';
    }
}

function get_euro_text($rent)
{
    return number_format((float)$rent, 0, ',', '.') . ' EUR';
}

function get_offer_limitations_text($offer)
{
    $limitations_array = [];
    $persons_noun = $offer->number_of_persons == 1 ? ' Person' : ' Personen';
    if (!empty($offer->number_of_persons))
        $limitations_array[] = 'max. ' . $offer->number_of_persons . $persons_noun;
    if (!$offer->smoking_ok)
        $limitations_array[] = 'nur an Nichtraucher';

    return implode(', ', $limitations_array);
}

// TODO: Thisn needs to be refactored
function extract_german_apartment_specials($apartment_specials)
{
    $apartment_specials = json_decode($apartment_specials, true);

    if (empty($apartment_specials))
        return [];

    foreach ($apartment_specials as $specials_entry) {
        // TODO: For now, just using the German ones,
        // but this needs to be refactored.
        $ret_arr[] = $specials_entry["1"];
    }
    return $ret_arr;
}

function php_array_to_ul_elem($php_array)
{
    if (empty($php_array))
        return '<ul></ul>';

    $ret_html = "<ul>";
    foreach ($php_array as $txt) {
        $ret_html .= "<li>$txt</li>";
    }
    $ret_html .= "</ul>";
    return $ret_html;
}

function get_house_info_text($house_obj)
{
    $house_info_array = [];
    if (!empty($house_obj->house_description) && !empty($house_obj->house_type)) {
        $house_info_array[] = "$house_obj->house_description $house_obj->house_type";
    }
    if (!empty($house_obj->year_of_construction)) {
        $house_info_array[] = "Bj. $house_obj->year_of_construction";
    }
    return implode(', ', $house_info_array);
}

function get_living_room_text($apartment_obj)
{
    $ret_txt = '';
    $ret_txt .= $apartment_obj->living_room_description
        . ' ' . $apartment_obj->living_room_type;
    $living_room_contents = json_decode($apartment_obj->living_room_contents);
    if (!empty($living_room_contents)) {
        $ret_txt .= ' mit ' . implode(', ', $living_room_contents);
    }
    return $ret_txt;
}

// TODO: This will be refactored. See Feature #972.
function get_security_deposit_text($deposit_val, $deposit_type)
{
    switch ($deposit_type) {
        case 'FREE_TEXT':
        default:
            return $deposit_val;
        case 'EURO_AMOUNT':
            return get_euro_text($deposit_val);
        case 'MONTHLY_RENTS':
            return "$deposit_val Monatsmieten";
    }
}

function get_public_transit_uls($public_transit_json)
{
    $ret_html = '<p class="border-bottom">U-Bahn:</p>';
    $ret_html .= "<ul>";
    $public_transit_array = json_decode($public_transit_json, true);
    $subway_array = $public_transit_array['subway'] ?? [];
    foreach ($subway_array as $station => $distance) {
        $ret_html .= "<li>Haltestelle \"$station\" ($distance)</li>"; 
    }
    $ret_html .= "</ul>";
    $ret_html .= '<p class="border-bottom">S-Bahn:</p>';
    $ret_html .= '<small>Die ETL-Pipeline liefert in ihrer aktuellen Version (cr-legacy-to-json-0.2) keine Daten zu den S-Bahnen. In einer zukünftigen Version sollen diese allerdings ebenfalls zur Verfügung stehen. Siehe <a href="https://redmine.city-residence.de/issues/1138">Feature #1138</a></small>';
    return $ret_html;
}

function get_parking_situation_text($parking_rating)
{
    switch ($parking_rating) {
        case 6:
        case 5:
            return 'Exzellente Parkmöglichkeiten';
        case 4:
            return 'Gute Parkmöglichkeiten';
        case 3:
            return 'Parkmöglichkeiten auf der Straße';
        case 2:
        case 1:
            return 'Geringe Parkmöglichkeiten auf der Straße';
        default:
            return '';
    }
}

function get_points_of_interest_ul($poi_json)
{
    $ret_html = "<ul>";
    $poi_array = json_decode($poi_json, true);
    if (empty($poi_array))
        $poi_array = [];
    foreach ($poi_array as $poi_entry ) {
        if (isset($poi_entry['sub'])) {
            $ret_html .= "<li>{$poi_entry['sub']}";
            if (isset($poi_entry['dist'])) {
                $ret_html .= " ({$poi_entry['dist']})";
            }
            $ret_html .= "</li>";
        }
    }
    $ret_html .= "</ul>";
    return $ret_html;
}

function get_current_month_options($number_of_months = 2)
{
    $today = date('Y-m-d');
    $current_month = (int)explode('-', $today)[1];
    $current_year = (int)explode('-', $today)[0];
    $ret_html = sprintf('<option value="%s">sofort</option>', $today);
    for ($i = 0; $i < $number_of_months; ++$i) {
        ++$current_month;
        $month_translations = [
            1  => 'Januar',
            2  => 'Februar',
            3  => 'März',
            4  => 'April',
            5  => 'Mai',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'August',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Dezember',
        ];
        $ret_html .= sprintf(
            '<option value="%s">%s</option>',
            // TODO: You have until 2025 to improve this...
            "$current_year-$current_month-01",
            $i == $number_of_months - 1 ? 'später' : $month_translations[$current_month]
        );
    }
    return $ret_html;
}

function make_select_html($name, $options,
    $selectedValue = null, $classes = null, $id = null, $other_attributes = null)
{
    $ret_html = sprintf(
        '<select name="%s"%s%s%s>',
        $name,
        $classes ? ' class="' . implode(' ', $classes) . '"' : '',
        $id ? ' id="' . $id . '"' : '',
        $other_attributes ? ' ' . implode(' ', $other_attributes) : ''
    );

    foreach ($options as $value => $prettyText) {
        $ret_html .= sprintf(
            '<option%s%s>%s</option>',
            $value != $prettyText ? ' value="' . $value . '"' : '',
            $selectedValue && $selectedValue == $value ? ' selected' : '',
            $prettyText
        );
    }
    $ret_html .= '</select>';

    return $ret_html;
}

function make_checkbox($name, $label_text, $checked = false, $id = null)
{
    if ($id === null)
        $id = $name;

    if ($checked)
        $checked = ' checked';
    else
        $checked = '';

    return <<<EOF
    <input type="checkbox" id="$id" name="$name"$checked>
    <label for="$id">$label_text</label>
EOF;
}
