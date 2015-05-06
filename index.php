<?php

require_once('vendor/autoload.php');

$cl=new colourLovers\ColourLovers;

$test=$cl->get_palette()->getRandomPalette();

foreach( $test->getColorsSorted() as $color ){
    echo '<div style="width:100px; height:100px; background:#' . $color . '" ></div>';
}

?>
