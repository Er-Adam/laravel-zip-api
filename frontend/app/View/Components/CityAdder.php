<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class CityAdder extends Component
{
    public bool $isAdd = false;
    public string $countyId;

    public function __construct($countyId)
    {
        $this->countyId = $countyId;
        $this->isAdd = $this->checkIsAdd();
    }

    public function render(): View|Closure|string
    {
        return view('components.city-adder');
    }

    private function checkIsAdd(): bool
    {
        return Http::isAuth() &&
            session()->get('add_type') === "city" &&
            session()->get('add_id') === $this->countyId;
    }
}
