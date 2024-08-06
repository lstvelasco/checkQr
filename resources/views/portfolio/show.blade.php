<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$notifications" />

        <main class="h-auto p-4 pt-20 md:ml-64">

            <div class="flex justify-between">
                <x-ui.heading>
                    Portfolio
                </x-ui.heading>

                @auth
                    @if (Auth::id() !== $user->id)
                        <div class="mb-4 text-center">
                            <button id="message" form="messageForm"
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                                type="submit">
                                Message
                            </button>
                            <form id="messageForm" name="messageForm" action="/messages" method="POST">
                                @csrf
                                @method('POST')
                                <input hidden class="hidden" type="text" name="target-user" id="target-user" value="{{ $user->id }}">
                            </form>
                        </div>
                    @endif
                @endauth

            </div>

            <x-portfolio :user="$user" />


            <x-footer />
        </main>
    </div>
</x-layout>
