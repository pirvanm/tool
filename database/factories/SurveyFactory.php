<?php

namespace Database\Factories;

use Faker\Generator as Faker;

use App\Models\Survey;
use Illuminate\Database\Eloquent\Factories\Factory;

use Stevebauman\Location\Facades\Location;

class SurveyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Survey::class;

    public function randomIp()
    {
        return mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255);
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();

        $colors = ['#c22e3c', '#5f1994', '#6699cc', '#f03b0b', '#4b0bf1', '#494e7d', '#11e6a9', '#aca92d', '#f44970', '#1bc142'];
        $randomIp = $this->randomIp();
        $data = Location::get($randomIp);
        $country = '';


        while (!$data || !$country) {
            $randomIp = $this->randomIp();
            $data = Location::get($this->randomIp());

            if ($data) {
                $country = $data->countryName;
            }
            
        }

        

        $randDate = new \DateTime();
        $randDate->setTime(mt_rand(0, (new \DateTime())->format("h")), mt_rand(0, 59));

        return [
            'name' => $faker->name,
            'email' =>$faker->email,
            'color1' => $colors[array_rand($colors)],
            'color2' => $colors[array_rand($colors)],
            'color3' => $colors[array_rand($colors)],
            'country' => $country,
            'ip' => $randomIp,
            'useragent'=> $faker->userAgent,
            'created_at' => $randDate->format('Y-m-d H:i'),
        ];
    }
}
