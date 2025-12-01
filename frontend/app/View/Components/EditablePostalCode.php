<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class EditablePostalCode extends Component
{
    public string $id;
    public string $postalCode;
    public bool $isEdit;

    public function __construct(string $id, string $postalCode)
    {
        $this->id = $id;
        $this->postalCode = $postalCode;
        $this->isEdit = $this->checkIsEdit();
    }

    public function render(): View|Closure|string
    {
        return view('components.editable-postal-code');
    }

    private function checkIsEdit(): bool
    {
        return Http::isAuth() &&
            session()->get('edit_type') === "postalcode" &&
            session()->get('edit_id') === $this->id;
    }
}
