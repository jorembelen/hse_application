<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->words($nb=2,$asText=true);
        return [
            'name' => $name,
            'badge' => $this->faker->numberBetween(1,1000000),
            'designation' => $this->faker->unique()->words($nb=2,$asText=true),
        ];
    }
}
