<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$notifications" />

        <main class="h-auto p-4 pt-20 md:ml-64">
            <div class="flex justify-between">
                <x-ui.heading>
                    Account Settings
                </x-ui.heading>
            </div>

            <x-application.layout>
                <x-account-settings.layout>
                    <x-account-settings.account-settings :avatar="$avatar->where('user_id', Auth::id())" :user="$user->find(Auth::id())"/>
                </x-account-settings.layout>
            </x-application.layout>


            <x-footer />
        </main>
    </div>
</x-layout>
