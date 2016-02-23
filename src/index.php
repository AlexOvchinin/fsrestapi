<?php

try {
    $application = require_once __DIR__ . "/app.php";

    echo $application->handle()->getContent();
} catch (Exception $ex) {
    echo "Exception: " . $ex->getMessage();
}
