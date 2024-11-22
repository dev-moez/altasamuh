@use('App\Models\Category', 'Category')
<div>
    <div class="container mt-8">
        <div class="bg-white rounded-2xl border border-[#0072BB]">
            <div class="relative">
                <img src="{{ $category->getFirstMedia(Category::MEDIA_CATEGORY)?->getUrl() }}" alt="" class="lg:max-h-[340px] lg:h-[340px] h-[150px] max-h-[150px] w-full object-cover object-center rounded-xl">
                <h1 class="absolute text-3xl font-bold text-center text-white transform -translate-x-1/2 bottom-1/2 left-1/2">
                    {{ $category->name }}
                </h1>
            </div>
            <div class="w-full lg:max-w-[80%] text-center mt-5 lg:text-lg text-sm mx-auto px-4 pb-5">
                {{ $category->description }}
            </div>
        </div>
    </div>

    <div class="container py-10">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            @forelse($projects as $project)
                <div class="border-2 border-gray-200 rounded-md ">
                    <img src="{{ $project->getFirstMedia('project-cover')?->getUrl() }}" alt="" class="object-cover object-center w-full h-72">
                    <div class="px-3 pt-4 pb-6 bg-white">
                        <div class="mb-4">
                            <a href="{{ route('projects.view', $project) }}">
                                <h2 class="font-bold text-md">{{ $project->title }}</h2>
                            </a>
                        </div>
                        <livewire:projects.project-donation-actions :project="$project" />
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <div class="mt-4">
            {{ $projects->links() }}
        </div>
    </div>
</div>
