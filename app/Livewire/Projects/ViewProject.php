<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;

class ViewProject extends Component
{
    public $project;
    public function mount(Project $project)
    {
        $this->project = $project;
    }
    public function render()
    {
        return view('livewire.projects.view-project');
    }
}
