<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Category;
use App\Models\Project;

class ListProjects extends Component
{
    public $category;
    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $projects = Project::whereHas('categories', fn($query) => $query->where('categories.id', $this->category->id))->published()->paginate(10);
        return view('livewire.projects.list-projects', compact('projects'));
    }
}
