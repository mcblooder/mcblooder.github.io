<?php
function html($markup, $newLine = true) {
    echo $markup;
    if ($newLine)
        echo "\n";
}

function cmp($a, $b)
{
    return $a["val"] > $b["val"];
}

function pprintFlatArr($arr, $title = null) {
    if ($title) {
        html("<br><p>" . $title . "</p><br>\n");
    }
    html("<table>");
    html("<tr>");
    for ($i = 0; $i < count($arr); ++$i) {
        html("<td>" . print_r($arr[$i], true) . "</td>");
    }
    html("</tr>");
    html("</table>");
}

function pprintArr($arr, $title = null) {
    if ($title) {
        html("<br><p>" . $title . "</p><br>\n");
    }
    html("<table>");
    for ($i = 0; $i < count($arr); ++$i) {
        html("<tr>");
        for ($j = 0; $j < count($arr[$i]); ++$j) {
            html("<td>" . $arr[$i][$j] . "</td>");
        }
        html("</tr>");
    }
    html("</table>");
}

?>