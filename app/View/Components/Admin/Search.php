<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Search extends Component
{
    public $searchTerm;

    public function __construct($searchTerm = null)
    {
        $this->searchTerm = $searchTerm;
    }

    public function render()
    {
        return view('components.admin.search');
    }
}
