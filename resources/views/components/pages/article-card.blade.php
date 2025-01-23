@use('App\Models\Article', 'Article')
<div class="flex items-start align-top">

    <img src="{{ $article->getFirstMedia(Article::MEDIA_COVER)->getUrl() }}" alt="" class="flex-grow-0 object-cover object-center rounded-md w-36 h-36 lg:w-48 lg:h-48">


    <div class="ps-4">
        <h6 class="mb-3 font-bold">
            <a href="{{ route('articles.view', $article) }}" class="text-sm line-clamp-2 lg:text-lg">
                {{ $article->title }}
            </a>
        </h6>
        <p class="mb-2 text-sm text-gray-400 lg:text-sm lg:line-clamp-6 line-clamp-4">{{ strip_tags($article->content) }}</p>
        <a href="{{ route('articles.view', $article) }}" class="text-sm text-gray-700 hover:text-blue-600">
            اقرأ المزيد
        </a>
    </div>

</div>
