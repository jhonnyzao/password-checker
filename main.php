<?php

require_once __DIR__.'/vendor/autoload.php';

use Dotenv\Dotenv;
use Erasys\Services\YamlParser;
use Erasys\Services\PasswordChecker;
use Erasys\Models;
use Config\Database;

$dotenv = new Dotenv(__DIR__.'/');
$dotenv->load();

$rules = YamlParser::parseRulesFile(getenv('RULES_FILE_PATH'));
$checker = new PasswordChecker($rules);

$db = Database::createDbInstance(
    getenv('DATABASE_HOST'),
    getenv('DATABASE_NAME'),
    getenv('DATABASE_USER'),
    getenv('DATABASE_PASSWORD')
);


// if there was a param in command line
if (isset($argv[1])) {
    $result = $checker->checkPassword($argv[1]);
} else {
    $passwordModel = new Models\Password($db);
    $passwords = $passwordModel->fetchAll();

    foreach ($passwords as $password) {
        if ($checker->checkPassword($password['password'])) {
            $passwordModel->approvePassword($password);
        }
    }
}
