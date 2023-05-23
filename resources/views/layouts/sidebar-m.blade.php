<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <ul>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span class="ml-3">Applications</span>
                </a>
                <ul class="w-11/12 ml-auto">
                    <li>
                        <a href="#"
                            class="flex items-center py-2 px-1 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="ml-3">All Applications</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center py-2 px-1 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="ml-3">Create</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('branch') }}"
                    class="{{ request()->path() == 'branch' ? 'bg-gray-100' : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span class="ml-3">Branches</span>
                </a>
                <ul class="w-11/12 ml-auto">
                    <li>
                        <a href="{{ route('branch') }}"
                            class="flex items-center py-2 px-1 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="ml-3">All Branches</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('branch.create') }}"
                            class="{{ request()->path() == 'branch.create' ? 'bg-gray-100' : '' }} flex items-center py-2 px-1 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="ml-3">Create</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('user') }}"
                    class="{{ request()->path() == 'user' ? 'bg-gray-100' : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span class="ml-3">Users</span>
                </a>
                <ul class="w-11/12 ml-auto">
                    <li>
                        <a href="{{ route('user') }}"
                            class="flex items-center py-2 px-1 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="ml-3">All Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.create') }}"
                            class="{{ request()->path() == 'user/create' ? 'bg-gray-100' : '' }} flex items-center py-2 px-1 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="ml-3">Create</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('profile') }}"
                    class="{{ request()->path() == 'profile' ? 'bg-gray-100' : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span class="ml-3">Profile</span>
                </a>
            </li>
            <li class="">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="ml-3">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</aside>
