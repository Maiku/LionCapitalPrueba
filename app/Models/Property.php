<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;
    public const ID = 'id';
    public const ULID = 'ulid';
    public const INTERN_REFERENCE = 'intern_reference';
    public const TITLE = 'title';
    public const STREET = 'street';
    public const NUMBER = 'number';
    public const ZIP_CODE = 'zip_code';
    public const IS_ACTIVE = 'is_active';
    public const IS_SELL = 'is_sell';
    public const IS_RENT = 'is_rent';
    public const SELL_PRICE = 'sell_price';
    public const RENTAL_PRICE = 'rental_price';
    public const BUILT_M2 = 'built_m2';
    public const OFFICE_ID = 'office_id';
    public const PROPERTY_TYPE_ID = 'property_type_id';
    public const USER_ID = 'user_id';
    public const SECONDARY_USER_ID = 'secondary_user_id';
    public const NEIGHBORHOOD_ID = 'neighborhood_id';
    public const DISTRICT_ID = 'district_id';
    public const MUNICIPALITY_ID = 'municipality_id';
    public const REGION_ID = 'region_id';
    public const LOCATION_ID = 'location_id';
    public const CREATED_AT = 'created_at';
}
