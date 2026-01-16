<?php

namespace App\Models\Main;

use App\Models\Catalogs\Municipality;
use App\Utils\TableGetColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class Property extends Model
{
    use HasFactory, SoftDeletes, TableGetColumn;
    const TABLE_DB = 'properties';
    protected $table = self::TABLE_DB;
    public const ID = 'id'; // ID de la propiedad
    public const ULID = 'ulid'; // Identificador único (usar como id en respuestas)
    public const INTERN_REFERENCE = 'intern_reference'; // Referencia interna única
    public const TITLE = 'title'; // Título de la propiedad
    public const STREET = 'street'; // Calle
    public const NUMBER = 'number'; // Número
    public const ZIP_CODE = 'zip_code'; // Código postal
    public const IS_ACTIVE = 'is_active'; // Si la propiedad está activa
    public const IS_SELL = 'is_sell'; // Si está en venta
    public const IS_RENT = 'is_rent'; // Si está en alquiler
    public const SELL_PRICE = 'sell_price'; // Precio de venta
    public const RENTAL_PRICE = 'rental_price'; // Precio de alquiler
    public const BUILT_M2 = 'built_m2'; // Superficie construida (usar para surface_m2 en respuesta)
    public const OFFICE_ID = 'office_id'; // ID de la oficina
    public const PROPERTY_TYPE_ID = 'property_type_id'; // ID del tipo de propiedad
    public const USER_ID = 'user_id'; // ID del agente principal
    public const SECONDARY_USER_ID = 'secondary_user_id'; // ID del agente secundario
    public const NEIGHBORHOOD_ID = 'neighborhood_id'; // ID del barrio
    public const DISTRICT_ID = 'district_id'; // ID del distrito
    public const MUNICIPALITY_ID = 'municipality_id'; // ID del municipio
    public const REGION_ID = 'region_id'; // ID de la región/comarca
    public const LOCATION_ID = 'location_id'; // ID de la provincia
    public const ZONE_ID = 'zone_id'; // ID de la provincia

    protected $casts = [
        self::ID => 'integer',
        self::ULID => 'string',
        self::INTERN_REFERENCE => 'string',
        self::TITLE => 'string',
        self::STREET => 'string',
        self::NUMBER => 'string',
        self::ZIP_CODE => 'string',
        self::IS_ACTIVE => 'boolean',
        self::IS_SELL => 'boolean',
        self::IS_RENT => 'boolean',
        self::SELL_PRICE => 'decimal:2',
        self::RENTAL_PRICE => 'decimal:2',
        self::BUILT_M2 => 'decimal:2',
        self::OFFICE_ID => 'integer',
        self::PROPERTY_TYPE_ID => 'integer',
        self::USER_ID => 'integer',
        self::SECONDARY_USER_ID => 'integer',
        self::NEIGHBORHOOD_ID => 'integer',
        self::DISTRICT_ID => 'integer',
        self::MUNICIPALITY_ID => 'integer',
        self::REGION_ID => 'integer',
        self::LOCATION_ID => 'integer',
        self::ZONE_ID => 'integer',
    ];

    protected $fillable = [
        self::ULID,
        self::INTERN_REFERENCE,
        self::TITLE,
        self::STREET,
        self::NUMBER,
        self::ZIP_CODE,
        self::IS_ACTIVE,
        self::IS_SELL,
        self::IS_RENT,
        self::SELL_PRICE,
        self::RENTAL_PRICE,
        self::BUILT_M2,
        self::OFFICE_ID,
        self::PROPERTY_TYPE_ID,
        self::USER_ID,
        self::SECONDARY_USER_ID,
        self::NEIGHBORHOOD_ID,
        self::DISTRICT_ID,
        self::MUNICIPALITY_ID,
        self::REGION_ID,
        self::LOCATION_ID,
        self::ZONE_ID
    ];

    /**
     * Devuelve una expresión DB::raw para construir el campo address
     * concatenando street, number y zip_code.
     */
    public static function fullAddress(): Expression
    {
        return DB::raw(
            "CONCAT_WS(' ', " . self::getColumn(self::STREET) . ", " .
            "CONCAT(" . self::getColumn(self::NUMBER) . ", '') , " .
            self::getColumn(self::ZIP_CODE) . ") as address"
        );
    }

    /**
     * Devuelve una expresión DB::raw para un campo price dinámico.
     *
     * - Si $operationType === 'rent'  -> rental_price
     * - Si $operationType === 'sale' -> sell_price
     * - Si es null, decide según is_rent / is_sell
     */
    public static function priceSelect(?string $operationType = null): Expression
    {

        if ($operationType === 'rent') {
            $sql =  self::getColumn(self::RENTAL_PRICE) . " as price";
        } elseif ($operationType === 'sale') {
            $sql = self::getColumn(self::SELL_PRICE) . " as price";
        } else {
            $sql = "CASE "
                . "WHEN  ". self::getColumn(self::IS_RENT) . " = 1 THEN " . self::RENTAL_PRICE . " "
                . "WHEN  ". self::getColumn(self::IS_SELL) . " = 1 THEN " . self::SELL_PRICE . " "
                . "ELSE NULL END as price";
        }

        return DB::raw($sql);
    }
}
