@use('App\Models\Project', 'Project')
<div>
    <div class="py-4">
        <div class="container">
            <div class="p-3 mb-4 text-xs font-bold text-gray-500 bg-white rounded-md lg:text-lg">
                <a href="{{ route('home') }}">الرئيسية</a> / <a href="{{ route('projects.list', $project->categories->first()) }}">المشاريع</a> / {{ $project->title }}
            </div>
            <div class="grid grid-cols-1 gap-2 p-3 bg-white rounded-md lg:p-5 lg:gap-4 lg:grid-cols-2">
                <div>
                    <h1 class="block mb-3 font-bold lg:text-2xl text-md lg:hidden">{{ $project->title }}</h1>
                    <img src="{{ $project->getFirstMedia(Project::MEDIA_COLLECTION)?->getUrl() }}" alt="" class="lg:max-w-full lg:h-[563px] lg:max-h-[563px]  w-full h-[200px]  rounded-md object-cover object-top lg:object-center">
                    <div class="hidden mt-3 lg:block">
                        <h6 class="mb-3 text-lg font-bold">وصف المشروع</h6>
                        {!! $project->description !!}
                    </div>
                </div>
                <div>
                    <h1 class="hidden mb-2 text-2xl font-bold lg:block">{{ $project->title }}</h1>
                    <div class="flex justify-between gap-2">
                        <div class="flex items-center gap-x-4">
                            عدد المتبرعين: <span class="font-bold text-green-500">{{ $project->donations()->paid()->count() }}</span>
                        </div>
                        <div class="flex items-center cursor-pointer gap-x-4" onclick="copyToClipboard('{{ route('projects.view', $project) }}')">
                            شارك المشروع
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_435_1909)">
                                    <path d="M16 32C24.8366 32 32 24.8366 32 16C32 7.16344 24.8366 0 16 0C7.16344 0 0 7.16344 0 16C0 24.8366 7.16344 32 16 32Z" fill="#0072BB" />
                                    <path d="M19.5967 20.1858C18.8567 20.1858 18.1668 20.4068 17.5875 20.7819L14.433 18.5449L12.2531 16.9979C12.2832 16.8036 12.3033 16.6061 12.3033 16.4051C12.3033 15.9564 12.2196 15.5278 12.0722 15.1293L14.433 13.4549L17.5875 11.2147C18.1668 11.5897 18.8567 11.8107 19.5967 11.8107C21.6461 11.8107 23.3137 10.1465 23.3137 8.10041C23.3137 6.05101 21.6461 4.38672 19.5967 4.38672C17.5507 4.38672 15.883 6.05101 15.883 8.10041C15.883 8.44197 15.9333 8.77349 16.0203 9.09162L13.8202 10.6555L10.3309 13.1301C9.81186 12.8522 9.21915 12.6948 8.5896 12.6948C6.5402 12.6948 4.87256 14.3591 4.87256 16.4051C4.87256 18.4512 6.5402 20.1155 8.5896 20.1155C9.4703 20.1155 10.284 19.8074 10.9236 19.2884L13.8202 21.3444L16.0203 22.9049C15.9333 23.2231 15.883 23.5546 15.883 23.8995C15.883 25.9455 17.5507 27.6098 19.5967 27.6098C21.6461 27.6098 23.3137 25.9455 23.3137 23.8995C23.3137 21.8534 21.6461 20.1858 19.5967 20.1858ZM19.5163 5.97064C20.6683 5.97064 21.6059 6.90828 21.6059 8.06357C21.6059 9.21887 20.6683 10.1531 19.5163 10.1531C18.361 10.1531 17.4234 9.21887 17.4234 8.06357C17.4234 6.90828 18.361 5.97064 19.5163 5.97064ZM8.54606 18.6186C7.39077 18.6186 6.45314 17.681 6.45314 16.5257C6.45314 15.3704 7.39077 14.4361 8.54606 14.4361C9.70136 14.4361 10.6356 15.3704 10.6356 16.5257C10.6356 17.681 9.70136 18.6186 8.54606 18.6186ZM19.5163 26.0192C18.361 26.0192 17.4234 25.0816 17.4234 23.9263C17.4234 22.771 18.361 21.8367 19.5163 21.8367C20.6683 21.8367 21.6059 22.771 21.6059 23.9263C21.6059 25.0816 20.6683 26.0192 19.5163 26.0192Z" fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_435_1909">
                                        <rect width="32" height="32" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>

                        </div>
                    </div>
                    <div class="lg:p-5 p-3 mt-3 border border-[#0072BB] rounded-md text-start items-start">
                        <livewire:projects.project-donation-actions :project="$project" showPhoneNumber="true" />
                    </div>
                    <div class="block mt-5 lg:hidden">
                        <h6 class="mb-3 text-lg font-bold">وصف المشروع</h6>
                        {!! $project->description !!}
                    </div>
                    <div class=mt-4>
                        <h6 class="mb-3 text-lg font-bold">تفاصيل المشروع</h6>
                        @if (count($project->details) > 0)
                            <table class="min-w-full divide-y divide-gray-200">
                                <tbody>
                                    @foreach ($project->details as $details)
                                        <tr class="border-b border-gray-200">
                                            <td class="px-6 py-2 text-sm font-bold text-gray-800 whitespace-nowrap ">{{ $details['key'] ?? '' }}</td>
                                            <td class="px-6 py-2 text-sm font-medium text-gray-800 whitespace-nowrap">{{ $details['value'] ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text)
                .then(() => {
                    Livewire.dispatch('success-message', [{
                        'message': 'تم نسخ الرابط'
                    }]);
                })
                .catch(err => {
                    Livewire.dispatch('error-message', [{
                        'message': 'حدث خطاء ما، يرجى المحاولة مرة اخرى'
                    }]);
                });
        }
    </script>
</div>
