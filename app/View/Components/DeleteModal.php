<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteModal extends Component
{
    public $moduleNameInSingular;
    public $moduleNameInPlural;
    public $id;
    
    public function __construct($moduleNameInSingular, $moduleNameInPlural, $id)
    {
        $this->moduleNameInSingular = $moduleNameInSingular;
        $this->moduleNameInPlural = $moduleNameInPlural;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.delete-modal');
    }
}