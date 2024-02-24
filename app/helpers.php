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
    foreach ($apartment_specials as $specials_entry) {
        // TODO: For now, just using the German ones,
        // but this needs to be refactored.
        $ret_arr[] = $specials_entry["1"];
    }
    return $ret_arr;
}

function php_array_to_ul_elem($php_array)
{
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
    foreach ($public_transit_array['subway'] as $station => $distance) {
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
