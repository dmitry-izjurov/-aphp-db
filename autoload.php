<?php

declare(strict_types=1);

function autoload($classname)
{
    $filename= "./". $classname .".php";
    require_once($filename);
}

spl_autoload_register('autoload');