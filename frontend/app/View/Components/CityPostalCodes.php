<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class CityPostalCodes extends Component
{
    public $postalCodes;
    public function __construct($countyId = 1, $cityId = 1)
    {
        $res = Http::api()->get("county/$countyId/city/$cityId/postalcode");
        $this->postalCodes = $res->json('postalcodes');
    }

    public function render(): View|Closure|string
    {
        return view('components.city-postal-codes');
    }
}
