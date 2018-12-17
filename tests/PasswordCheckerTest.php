<?php

use PHPUnit\Framework\TestCase;
use Erasys\Services\PasswordChecker;
use Erasys\Services\YamlParser;
use Dotenv\Dotenv;

final class PasswordCheckerTest extends TestCase
{
    public function testValidPasswords(): void
    {
        $checker = $this-> createChecker();

        $validPasswords = [
            'ahadAad4',
            'Test123!',
            'Kb6nHesCIA==',
            'Fzey3LiX983izD1sxw==',
            'dilmaroussef<3',
        ];

        foreach ($validPasswords as $password) {
            $this->assertTrue($checker->checkPassword($password));
        }
    }

    public function testInvalidPasswords(): void
    {
        $checker = $this-> createChecker();

        $invalidPasswords = [
            'aaa',
            'test',
            'password',
            'DELETE * FROM validators.passwords',
            'meh',
            'rm -rf .',
            '\n',
            '+7wo',
            'jairbolsonaro',
        ];

        foreach ($invalidPasswords as $password) {
            $this->assertFalse($checker->checkPassword($password));
        }

    }

    private function createChecker()
    {
        $dotenv = new Dotenv(__DIR__.'/../');
        $dotenv->load();

        $rules = YamlParser::parseRulesFile(getenv('RULES_FILE_PATH'));
        $checker = new PasswordChecker($rules);

        return $checker;
    }
}
