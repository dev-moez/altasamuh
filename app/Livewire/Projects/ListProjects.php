<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Category;

class ListProjects extends Component
{
    public $category;
    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.projects.list-projects');
    }
}
