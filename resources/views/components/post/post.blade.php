@props(['post'])
@php
    $announcementStart = $post->announcement->announcement_start;
    $announcementEnd = $post->announcement->announcement_end;
    $location = $post->announcement->location;
@endphp

<x-application-shell>
    <x-ui.post-card>
        <div class="flex flex-col w-full p-6 space-y-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="flex flex-row justify-between">
                <div class="flex flex-row items-center space-x-2">
                    <img class="w-5 h-5 rounded-full" src="{{ Vite::asset('resources/images/logo.svg') }}"
                        alt="Rounded avatar">
                    <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <a
                            href="/portfolio/{{ $post->author_id }}">{{ $post->user->first_name . ' ' . $post->user->last_name }}</a>
                    </h3>
                </div>
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
            </div>

            <span class="text-xl font-bold text-gray-700 dark:text-gray-300">{{ $post->announcement->name }}</span>

            <p class="text-base text-gray-600 dark:text-gray-400">{{ $post->content }}</p>

            @if ($announcementStart !== null)
                <p class="text-sm text-gray-500 dark:text-gray-400">Start:
                    {{ \Carbon\Carbon::parse($announcementStart)->format('F j, Y') }}</p>
            @endif

            @if ($announcementEnd !== null)
                <p class="text-sm text-gray-500 dark:text-gray-400">End:
                    {{ \Carbon\Carbon::parse($announcementEnd)->format('F j, Y') }}</p>
            @endif

            @if ($location !== null)
                <p class="text-sm text-gray-500 dark:text-gray-400">Location: {{ $location }}</p>
            @endif

            <p class="text-sm text-gray-500 dark:text-gray-400">Posted on:
                {{ \Carbon\Carbon::parse($post->announcement->created_at)->format('F j, Y h:i A') }}</p>

            <hr class="border-gray-300 dark:border-gray-700">

            @foreach ($post->comments as $comment)
                <div class="flex flex-col pl-6 border-l-2 border-gray-300 space-y-2 dark:border-gray-600"
                    x-data="{ showReplyBox: false }">
                    <div class="flex items-center space-x-2">
                        <img class="w-6 h-6 rounded-full" src="{{ Vite::asset('resources/images/logo.svg') }}"
                            alt="User avatar">
                        <h6 class="text-sm font-semibold text-gray-900 dark:text-white">
                            <a
                                href="/portfolio/{{ $comment->user->id }}">{{ $comment->user->first_name . ' ' . $comment->user->last_name }}</a>
                        </h6>
                    </div>

                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $comment->content }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Posted on:
                        {{ \Carbon\Carbon::parse($comment->created_at)->format('F j, Y h:i A') }}</p>

                    @auth
                        <button @click="showReplyBox = !showReplyBox"
                            class="px-2 py-1 text-xs text-white bg-primary-700 rounded-md hover:bg-primary-800 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-300">
                            Reply
                        </button>
                        <div x-show="showReplyBox" class="mt-2">
                            <x-post.comment-box buttonLabel="Reply" type="reply" placeholder="Write a reply..."
                                targetId="{{ $comment->id }}" targetAuthorId="{{ $comment->user->id }}"
                                postId="{{ $post->id }}"></x-post.comment-box>
                        </div>
                    @endauth

                    @foreach ($comment->replies as $reply)
                        <div class="flex flex-col pl-6 border-l-2 border-gray-300 space-y-2 dark:border-gray-600">
                            <div class="flex items-center space-x-2">
                                <img class="w-6 h-6 rounded-full" src="{{ Vite::asset('resources/images/logo.svg') }}"
                                    alt="User avatar">
                                <h6 class="text-sm font-semibold text-gray-900 dark:text-white">
                                    <a
                                        href="/portfolio/{{ $reply->user->id }}">{{ $reply->user->first_name . ' ' . $reply->user->last_name }}</a>
                                </h6>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $reply->content }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Posted on:
                                {{ \Carbon\Carbon::parse($reply->created_at)->format('F j, Y h:i A') }}</p>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <div id="inquiry-box" name="inquiry-box">
                @if (Auth::id() === null)
                    {{-- <p class="text-sm text-red-500 dark:text-red-400">Login to post inquiry</p> --}}
                    <a href="/login">
                        <button
                        class="block w-full px-2 py-1 text-xs text-white bg-red-700 rounded-md hover:bg-red-800 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Login to post inquiry
                    </button>
                    </a>
                @else
                    <x-post.comment-box targetId="{{ $post->id }}"
                        targetAuthorId="{{ $post->author_id }}"></x-post.comment-box>
                @endif
            </div>
        </div>
    </x-ui.post-card>
</x-application-shell>

<script>
    window.addEventListener('load', function() {
        var element = document.getElementById("inquiry-box");
        if (element) {
            // Delaying the scroll action to ensure the page is fully loaded
            setTimeout(function() {
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 100); // Adjust the delay as necessary
        }
    });
</script>
