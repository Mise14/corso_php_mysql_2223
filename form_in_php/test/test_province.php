<?php
# php form_in_php/test/test_province.php

use Registry\it\Provincia;

require "../config.php";
require "./form_in_php/class/Registry/it/Provincia.php";


$province = Provincia::all();

print_r($province);