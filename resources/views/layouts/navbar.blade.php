<div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
    <button
        class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
        <span class="sr-only">Open sidebar</span>
        <!-- Heroicon name: outline/menu-alt-2 -->
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h7"/>
        </svg>
    </button>
    <div class="flex-1 px-4 flex justify-end">
        <div class="ml-4 flex items-center md:ml-6">
            <!-- Profile dropdown -->
            <div class="ml-3 relative" x-data="{ isOpen: false }">
                <div>
                    <button type="button" @click="isOpen = !isOpen"
                            class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <span
                            class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gray-500">
                                        <span
                                            class="text-sm font-medium leading-none text-white">{{ Auth::user()->initials }}</span>
                                    </span>
                    </button>
                </div>
                <div
                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                    tabindex="-1"
                    x-show="isOpen"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-10"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-955"
                    class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg">
                    <!-- Active: "bg-gray-100", Not Active: "" -->
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                       tabindex="-1"
                       id="user-menu-item-0">Profile</a>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700"
                       role="menuitem" tabindex="-1"
                       id="user-menu-item-2"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
