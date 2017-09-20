<?php

namespace App;
use App\Database\Setup;
use Exception;

require_once __DIR__.'/App/Database/Setup.php';

try {
    Setup::insertDumpData();
} catch (Exception $exception) {
    echo $exception->getMessage();
}