<?php
function vd($param, $notDie = true, $printR = false)
{
    if ($printR) {
        print_r('<pre>');
        print_r($param);
    } else {
        var_dump($param);
    }
    if ($notDie) {
        echo '</br>';
    } else {
        die('</br>');
    }
}
