@props(['notifications'])

@foreach ($notifications->where('receiver_id', Auth::id()) as $notification)
    @if ($notification->isRead == false)
        <x-application-shell>
            <x-ui.post-card>
                <div class="flex flex-col w-full px-5 py-5 space-y-2">
                    <div class="flex flex-row items-center space-x-2">
                        <img class="w-5 h-5 rounded-full" src="{{ Vite::asset('resources/images/logo.svg') }}"
                            alt="Rounded avatar">
                        <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">
                                @if ($notification->author_id == Auth::id())
                                    You
                                @else
                                    {{ $notification->author->first_name . ' ' . $notification->author->last_name }}
                                @endif
                            </a>
                        </h3>
                        <span class="font-bold text-gray-500 dark:text-gray-400">
                            {{ $notification->action . '.' }}
                        </span>
                        <span>
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM6 6a1 1 0 0 1-.707-.293l-1-1a1 1 0 0 1 1.414-1.414l1 1A1 1 0 0 1 6 6Zm-2 4H3a1 1 0 0 1 0-2h1a1 1 0 1 1 0 2Zm14-4a1 1 0 0 1-.707-1.707l1-1a1 1 0 1 1 1.414 1.414l-1 1A1 1 0 0 1 18 6Zm3 4h-1a1 1 0 1 1 0-2h1a1 1 0 1 1 0 2ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z" />
                            </svg>
                        </span>
                    </div>
                    <p class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400">
                        {{ \Carbon\Carbon::parse($notification->created_at)->format('F j, Y') . ' ' . \Carbon\Carbon::parse($notification->created_at)->format('h:i A') }}
                    </p>

                </div>
            </x-ui.post-card>
        </x-application-shell>
    @else
        <x-application-shell>
            <x-ui.post-card>
                <div class="flex flex-col w-full px-5 py-5 space-y-2">
                    <div class="flex flex-row items-center space-x-2">
                        <img class="w-5 h-5 rounded-full" src="{{ Vite::asset('resources/images/logo.svg') }}"
                            alt="Rounded avatar">
                        <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">
                                @if ($notification->author_id == Auth::id())
                                    You
                                @else
                                    {{ $notification->author->first_name . ' ' . $notification->author->last_name }}
                                @endif
                            </a>
                        </h3>
                        <span class="font-bold text-gray-500 dark:text-gray-400">
                            {{ $notification->action . '.' }}
                        </span>
                    </div>
                    <p class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400">
                        {{ \Carbon\Carbon::parse($notification->created_at)->format('F j, Y') . ' ' . \Carbon\Carbon::parse($notification->created_at)->format('h:i A') }}
                    </p>

                </div>
            </x-ui.post-card>
        </x-application-shell>
    @endif
@endforeach
