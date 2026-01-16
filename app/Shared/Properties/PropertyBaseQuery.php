<?php

namespace App\Shared\Properties;

use App\Models\Catalogs\District;
use App\Models\Catalogs\Location;
use App\Models\Catalogs\Municipality;
use App\Models\Catalogs\Neighborhood;
use App\Models\Catalogs\Office;
use App\Models\Catalogs\PropertyType;
use App\Models\Catalogs\Region;
use App\Models\Catalogs\Zone;
use App\Models\Catalogs\ZoneType;
use App\Models\Main\Operations;
use App\Models\Main\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PropertyBaseQuery
{
    /**
     * Query base para propiedades
     */
    /**
     * Filtros comunes (precio, operación, localización, etc.).
     *
     * Recibe los filtros "de alto nivel" del request:
     * - property_type_id, office_id
     * - zone_type + zone_id
     * - operation_type (sale|rent)
     * - min_price / max_price (interpretados según operation_type)
     * - min_surface_m2 / max_surface_m2
     * - search
     *
     * @param  Builder  $query
     * @param array<string, mixed> $filters
     */
    public function base(array $filters = []): Builder
    {
        $query =  Property::query();

        //Instanciamos relaciones del modelo.
        $query->leftJoin(PropertyType::TABLE_DB, Property::getColumn(Property::PROPERTY_TYPE_ID),'=',PropertyType::getColumn(PropertyType::ID));
        $query->leftJoin('users as main_agent', 'main_agent.id', '=', Property::TABLE_DB.'.'.Property::USER_ID);
        $query->leftJoin('users as secondary_agent', 'secondary_agent.id', '=', Property::TABLE_DB.'.'.Property::SECONDARY_USER_ID);
        $query->leftJoin(Neighborhood::TABLE_DB, Property::getColumn(Property::NEIGHBORHOOD_ID),'=',Neighborhood::getColumn(Neighborhood::ID));
        $query->leftJoin(District::TABLE_DB, Property::getColumn(Property::DISTRICT_ID),'=',District::getColumn(District::ID));
        $query->leftJoin(Municipality::TABLE_DB, Property::getColumn(Property::MUNICIPALITY_ID),'=',Municipality::getColumn(Municipality::ID));
        $query->leftJoin(Region::TABLE_DB, Property::getColumn(Property::REGION_ID),'=',Region::getColumn(Region::ID));
        $query->leftJoin(Location::TABLE_DB, Property::getColumn(Property::LOCATION_ID),'=',Location::getColumn(Location::ID));
        $query->leftJoin(Office::TABLE_DB, Property::getColumn(Property::OFFICE_ID),'=',Office::getColumn(Office::ID));
        $query->leftJoin(Zone::TABLE_DB, Property::getColumn(Property::ZONE_ID),'=',Zone::getColumn(Zone::ID));
        $query->leftJoin(ZoneType::TABLE_DB, ZoneType::getColumn(ZoneType::ID),'=',Zone::getColumn(Zone::TYPE));

        // Iniciamos filtrados del modelo

        /** @var User|null $user */
        $user = Auth::user();
        // Si el usuario es un agente, solo puede ver propiedades de su propia oficina
        if ($user && $user->role === User::ROLE_AGENT) {
            if ($user->office_id) {
                $query->where(Property::getColumn(Property::OFFICE_ID), $user->office_id);
            } else {
                // Si por alguna razón no tiene office_id, no devolvemos resultados
                $query->whereNull(Property::getColumn(Property::OFFICE_ID));
            }
        }

        // Tipo de propiedad
        if (! empty($filters['property_type_id'])) {
            $query->where(Property::getColumn(Property::PROPERTY_TYPE_ID), $filters['property_type_id']);
        }
        // Oficina (la lógica de permisos se controla fuera)
        if (! empty($filters['office_id'])) {
            $query->where(Property::getColumn(Property::OFFICE_ID), $filters['office_id']);
        }
        // Filtro de tipo de operación
        $operation = $filters['operation_type'] ?? null; // sale|rent|null
        if ($operation === 'sale') {
            $query->where(Property::IS_SELL, true);
        } elseif ($operation === 'rent') {
            $query->where(Property::IS_RENT, true);
        }
        // Rango de precio dinámico según operation_type
        if ($operation === 'rent') {
            $priceColumn = Property::RENTAL_PRICE;
        } else {
            // Por defecto usamos precio de venta
            $priceColumn = Property::SELL_PRICE;
        }
        if (! empty($filters['min_price'])) {
            $query->where($priceColumn, '>=', $filters['min_price']);
        }
        if (! empty($filters['max_price'])) {
            $query->where($priceColumn, '<=', $filters['max_price']);
        }
        // Superficie construida
        if (! empty($filters['min_surface_m2'])) {
            $query->where(Property::getColumn(Property::BUILT_M2), '>=', $filters['min_surface_m2']);
        }
        if (! empty($filters['max_surface_m2'])) {
            $query->where(Property::getColumn(Property::BUILT_M2), '<=', $filters['max_surface_m2']);
        }
        // Filtro por zona dinámica: zone_type + zone_id
        if (! empty($filters['zone_type'])) {
            $query->where(ZoneType::getColumn(ZoneType::NAME), $filters['zone_type']);
        }        // Filtro por zona dinámica: zone_type + zone_id
        if (! empty($filters['zone_id'])) {
            $query->where(Zone::getColumn(Zone::ID), $filters['zone_id']);
        }
        // Búsqueda simple por título, calle o referencia interna (case-insensitive)
        if (! empty($filters['search'])) {
            $search = '%' . mb_strtolower($filters['search']) . '%';
            $query->where(function (Builder $q) use ($search) {
                $q->whereRaw('LOWER(' . Property::getColumn(Property::TITLE) . ') LIKE ?', [$search])
                    ->orWhereRaw('LOWER(' .Property::getColumn(Property::STREET) . ') LIKE ?', [$search])
                    ->orWhereRaw('LOWER(' . Property::getColumn(Property::INTERN_REFERENCE) . ') LIKE ?', [$search]);
            });
        }
        return $query;
    }
}
