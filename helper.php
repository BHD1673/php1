<?php 
function pre_dump($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}