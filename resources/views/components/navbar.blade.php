<nav class="bg-white shadow-lg dark:bg-gray-900 dark:text-white transition-colors duration-200 fixed w-full z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      
      <!-- Logo -->
      <div class="flex-shrink-0">
        <a href="/" class="flex items-center">
            <img src="{{ asset('storage/logo/logo.png') }}" class="ml-2 h-[50px] w-[50px] group-hover:rotate-180 transition-transform"   />
          <span class="ml-2 text-xl font-bold text-gray-800 dark:text-white">Horizons Infinis</span>
        </a>
      </div>

      <!-- Right Side: Dark Mode Toggle + Menu -->
      <div class="flex items-center gap-4">
        
        <!-- Dark Mode Toggle Button -->
        <button id="theme-toggle" class="p-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
          <!-- Sun Icon (shown in dark mode) -->
          <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l-2.12-2.12a1 1 0 111.414-1.414l2.12 2.12a1 1 0 11-1.414 1.414zM2.05 11.464a1 1 0 111.414-1.414l2.12 2.12a1 1 0 11-1.414 1.414l-2.12-2.12zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 103.636 5.05l-2.12 2.12a1 1 0 001.414 1.414l2.12-2.12zm5.414-5.414l-2.12 2.12A1 1 0 007.05 3.636l2.12-2.12a1 1 0 011.414 1.414zM15 12a1 1 0 100-2h-1a1 1 0 100 2h1z" clip-rule="evenodd"></path>
          </svg>
          <!-- Moon Icon (shown in light mode) -->
          <svg id="theme-toggle-dark-icon" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>
        </button>

        <!-- Dropdown Menu -->
        <div class="relative group">
          <button class="inline-flex items-center justify-center px-4 py-2 rounded-md text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
            </svg>
            <span class="ml-2 text-sm font-medium">Menu</span>
            <svg class="ml-2 h-4 w-4 group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
          </button>

          <!-- Dropdown Content -->
          <div class="absolute right-0 mt-0 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10">
            
            <!-- Profile -->
            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 border-b dark:border-gray-700">
              <div class="flex items-center">
                <svg class="h-4 w-4 mr-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
                <span>Profile</span>
              </div>
            </a>

            <!-- Adventures -->
            <a href="{{ route('aventure.show',['aventure' => auth()->id()]) }}" class="block px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 border-b dark:border-gray-700">
              <div class="flex items-center">
                <svg class="h-4 w-4 mr-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                </svg>
                <span>Mon Adventures</span>
              </div>
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="m-0">
              @csrf
              <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                <div class="flex items-center">
                  <svg class="h-4 w-4 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                  </svg>
                  <span>Logout</span>
                </div>
              </button>
            </form>
          </div>
        </div>

      </div>

    </div>
  </div>
</nav>

<script>
  // Dark mode toggle
  const themeToggle = document.getElementById('theme-toggle');
  const htmlElement = document.documentElement;
  const lightIcon = document.getElementById('theme-toggle-light-icon');
  const darkIcon = document.getElementById('theme-toggle-dark-icon');

  // Check for saved theme preference or default to 'light'
  const currentTheme = localStorage.getItem('theme') || 'light';
  if (currentTheme === 'dark') {
    htmlElement.classList.add('dark');
    lightIcon.classList.remove('hidden');
    darkIcon.classList.add('hidden');
  }

  themeToggle.addEventListener('click', () => {
    if (htmlElement.classList.contains('dark')) {
      htmlElement.classList.remove('dark');
      localStorage.setItem('theme', 'light');
      lightIcon.classList.add('hidden');
      darkIcon.classList.remove('hidden');
    } else {
      htmlElement.classList.add('dark');
      localStorage.setItem('theme', 'dark');
      lightIcon.classList.remove('hidden');
      darkIcon.classList.add('hidden');
    }
  });
</script>