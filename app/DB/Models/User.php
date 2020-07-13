<?php

namespace App\DB\Models;

/**
 * Class User
 * @package App\DB\Models
 */
class User extends BaseModel
{
    static function getTableName(): string
    {
        return 'users';
    }
}