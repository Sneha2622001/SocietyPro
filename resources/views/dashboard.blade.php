{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- Notifications Section -->
            <div class="mt-6 bg-white dark:bg-gray-900 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Notifications</h3>

                @if(Auth::user()->notifications->count() > 0)
                    <ul class="divide-y divide-gray-300 dark:divide-gray-600">
                        @foreach(Auth::user()->unreadNotifications as $notification)
                            <li class="py-2">
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-700 dark:text-gray-300">
                                        {{ $notification->data['message'] }}
                                    </p>
                                    <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                            Mark as Read
                                        </button>
                                    </form>
                                </div>
                                <small class="text-gray-500 dark:text-gray-400">
                                    {{ $notification->created_at->diffForHumans() }}
                                </small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 dark:text-gray-400">No new notifications.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
