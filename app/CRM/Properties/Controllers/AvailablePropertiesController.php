<?php

namespace App\CRM\Properties\Controllers;

use App\Http\Controllers\Controller;
use App\CRM\Properties\Request\AvailablePropertiesRequest;
use App\CRM\Properties\Resources\AvailablePropertyResource;
use App\CRM\Properties\Services\AvailablePropertiesIndex;

class AvailablePropertiesController extends Controller
{
    /**
     * Listado de propiedades disponibles para operar
     */
    public function index(AvailablePropertiesRequest $request, AvailablePropertiesIndex $service)
    {
        $paginator = $service->handle($request); // LengthAwarePaginator

        $data = AvailablePropertyResource::collection(
            collect($paginator->items())
        );

        return response()->json([
            'data' => $data,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
                'last_page'    => $paginator->lastPage(),
            ],
        ]);
    }
}
