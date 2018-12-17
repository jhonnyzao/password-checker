<?php

namespace Erasys\Services;

class PasswordChecker
{
    private $rules;

    public function __construct($rules)
    {
        $this->rules = $rules;
    }

    /**
     * Checks if a password is valid given a password
     * @param string $password the password
     *
     * @return bool
     */
    public function checkPassword(string $password): bool
    {
        foreach ($this->rules as $rule) {
            $pattern = sprintf("/%s/", $rule['pattern']);

            $result = preg_match($pattern, $password);
            if (empty($result)) {
                fwrite(STDOUT, sprintf("Password %s is invalid: %s\n", $password, $rule['errMessage']));

                return false;
            }
        }

        fwrite(STDOUT, sprintf("Password %s is valid!\n", $password));

        return true;
    }
}
