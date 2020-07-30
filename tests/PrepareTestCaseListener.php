<?php

use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;

class PrepareTestCaseListener implements TestListener
{
    use TestListenerDefaultImplementation;

    public function __destruct()
    {
        if (TestCase::$migrateRollbackWhenTearDown) {
            echo "Prepare Reset Migrate......" . PHP_EOL;
            static::callArtisan('migrate:reset');
            echo "Reset Migrate Done" . PHP_EOL;
        }
    }

    public function __construct()
    {
        echo "Prepare Migrate Database......" . PHP_EOL;
        static::callArtisan('migrate');
        echo "Migrate Database Done" . PHP_EOL;
    }

    public static function callArtisan($command)
    {
        putenv('APP_ENV=testing');
        Facade::clearResolvedInstances();
        $app = require __DIR__ . '/../bootstrap/app.php';
        $app['Illuminate\Contracts\Console\Kernel']->call($command);
    }

}