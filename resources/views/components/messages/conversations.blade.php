@props(['conversations'])
@php
    $userId = Auth::id();
@endphp
@foreach ($conversations->where(function ($query) use ($userId) {
            $query->where('user1_id', $userId)->orWhere('user2_id', $userId);
        })->get() as $conversation)
    <x-application-shell>
        <x-ui.post-card>
            <div class="flex flex-col w-full px-5 py-5 space-y-2">
                <div class="flex flex-row items-center space-x-2">
                    <img class="w-5 h-5 rounded-full" src="{{ Vite::asset('resources/images/logo.svg') }}"
                        alt="Rounded avatar">
                    <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <a href="/messages/{{ $conversation->id }}">{{ $conversation->user1_id != $userId ? $conversation->user1->first_name . " " . $conversation->user1->last_name : $conversation->user2->first_name . " " . $conversation->user2->last_name }}</a>
                    </h3>
                </div>
                <span class="font-bold text-gray-500 dark:text-gray-400">{{ $conversation->messages->last()->content }}</span>

                {{-- <p class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400">Date: April 8, 2024. Time: 08:00AM</p> --}}
                <p class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($conversation->messages->last()->created_at)->format('F j, Y') . ' ' . \Carbon\Carbon::parse($conversation->messages->last()->created_at)->format('h:i A') }}</p>


            </div>
        </x-ui.post-card>
    </x-application-shell>
@endforeach
