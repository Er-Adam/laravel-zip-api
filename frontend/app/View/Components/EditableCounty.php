<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class EditableCounty extends Component
{
    public string $id;
    public string $name;
    public bool $isEdit = false;

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->name = Http::api()->get("county/$id")->json('county.name');
        $this->isEdit = $this->checkIsEdit();
    }

    public function render(): View|Closure|string
    {
        return view('components.editable-county');
    }

    public function checkIsEdit(): bool
    {
        return Http::isAuth() &&
            session()->get('edit_type') === "county" &&
            session()->get('edit_id') === $this->id;
    }
}
