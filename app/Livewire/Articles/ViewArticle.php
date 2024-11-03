<?php

namespace App\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;

class ViewArticle extends Component
{
    public $article;
    public function mount(Article $article)
    {
        $this->article = $article;
    }
    public function render()
    {
        return view('livewire.articles.view-article');
    }
}
