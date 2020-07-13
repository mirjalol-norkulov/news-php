<?php

namespace App\DB\Models;

/**
 * Class News
 */
class News extends BaseModel
{
    static function getTableName(): string
    {
        return 'news';
    }
}