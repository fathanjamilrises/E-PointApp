<aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
    <div class="px-6 py-4 mt-2 flex items-center">
        <img class="w-24" src="{{ asset('storage/components/logo.png') }}" alt="Logo">
    </div>
    <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-3 py-2 rounded-md transition
            {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-100 hover:text-blue-700' }}">
            <svg class="w-5 h-5 mr-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('siswa.index') }}"
            class="flex items-center px-3 py-2 rounded-md transition
            {{ request()->routeIs('siswa.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-100 hover:text-blue-700' }}">
            <svg class="w-5 h-5 mr-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
            </svg>
            Data Siswa
        </a>

        <a href="{{ route('akun.index') }}"
            class="flex items-center px-3 py-2 rounded-md transition
            {{ request()->routeIs('akun.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-100 hover:text-blue-700' }}">
            <svg class="w-5 h-5 mr-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            Data Akun
        </a>

        <a href="{{ route('pelanggaran.index') }}"
            class="flex items-center px-3 py-2 rounded-md transition
            {{ request()->routeIs('pelanggaran.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-100 hover:text-blue-700' }}">
            <svg class="w-5 h-5 mr-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
            Data Pelanggaran
        </a>

        <a href="{{ route('pelanggar.index') }}"
            class="flex items-center px-3 py-2 rounded-md transition
            {{ request()->routeIs('pelanggar.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-100 hover:text-blue-700' }}">
            <svg class="w-5 h-5 mr-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
            </svg>
            Data Pelanggar
        </a>

        <form action="{{ route('logout') }}" method="POST" id="logout-form" class="mt-auto px-3 py-2">
            @csrf
            <button type="submit"
                class="w-full flex mt-5 border items-center justify-center px-3 py-2 rounded-md text-red-600 hover:bg-red-100 hover:text-red-700 transition font-semibold">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                Logout
            </button>
        </form>
    </nav>
</aside>
