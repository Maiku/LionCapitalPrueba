<?php

namespace App\Models\Catalogs;

use App\Utils\TableGetColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use SoftDeletes, TableGetColumn;
    const TABLE_DB = 'zones';
    protected $table = self::TABLE_DB;
    public const ID = 'id';
    public const NAME = 'name';
    public const TYPE = 'type';

    protected $casts = [
        self::ID => 'integer',
        self::NAME => 'string',
        self::TYPE => 'integer'
    ];

    protected $fillable = [
        self::NAME
    ];
}
