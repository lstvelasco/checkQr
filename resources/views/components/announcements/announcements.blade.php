@props(['posts'])

@foreach ($posts as $post)
    {{-- @dd($post->announcement->applications->where('applicant_id', 1)) --}}
    @php
        $announcementStart = $post->announcement->announcement_start;
        $announcementEnd = $post->announcement->announcement_end;
        $location = $post->announcement->location;
    @endphp
    <x-application-shell>
        <x-ui.post-card>
            <div class="flex flex-col w-full px-5 py-5 space-y-2">
                @auth
                    @if (Auth::user()->account_type == 'Dean')
                        <div class="flex flex-row justify-between">
                            <div class="flex flex-row items-center space-x-2">
                                <img class="w-5 h-5 rounded-full" src="{{ Vite::asset('resources/images/logo.svg') }}"
                                    alt="Rounded avatar">
                                <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    <a
                                        href="/portfolio/{{ $post->author_id }}">{{ $post->user->first_name . ' ' . $post->user->last_name }}</a>
                                </h3>
                            </div>
                            <div class="flex flex-row justify-between">
                                <x-form-error name="post_id"></x-form-error>
                                <x-form-error name="author_id"></x-form-error>
                                @if ($post->isVerified == true)
                                    <div>
                                        <div class="mb-4 mx-2 justify-start">
                                            <button id="status" disabled
                                                class="text-white cursor-none bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                                type="button">
                                                Validated
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <div>
                                        <div class="mb-4 mx-2 justify-start">
                                            <button id="status" disabled
                                                class="text-white cursor-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800"
                                                type="button">
                                                Not Validated
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                <div>
                                    <button id="dropdownActionButton{{ $post->id }}"
                                        data-dropdown-toggle="dropdownAction{{ $post->id }}"
                                        class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                        type="button">
                                        <span class="sr-only">Action button</span>
                                        Action
                                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdownAction{{ $post->id }}"
                                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="{{ $post->id }}">
                                            <li>
                                                <button form="validateForm{{ $post->id }}"
                                                    class="block w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    Validate
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <button form="invalidateForm{{ $post->id }}"
                                                class="block  px-4 py-2 w-full text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                Invalidate
                                            </button>
                                        </div>
                                    </div>
                                    <form hidden class="hidden" id="validateForm{{ $post->id }}"
                                        name="validateForm{{ $post->id }}" action="/validate-post" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input hidden class="hidden" type="text" id="post_id" name="post_id"
                                            value="{{ $post->id }}" />
                                        <input hidden class="hidden" type="text" id="author_id" name="author_id"
                                            value="{{ $post->author_id }}" />
                                    </form hidden class="hidden">
                                    <form id="invalidateForm{{ $post->id }}" name="invalidateForm{{ $post->id }}"
                                        action="/invalidate-post" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input hidden class="hidden" type="text" id="post_id" name="post_id"
                                            value="{{ $post->id }}" />
                                        <input hidden class="hidden" type="text" id="author_id" name="author_id"
                                            value="{{ $post->author_id }}" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
                <span class="font-bold text-gray-500 dark:text-gray-400">{{ $post->announcement->name }}</span>
                <p class="mt-3 mb-4 font-semibold text-gray-500 dark:text-gray-400">{{ $post->content }}</p>
                @if ($announcementStart !== null)
                    <p class="mt-3 mb-4 font-semibold text-gray-500 dark:text-gray-400">Start:
                        {{ \Carbon\Carbon::parse($post->announcement->announcement_start)->format('F j, Y') }}</p>
                @endif
                @if ($announcementEnd !== null)
                    <p class="mt-3 mb-4 font-semibold text-gray-500 dark:text-gray-400">End:
                        {{ \Carbon\Carbon::parse($post->announcement->announcement_end)->format('F j, Y') }}</p>
                @endif
                @if ($announcementEnd !== null)
                    <p class="mt-3 mb-4 font-semibold text-gray-500 dark:text-gray-400">Location:
                        {{ $post->announcement->location }}</p>
                @endif
                <p class="mt-3 mb-4 font-thin text-gray-500 dark:text-gray-400">Posted on:
                    {{ \Carbon\Carbon::parse($post->announcement->created_at)->format('F j, Y') . ' ' . \Carbon\Carbon::parse($post->announcement->created_at)->format('h:i A') }}
                </p>
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <div class="mb-4 justify-start">
                    <button id="createAnnouncementButton"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                        type="button">
                        <a href="/posts/{{ $post->id }}">Inquiries</a>
                    </button>
                </div>

            </div>
        </x-ui.post-card>
    </x-application-shell>
@endforeach
