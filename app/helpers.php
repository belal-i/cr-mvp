<?php
function get_euro_text($rent)
{
    return number_format((float)$rent, 0, ',', '.') . ' EUR';
}

function php_array_to_ul_elem($php_array, $ulCssClasses = [], $liCssClasses = [])
{
    if (empty($php_array))
        return '<ul></ul>';

    $ret_html = sprintf(
        '<ul%s>',
        empty($ulCssClasses)
        ? ''
        : sprintf(
            ' class="%s"',
            implode(' ', $ulCssClasses)
        )
    );
    foreach ($php_array as $txt) {
        $ret_html .= sprintf(
            '<li%s>%s</li>',
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

function get_current_months($number_of_months = 2)
{
    $today = date('Y-m-d');
    $current_month = (int)explode('-', $today)[1];
    $current_year = (int)explode('-', $today)[0];
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
    $ret_arr = [
        '' => 'sofort',
    ];
    for ($i = 0; $i < $number_of_months; ++$i) {
        ++$current_month;
        $ret_arr[
            // TODO: You have until 2025 to improve this...
            sprintf('%s-%s-01', $current_year, $current_month)
        ] = $i == $number_of_months - 1 ? 'später' : $month_translations[$current_month];
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
