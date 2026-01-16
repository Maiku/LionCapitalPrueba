<?php

namespace App\CRM\Properties\Queries;

use App\Models\Catalogs\Office;
use App\Models\Catalogs\PropertyType;
use App\Models\Catalogs\Zone;
use App\Models\Catalogs\ZoneType;
use App\Models\Main\Operations;
use App\Models\Main\Property;
use App\Shared\Properties\PropertyBaseQuery;
use Illuminate\Contracts\Database\Eloquent\Builder;

final class AvailablePropertiesQuery extends PropertyBaseQuery
{
    /*
     * QUERY EXCLUSIVA PARA EL SERVICIO
     * */
    public function query($filters): Builder  {
        $operationType = $filters['operation_type'] ?? null;
        return parent::base($filters)
            ->leftJoin(Operations::TABLE_DB, Property::getColumn(Property::ID),'=',Operations::getColumn(Operations::PROPERTY_ID))
            ->where(Operations::STATUS,'<>', 'closed')
            ->orderBy(Property::getColumn(Property::CREATED_AT),'DESC')
            ->where(Property::getColumn(Property::IS_ACTIVE), true)
            ->select([
                Property::getColumn(Property::ID),
                Property::getColumn(Property::ULID),
                Property::getColumn(Property::INTERN_REFERENCE),
                Property::getColumn(Property::TITLE),
                Property::fullAddress(),
                Property::getColumn(Property::PROPERTY_TYPE_ID),
                PropertyType::getColumn(PropertyType::NAME,'property_type_name'),
                ZoneType::getColumn(ZoneType::NAME,'zone_type_name'),
                Zone::getColumn(Zone::ID,'zone_id'),
                Zone::getColumn(Zone::NAME,'zone_name'),
                Property::getColumn(Property::BUILT_M2),
                Property::priceSelect($operationType),
                Property::getColumn(Property::IS_SELL),
                Property::getColumn(Property::IS_RENT),
                Office::getColumn(Office::ID,'office_id'),
                Office::getColumn(Office::NAME,'office_name'),
                Operations::getColumn(Operations::TYPE),
                'main_agent.name as main_agent_name',
                'main_agent.id as main_agent_id',
                Property::getColumn(Property::CREATED_AT),
            ]);
    }
}
