<?php

namespace Database\Factories\Dealskoo\MailList\Models;

use Dealskoo\Country\Models\Country;
use Dealskoo\MailList\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    protected $model = Email::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->email(),
            'email_verified_at' => $this->faker->dateTime,
            'tag' => $this->faker->slug,
            'country_id' => Country::factory()->create(),
        ];
    }
}
