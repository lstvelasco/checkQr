@props([
    'method' => 'POST',
    'placeholder' => 'Write inquiry...',
    'buttonLabel' => 'Post inquiry',
    'type' => 'comment',
])

@if ($type == 'comment')
    @props(['targetId' => false, 'targetAuthorId' => false])
    <form method="{{ $method }}" action="/comment">
        @csrf
        @method($method)
        <div class="w-full border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
            <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                <label for="comment" class="sr-only">Your comment</label>
                <textarea id="content" name="content" rows="4"
                    class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                    placeholder="{{ $placeholder }}" required></textarea>
            </div>
            <input hidden type="text" class="hidden" name="target_author_id" id="target_author_id"
                value="{{ $targetAuthorId }}" />
            <input hidden class="hidden" type="text" name="post_id"
                id="post_id" value="{{ $targetId }}" />
            <x-form-error name="content"></x-form-error>
            <x-form-error name="post_id"></x-form-error>
            <x-form-error name="target_author_id"></x-form-error>
            <div class="flex items-center justify-end px-3 py-2 border-t dark:border-gray-600">
                <button type="submit"
                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 hover:bg-primary-800">
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                    </svg>
                    <span class="sr-only">{{ $buttonLabel }}</span>
                </button>
            </div>
        </div>
    </form>
    {{-- <p class="ms-auto text-xs text-gray-500 dark:text-gray-400">Remember, contributions to this topic should follow our <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">Community Guidelines</a>.</p> --}}
@elseif ($type == 'reply')
@props(['targetId' => false, 'targetAuthorId' => false, 'postId' => false])
    <form method="{{ $method }}" action="/reply">
        @csrf
        @method($method)
        <div class="w-full border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
            <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                <label for="comment" class="sr-only">Your reply</label>
                <textarea id="content" name="content" rows="4"
                    class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                    placeholder="{{ $placeholder }}" required></textarea>
            </div>
            <input hidden type="text" class="hidden" name="target_author_id" id="target_author_id"
                value="{{ $targetAuthorId }}" />
            <input hidden class="hidden" type="text" name="comment_id"
                id="comment_id" value="{{ $targetId }}" />
                <input hidden class="hidden" type="text" name="post_id"
                id="post_id" value="{{ $postId }}" />
            <x-form-error name="content"></x-form-error>
            <x-form-error name="comment_id"></x-form-error>
            <x-form-error name="post_id"></x-form-error>
            <x-form-error name="target_author_id"></x-form-error>
            <div class="flex items-center justify-end px-3 py-2 border-t dark:border-gray-600">
                <button type="submit"
                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 hover:bg-primary-800">
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                    </svg>
                    <span class="sr-only">{{ $buttonLabel }}</span>
                </button>
            </div>
        </div>
    </form>
    {{-- <p class="ms-auto text-xs text-gray-500 dark:text-gray-400">Remember, contributions to this topic should follow our <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">Community Guidelines</a>.</p> --}}
@endif
