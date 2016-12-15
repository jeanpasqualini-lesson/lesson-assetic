<?php

error_log('Symfony certification do not support the component', E_USER_DEPRECATED);

require __DIR__."/vendor/autoload.php";

$tests = array(
    new \Test\MainTest()
);

foreach ($tests as $test) {
    echo "===".get_class($test)."===".PHP_EOL;

    $test->runTest();
}
