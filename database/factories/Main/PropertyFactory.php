<?php

namespace Database\Factories\Main;

use App\Models\Main\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Main\Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition(): array
    {
        $isSell = $this->faker->boolean(70); // 70% en venta
        $isRent = $this->faker->boolean(40); // 40% en alquiler

        return [
            Property::ULID => (string) Str::ulid(),
            Property::INTERN_REFERENCE => 'REF-' . $this->faker->unique()->numberBetween(1000, 999999),
            Property::TITLE => $this->faker->randomElement([
                'Piso', 'Casa', 'Local comercial', 'Nave industrial', 'Ático', 'Dúplex', 'Chalet'
            ]) . ' ' . $this->faker->sentence(3),
            Property::STREET => $this->faker->streetName(),
            Property::NUMBER => (string) $this->faker->buildingNumber(),
            Property::ZIP_CODE => $this->faker->postcode(),
            Property::IS_ACTIVE => true,
            Property::IS_SELL => $isSell,
            Property::IS_RENT => $isRent,
            Property::SELL_PRICE => $isSell ? $this->faker->numberBetween(80000, 950000) : null,
            Property::RENTAL_PRICE => $isRent ? $this->faker->numberBetween(500, 5000) : null,
            Property::BUILT_M2 => $this->faker->numberBetween(40, 500),
        ];
    }
}
