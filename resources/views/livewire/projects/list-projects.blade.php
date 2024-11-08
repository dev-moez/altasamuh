<div>
    <x-page-header>
        {{ $category->name }}
    </x-page-header>

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
