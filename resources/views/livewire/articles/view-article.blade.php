<div>
    <x-page-header>
        أخبــار الجمــعيــة
    </x-page-header>
    <div class="container">
        <div class="my-5">
            <x-section-header class="text-blue-900">
                {{ $article->title }}
            </x-section-header>

            <div>
                {!! $article->content !!}
            </div>
        </div>
    </div>
</div>
