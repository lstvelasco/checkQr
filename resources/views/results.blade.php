<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$activities" />

        <main class="h-auto p-4 pt-20 md:ml-64">
            <div class="flex justify-between">
                <x-ui.heading>
                    Search results
                </x-ui.heading>
            </div>

            <div class="min-h-[61vh] md:min-h-[65vh]">
                @if ($users != null)
                    @foreach ($users as $user)
                        <x-application-shell>
                            <x-ui.post-card>
                                <div class="flex flex-col w-full px-5 py-5 space-y-2">
                                    <div class="flex flex-row justify-between">
                                        <div class="flex flex-row items-center space-x-2">
                                            <img class="w-5 h-5 rounded-full"
                                                src="{{ Vite::asset('resources/images/logo.svg') }}" alt="Rounded avatar">
                                            <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                <a
                                                    href="/portfolio/{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </x-ui.post-card>
                        </x-application-shell>
                    @endforeach
                @endif
            </div>

            <x-footer />
        </main>
    </div>
</x-layout>
