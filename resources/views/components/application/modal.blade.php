@props([
    'name',
    'inputId1',
    'inputId2',
    'data1',
    'data2',
    'cancelMessage',
    'confirmMessage',
    'message',
    'formAction',
    'formMethod',
    'type' => 'default',
])

<!-- Main modal -->
@if ($type == 'default')
    <div class="fixed z-50">
        <div id="{{ $name }}Modal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 items-center justify-center hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-md p-4 md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="{{ $name }}Modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    @isset($icon)
                        {{ $icon }}
                    @endisset
                    <p class="mb-4 text-gray-500 dark:text-gray-300">{{ $message }}</p>
                    <div class="flex items-center justify-center space-x-4">
                        <button data-modal-toggle="{{ $name }}Modal" type="button"
                            class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            {{ $cancelMessage }}
                        </button>
                        <button form="{{$name}}-submitForm" type="submit"
                            class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-900">
                            {{ $confirmMessage }}
                        </button>
                        <form hidden id="{{$name}}-submitForm" class="hidden" action="{{ $formAction }}" method="POST">
                            @csrf
                            @method($formMethod)
                            <input hidden class="hidden" id="{{ $inputId1 }}" name="{{ $inputId1 }}"
                                type="number" value="{{ $data1 }}" />
                            <input hidden class="hidden" id="{{ $inputId2 }}" name="{{ $inputId2 }}"
                                type="number" value="{{ $data2 }}" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif ($type == 'warning')
    <!-- Main modal -->
    <div class="fixed z-50">
        <div id="{{ $name }}Modal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-md p-4 md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="{{ $name }}Modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    @isset($icon)
                    {{ $icon }}
                @endisset
                    <p class="mb-4 text-gray-500 dark:text-gray-300">{{ $message }}</p>
                    <div class="flex items-center justify-center space-x-4">
                        <button data-modal-toggle="{{ $name }}Modal" type="button"
                            class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            {{ $cancelMessage }}
                        </button>
                        <button form="{{$name}}-submitForm" type="submit"
                            class="px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            {{ $confirmMessage }}
                        </button>
                        <form id="{{$name}}-submitForm" class="hidden" hidden action="{{ $formAction }}" method="POST">
                            @csrf
                            @method($formMethod)
                            <input hidden class="hidden" id="{{ $inputId1 }}" name="{{ $inputId1 }}"
                                type="number" value="{{ $data1 }}" />
                            <input hidden class="hidden" id="{{ $inputId2 }}" name="{{ $inputId2 }}"
                                type="number" value="{{ $data2 }}" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
