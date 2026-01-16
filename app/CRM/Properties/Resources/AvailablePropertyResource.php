<?php

namespace App\CRM\Properties\Resources;

use App\Models\Catalogs\Office;
use App\Models\Catalogs\ZoneType;
use App\Models\Main\Operations;
use App\Models\Main\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvailablePropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $property = $this->resource;

        return [
            'id' => $property->{Property::ULID},
            'intern_reference' => $property->{Property::INTERN_REFERENCE},
            'title' => $property->title,
            'address' => $property->address,
            'property_type' => [
                'id' => $property->{Property::PROPERTY_TYPE_ID},
                'name' => $property->property_type_name
            ],
            'zone_type' => [
                'id' => $property->{Property::ZONE_ID},
                'type' => $property->zone_type_name,
                'name' => $property->zone_name
            ],
            'surface_m2' => (float) $property->{Property::BUILT_M2},
            'price' => (float )$property->price,
            'operation_type' => $property->{Operations::TYPE},
            'is_sell' => $property->is_sell,
            'is_rent' => $property->is_rent,
            'office' => [
                'id' => $property->office_id,
                'name' => $property->office_name,
            ],
            'main_agent' => [
                'id' => $property->main_agent_id,
                'name' => $property->main_agent_name
            ],
            'created_at' => $property->created_at

        ];
    }
}
