@props(['user', 'avatar'])
<x-application-shell>
    <x-ui.post-card>
        <x-account-settings.profile-form :avatar="$avatar" :user="$user" />
    </x-ui.post-card>
</x-application-shell>
