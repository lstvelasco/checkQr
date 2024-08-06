@props(['type' => 'default', 'active' => false])

@if ($type == 'default')
    @props(['to' => '#'])
    <li>
        <a href="{{ $to }}"
        class="{{ $active ? 'flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white bg-gray-100 dark:bg-gray-700 group' : 'flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group' }}">
            {{ $icon }}
            <span class="flex-1 ml-3 whitespace-nowrap">{{ $slot }}</span>
            @isset($badge)
                {{ $badge }}
            @endisset
        </a>
    </li>
@elseif ($type == 'dropdown')
    @props(['title' => 'Title', 'links'])
    <li>
        <button type="button"
            class="{{ $active ? 'flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg group bg-gray-100 dark:text-white dark:bg-gray-700' : 'flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700'}}"
            aria-controls="dropdown-{{ strtolower($title) }}" data-collapse-toggle="dropdown-{{ strtolower($title) }}">
            {{ $icon }}
            <span class="flex-1 ml-3 text-left whitespace-nowrap">{{ $title }}</span>
            @isset($badge)
                {{ $badge }}
            @endisset
            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <ul id="dropdown-{{ strtolower($title) }}" class="hidden py-2 space-y-2">
            @foreach ($links as $link)
                <li>
                    <a href="{{ $link['url'] }}"
                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ $link['title'] }}</a>
                </li>
            @endforeach
            {{-- <li>
                <a href="#"
                    class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Settings</a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Kanban</a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Calendar</a>
            </li> --}}
        </ul>
    </li>
@endif
