<?php

include_once 'aircraft.php';

$viggen = new interceptor(100, 200, 300, "viggen", 400);
$viggen->texaco();

print_r($viggen);
echo "</br>";

$b52 = new bomber(100, 200, 300, "b52", 400);
$b52->texaco();

print_r($b52);
echo "</br>";
