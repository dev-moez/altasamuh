@use('App\Models\Article', 'Article')
<div class="flex items-start align-top">

    <img src="{{ $article->getFirstMedia(Article::MEDIA_COVER)->getUrl() }}" alt="" class="flex-grow-0 object-cover object-center w-48 h-48 rounded-md">


    <div class="ps-4">
        <h6 class="mb-3 text-lg font-bold">
            <a href="{{ route('articles.view', $article) }}">
                {{ $article->title }}
            </a>
        </h6>
        <p class="mb-2 text-gray-400 lg:text-sm text-md">{{ $article->content_brief }}</p>
        <a href="{{ route('articles.view', $article) }}" class="text-sm text-gray-700 hover:text-blue-600">
            اقرأ المزيد
        </a>
    </div>

</div>
