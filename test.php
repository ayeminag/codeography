<?php

require "./vendor/autoload.php";

use Codeography\Utils\AutoInitializer;

$autoinit = new AutoInitializer;

$generator = $autoinit->build('Codeography\Generators\Generator');
$options = ["attributes" => "name:public email:protected", "methods" => "getEmail:public saySomething:public"];

$generator->generate("Models\Person", $options);