<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class CityWithInitial extends Component
{
    public $cities;
    public array $postalCodes;
    public function __construct($countyId = 1, $initial = 'A')
    {
        $res = Http::api()->get("/county/$countyId/abc/$initial");
        $this->cities = $res->json('cities');

        $postalCodes = [];
        foreach ($this->cities as $city) {
            $res = Http::api()->get("county/$countyId/city/". $city['id'] ."/postalcode");
            $postalCodes[$city['id']] = $res->json('postalcodes');
        }
        $this->postalCodes = $postalCodes;
    }

    public function render(): View|Closure|string
    {
        return view('components.city-with-initial');
    }
}
