<div>
    <x-page-header>
        المركز الإعلامي
    </x-page-header>

    <div class="py-12">
        <div class="container">
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                @foreach ($galleries as $gallery)
                    <a href="{{ route('galleries.view', $gallery) }}">
                        <div class="bg-white rounded-md">
                            <img src="{{ $gallery->getFirstMedia('gallery-cover')?->getUrl() }}" alt="" class="w-full h-72">
                            <div class="p-3 text-center">
                                <h5 class="text-lg font-bold">{{ $gallery->title }}</h5>
                            </div>
                        </div>
                    </a>
                    {{-- @empty
                    <x-no-data> --}}
                @endforeach
            </div>
        </div>
    </div>
</div>
