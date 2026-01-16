<?php

namespace App\Models\Main;

use App\Utils\TableGetColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operations extends Model
{
    use SoftDeletes, TableGetColumn;
    const TABLE_DB = 'operations';
    protected $table = self::TABLE_DB;

    // Campos
    public const ID = 'id';
    public const TYPE = 'type';            // 'sale' | 'rent'
    public const STATUS = 'status';        // 'open' | 'closed'
    public const OPERATION_DATE_START = 'operation_date_start';
    public const OPERATION_DATE_END = 'operation_date_end';
    public const PROPERTY_ID = 'property_id';

    protected $casts = [
        self::ID => 'integer',
        self::TYPE => 'string',
        self::STATUS => 'string',
        self::PROPERTY_ID => 'integer',
        self::OPERATION_DATE_START => 'datetime',
        self::OPERATION_DATE_END => 'datetime',
    ];

    protected $fillable = [
        self::TYPE,
        self::STATUS,
        self::OPERATION_DATE_START,
        self::OPERATION_DATE_END,
        self::PROPERTY_ID,
    ];
}
