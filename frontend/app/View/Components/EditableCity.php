<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class EditableCity extends Component
{
    public string $id;
    public string $name;
    public array $postalCodes;
    public bool $isEdit = false;
    public bool $isAdd = false;

    public function __construct(string $id, string $name, array $postalCodes)
    {
        $this->id = $id;
        $this->name = $name;
        $this->postalCodes = $postalCodes;
        $this->isEdit = $this->checkIsEdit();
        $this->isAdd = $this->checkIsAdd();
    }

    public function render(): View|Closure|string
    {
        return view('components.editable-city');
    }

    private function checkIsEdit(): bool
    {
        return Http::isAuth() &&
            session()->get('edit_type') === "city" &&
            session()->get('edit_id') === $this->id;
    }

    private function checkIsAdd(): bool
    {
        return Http::isAuth() &&
            session()->get('add_type') === "city" &&
            session()->get('add_id') === $this->id;
    }
}
