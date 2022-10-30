<?php
require "vendor/autoload.php";

include_once "install/index.php";

CModule::AddAutoloadClasses(
    Vasqo_Rest::getModuleName(),
    [
        "Vasqo_Rest" => "lib/module.php",
    ]
);