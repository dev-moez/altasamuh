<?php

namespace App\Livewire\Articles;

use Livewire\Component;
use App\Models\Article;
use Livewire\WithPagination;

class ListArticles extends Component
{
    use WithPagination;
    public $paginationTheme = 'simple-tailwind';
    public function render()
    {
        $articles = Article::published()->latest()->paginate(12);
        return view('livewire.articles.list-articles', compact('articles'));
    }
}
