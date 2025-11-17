<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class CountySelector extends Component
{
    public $counties;

    public function __construct()
    {
        $res = Http::api()->get('county');
        $this->counties = $res->json('counties');
    }

    public function render(): View|Closure|string
    {
        return view('components.county-selector');
    }
}
