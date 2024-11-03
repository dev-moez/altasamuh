<div>
    <x-page-header>
        أخبــار الجمــعيــة
    </x-page-header>
    <div class="container py-10">
        <div class="grid grid-cols-1 gap-y-8 gap-x-4 lg:grid-cols-3 sm:grid-cols-2 md:grid-cols-2">
            @forelse ($articles as $article)
                <x-pages.article-card :article="$article" />
            @empty
            @endforelse
        </div>
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>
</div>
