<?php

namespace App\CRM\Properties\Services;

use App\CRM\Properties\Queries\AvailablePropertiesQuery;
use App\CRM\Properties\Request\AvailablePropertiesRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AvailablePropertiesIndex
{
    /*
     * Invocamos querys o servicios necesarios
     * */
    public function __construct(
        private readonly AvailablePropertiesQuery $availablePropertiesQuery,
    ) {
    }
    /*
     * Generamos el servicio de propiedades disponibles usando la query correspondiente
     * */
    public function handle(AvailablePropertiesRequest $request): LengthAwarePaginator
    {
        $filters = $request->validated();
        $query = $this->availablePropertiesQuery->query($filters);

        $perPage = $filters['per_page'] ?? 20;

        return $query->paginate($perPage);
    }
}
