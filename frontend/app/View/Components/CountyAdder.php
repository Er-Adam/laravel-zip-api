<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class CountyAdder extends Component
{

    public bool $isAdd = false;
    public function __construct()
    {
        $this->isAdd = $this->checkIsAdd();
    }

    public function render(): View|Closure|string
    {
        return view('components.county-adder');
    }
    private function checkIsAdd(): bool
    {
        return Http::isAuth() &&
            session()->get('add_type') === "county" &&
            session()->get('add_id') === '-1';
    }
}
