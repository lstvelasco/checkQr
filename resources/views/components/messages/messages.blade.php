@props(['messages', 'conversation'])
@php
    $receiverId = $conversation->user1_id != Auth::id() ? $conversation->user1_id : $conversation->user2_id;
    $conversationId = $conversation->id;
@endphp


@foreach ($messages as $message)
{{-- Current user --}}
    @if ($message->sender_id == Auth::id()) 
        <div class="flex justify-end gap-2.5">
            <div class="flex flex-col gap-1 w-full max-w-[250px] lg:max-w-[320px]">
                <div class="flex justify-end items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">You</span>
                </div>
                <div
                    class="flex flex-col leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-s-xl rounded-se-xl dark:bg-gray-700">
                    <p class="text-sm font-normal text-gray-900 dark:text-white"> {{ $message->content }} </p>
                </div>
                <div class="flex justify-end items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Delivered</span>
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($message->created_at)->format('F j, Y') . ' ' . \Carbon\Carbon::parse($message->created_at)->format('h:i A') }}</span>
                </div>
            </div>
        </div>
        
{{-- Target user         --}}
    @else
        <div class="flex items-start gap-2.5">
            <img class="w-8 h-8 rounded-full" src="{{ Vite::asset('resources/images/logo.svg') }}" alt="Jese image">
            <div class="flex flex-col gap-1 w-full max-w-[250px] lg:max-w-[320px]">
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span
                     class="text-sm font-semibold text-gray-900 dark:text-white"><a href="/portfolio/{{ $message->sender->id }}">{{ $message->sender->first_name . ' ' . $message->sender->last_name }}</a></span>
                </div>
                <div
                    class="flex flex-col leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                    <p class="text-sm font-normal text-gray-900 dark:text-white">{{ $message->content }}</p>
                </div>
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Delivered</span>
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($message->created_at)->format('F j, Y') . ' ' . \Carbon\Carbon::parse($message->created_at)->format('h:i A') }}</span>

                </div>
            </div>
        </div>
    @endif
@endforeach


<hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">


<form id="send-message" name="send-message" method="POST" action="/send-message">
    @csrf
    @method('POST')
    <label for="content" class="sr-only">Your message</label>
    <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700">
        <img class="w-8 h-8 rounded-full" src="{{ Vite::asset('resources/images/logo.svg') }}" alt="Jese image">
        <input hidden class="hidden" type="text" name="receiver_id" id="receiver_id" value="{{ $receiverId }}" />
        <input hidden class="hidden" type="text" name="sender_id" id="sender_id" value="{{ Auth::id() }}" />
        <input hidden class="hidden" type="text" name="conversation_id" id="conversation_id"
            value="{{ $conversationId }}" />
        <textarea id="content" name="content" rows="1"
            class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Your message..."></textarea>
        <button type="submit"
            class="inline-flex justify-center p-2 text-primary-600 rounded-full cursor-pointer hover:bg-primary-100 dark:text-primary-500 dark:hover:bg-gray-600">
            <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 18 20">
                <path
                    d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
            </svg>
            <span class="sr-only">Send message</span>
        </button>
    </div>
    <x-form-error name="sender_id"></x-form-error>
    <x-form-error name="receiver_id"></x-form-error>
    <x-form-error name="conversation_id"></x-form-error>
    <x-form-error name="content"></x-form-error>
</form>

<script>
    window.addEventListener('load', function() {
        var element = document.getElementById("send-message");
        if (element) {
            // Delaying the scroll action to ensure the page is fully loaded
            setTimeout(function() {
                element.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100); // Adjust the delay as necessary
        }
    });
</script>
