<?php
function get_euro_text($rent)
{
    return number_format((float)$rent, 0, ',', '.') . ' EUR';
}

function php_array_to_ul_elem(
    $php_array,
    $ulCssClasses = null,
    $liCssClasses = null,
    $ulOtherAttributes = null)
{
    if (empty($php_array))
        return '<ul></ul>';

    $ret_html = sprintf(
        '<ul %s %s>',
        empty($ulCssClasses)
            ? ''
            : sprintf(
                ' class="%s"',
                implode(' ', $ulCssClasses)
            ),
        empty($ulOtherAttributes)
            ? ''
            : implode(' ', $ulOtherAttributes)
    );

    foreach ($php_array as $txt) {
        $ret_html .= sprintf(
            '<li %s>%s</li>',
            empty($liCssClasses)
                ? ''
                : sprintf(
                    ' class="%s"',
                    implode(' ', $liCssClasses)
                ),
            $txt
        );
    }
    $ret_html .= '</ul>';
    return $ret_html;
}

function get_current_months($number_of_months = 3)
{
    $formatter = new \IntlDateFormatter(
        'de-DE',
        \IntlDateFormatter::SHORT,
        \IntlDateFormatter::NONE,
        'Europe/Berlin',
        \IntlDateFormatter::GREGORIAN,
        'MMMM'
    );

    $ret_arr = ['' => 'sofort'];

    for ($i = 1; $i < $number_of_months; ++$i) {
        $date_array_key = date(
            'Y-m-01',
            strtotime(
                sprintf(
                    '+%s months',
                    $i
                )
            )
        );
        $pretty_date_value = $i == $number_of_months - 1
            ? 'später'
            : $formatter->format(new \DateTime($date_array_key));

        $ret_arr[$date_array_key] = $pretty_date_value;
    }

    return $ret_arr;
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

function make_checkbox($name, $label_text, $checked = false, $id = null, $other_properties = null)
{
    if ($id === null)
        $id = $name;

    if ($checked)
        $checked = ' checked';
    else
        $checked = '';

    return <<<EOF
    <input type="checkbox" id="$id" name="$name"$checked $other_properties>
    <label for="$id">$label_text</label>
EOF;
}

function format_date($date, $locale = 'de-DE')
{
    switch ($locale) {
        case 'de-DE':
        default:
            $format = 'dd.MM.yyyy';
            break;
    }
    $formatter = new \IntlDateFormatter(
        $locale,
        \IntlDateFormatter::SHORT,
        \IntlDateFormatter::NONE,
        'Europe/Berlin',
        \IntlDateFormatter::GREGORIAN,
        $format
    );
    return $formatter->format(new \DateTime($date));
}
