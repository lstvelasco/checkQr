<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$activities" />

        <main class="h-auto p-4 pt-20 md:ml-64">
            <div class="flex justify-between">
                <x-ui.heading>
                    Attendance Codes
                </x-ui.heading>
                <div class="fixed top-13 right-4">
                    <button id="generateCodesButton" form="generateCodesForm"
                        class="z-50 text-white bg-primary-700 shadow-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                        type="submit">
                        Generate
                    </button>
                    <form method="POST" hidden class="hidden"  action="/attendance-codes-generator" id="generateCodesForm" name="generateCodesForm">
                        @csrf
                        @method('POST')
                        <input id="event_session_id" name="event_session_id" type="text" value="{{ $eventSession->id }}" />
                        <input id="event_id" name="event_id" type="text" value="{{ $eventSession->event->id }}" />
                        {{-- @dd($eventSession->event->id) --}}
                        {{-- <input type="text" value="{{ $attendanceCodes->session->id }}" /> --}}

                    </form>
                </div>
            </div>

            <x-ui.layout>
                <x-attendance-codes.show :attendanceCodes="$attendanceCodes" ></x-attendance-codes.show>
            </x-ui.layout>


            <x-footer />
        </main>
    </div>
</x-layout>
