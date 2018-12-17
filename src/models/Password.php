<?php

namespace Erasys\Models;

use Erasys\Models\BasePasswordModel;

class Password extends BasePasswordModel
{
    /**
     * Sets 'valid' fiels in passwords table to true
     * @param associative array password
     *  $id int password unique identifier
     *  $password string password value
     *  $valid bool flags validity of password
     * @return bool
     */

    public function approvePassword($password): bool
    {
        $queryValues = [
            'password' => $password['password'],
            'valid' => 1
        ];

        return $this->update($queryValues, $password['id']);
    }
}
