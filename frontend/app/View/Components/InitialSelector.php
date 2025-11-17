<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class InitialSelector extends Component
{
    public $initials;
    public function __construct($countyId = 1)
    {
        $res = Http::api()->get("/county/$countyId/abc");
        $this->initials = $res->json('initials');
    }

    public function render(): View|Closure|string
    {
        return view('components.initial-selector');
    }
}
