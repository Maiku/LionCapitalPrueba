<?php

namespace App\Models\Catalogs;

use App\Utils\TableGetColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Neighborhood extends Model
{
    use SoftDeletes, TableGetColumn;
    const TABLE_DB = 'neighborhoods';
    protected $table = self::TABLE_DB;
    public const ID = 'id';
    public const NAME = 'name';

    protected $casts = [
        self::ID => 'integer',
        self::NAME => 'string',
    ];

    protected $fillable = [
        self::NAME
    ];
}
