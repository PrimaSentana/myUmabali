<header class="bg-gray-50 shadow-md w-full">
  <!-- Baris atas -->
  <div class="w-full flex items-center justify-between px-8 py-3">
    <!-- Kiri: Logo -->
      <a href="/">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('images/UmaBali_Logo.png') }}" alt="Logo" width="60" class="rounded-full">
            <span class="font-bold text-2xl text-gray-900">UmaBali</span>
            @auth
              <div class="px-4">
                <span class="font-bold text-xl text-gray-900">Hi, {{Auth::user()->name}}!</span>
              </div>
            @endauth
        </div>
      </a>
    

    <!-- Tengah: Menu -->
    @auth
      <nav class="flex items-center space-x-2">
        <div class="w-full flex justify-center py-4">
          <div class="bg-white shadow-xl rounded-full flex items-center divide-x divide-gray-300 overflow-hidden">
          <!-- Lokasi -->
          <div class="px-6 py-3 hover:bg-gray-100 cursor-pointer">
              <p class="text-xs font-semibold text-gray-800">Lokasi</p>
              <p class="text-sm text-gray-500">Cari Destinasi</p>
          </div>
          <!-- Tanggal -->
          <div class="px-6 py-3 hover:bg-gray-100 cursor-pointer">
              <p class="text-xs font-semibold text-gray-800">Tanggal</p>
              <p class="text-sm text-gray-500">Tambahkan Tanggal</p>
          </div>
          <!-- Tamu -->
          <div class="px-6 py-3 hover:bg-gray-100 cursor-pointer">
              <p class="text-xs font-semibold text-gray-800">Tamu</p>
              <p class="text-sm text-gray-500">Tambahkan Tamu</p>
          </div>
          <!-- Tombol Cari -->
          <button class="bg-black text-white rounded-full p-3 my-2 mx-4 flex items-center justify-center hover:bg-gray-800">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round"
                      d="m21 21-4.35-4.35m0 0a7.5 7.5 0 1 0-10.6-10.6 7.5 7.5 0 0 0 10.6 10.6z"/>
              </svg>
          </button>
          </div>
      </div>
    </nav>
    @endauth
    @guest
      <nav class="flex items-center ml-30 space-x-2">
        <div class="w-full flex justify-center py-4">
          <div class="bg-white shadow-xl rounded-full flex items-center divide-x divide-gray-300 overflow-hidden">
          <!-- Lokasi -->
          <div class="px-6 py-3 hover:bg-gray-100 cursor-pointer">
              <p class="text-xs font-semibold text-gray-800">Lokasi</p>
              <p class="text-sm text-gray-500">Cari Destinasi</p>
          </div>
          <!-- Tanggal -->
          <div class="px-6 py-3 hover:bg-gray-100 cursor-pointer">
              <p class="text-xs font-semibold text-gray-800">Tanggal</p>
              <p class="text-sm text-gray-500">Tambahkan Tanggal</p>
          </div>
          <!-- Tamu -->
          <div class="px-6 py-3 hover:bg-gray-100 cursor-pointer">
              <p class="text-xs font-semibold text-gray-800">Tamu</p>
              <p class="text-sm text-gray-500">Tambahkan Tamu</p>
          </div>
          <!-- Tombol Cari -->
          <button class="bg-black text-white rounded-full p-3 my-2 mx-4 flex items-center justify-center hover:bg-gray-800">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round"
                      d="m21 21-4.35-4.35m0 0a7.5 7.5 0 1 0-10.6-10.6 7.5 7.5 0 0 0 10.6 10.6z"/>
              </svg>
          </button>
          </div>
      </div>
    </nav>
    @endguest

    <!-- Kanan: Aksi -->
    <div class="flex items-center space-x-4">

      <!-- Menjadi Tuan Rumah -->

    @auth()
      <a href="/form/penginapan"
        class="px-4 py-2 rounded-full text-black font-semibold bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
        Menjadi Tuan Rumah
      </a>
    @endauth
    @guest
      <a href="/login"
        class="px-4 py-2 rounded-full text-black font-semibold bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
        Menjadi Tuan Rumah
      </a>
    @endguest


      <!-- Ikon User (Dropdown) -->
      <div x-data="{ openUser: false }" class="relative">
        <button @click="openUser = !openUser" class="flex items-center justify-center h-8 w-8 rounded-full bg-black text-white cursor-pointer hover:bg-gray-800">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
               stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 19.5a8.25 8.25 0 0 1 15 0v.75H4.5v-.75Z"/>
          </svg>
        </button>

        <!-- Dropdown User -->
        @guest
          <div x-show="openUser"
             @click.away="openUser = false"
             x-transition
             class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg border border-gray-100 z-50">
            <a href="/login"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-lg">
              Log in
            </a>
            <a href="/register"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-lg">
              Sign up
            </a>
          </div>
        @endguest

        @auth
          <div x-show="openUser"
             @click.away="openUser = false"
             x-transition
             class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg border border-gray-100 z-50">
            <a href="/profile"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-lg">
              View Profile
            </a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf

              <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-lg" href="route('logout')"
                      onclick="event.preventDefault();
                                  this.closest('form').submit();">
                  {{ __('Log Out') }}
              </a>
            </form>
            {{-- <a href="/logout"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-lg">
              Logout
            </a> --}}
          </div>
        @endauth
      </div>

      <!-- Ikon Menu (Dropdown) -->
      <div x-data="{ openMenu: false }" class="relative">
        <button @click="openMenu = !openMenu" class="flex items-center justify-center h-8 w-8 rounded-full border border-black text-black cursor-pointer hover:bg-gray-200  transition-colors duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
               stroke-width="2" stroke="currentColor" class="h-5 w-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>

        <!-- Dropdown Menu -->
        <div x-show="openMenu"
             @click.away="openMenu = false"
             x-transition
             class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-100 z-50">
          <a href="{{ route('listings.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-t-lg">
            Menjadi Tuan Rumah
          </a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
            Reservasi
          </a>
          <a href="{{ route('menu.favorite') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-b-lg">
            Favorite
          </a>
          <a href="{{ route('menu.penginapan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-b-lg">
            Penginapan
          </a>
        </div>
      </div>
    </div>
  </div>


  <!-- Baris bawah: Search bar -->
  {{-- <div class="w-full flex justify-center pb-8">
    <div class="bg-white shadow-xl rounded-full flex items-center divide-x divide-gray-300 overflow-hidden">
      <!-- Lokasi -->
      <div class="px-6 py-3 hover:bg-gray-100 cursor-pointer">
        <p class="text-xs font-semibold text-gray-800">Lokasi</p>
        <p class="text-sm text-gray-500">Cari Destinasi</p>
      </div>
      <!-- Tanggal -->
      <div class="px-6 py-3 hover:bg-gray-100 cursor-pointer">
        <p class="text-xs font-semibold text-gray-800">Tanggal</p>
        <p class="text-sm text-gray-500">Tambahkan Tanggal</p>
      </div>
      <!-- Tamu -->
      <div class="px-6 py-3 hover:bg-gray-100 cursor-pointer">
        <p class="text-xs font-semibold text-gray-800">Tamu</p>
        <p class="text-sm text-gray-500">Tambahkan Tamu</p>
      </div>
      <!-- Tombol Cari -->
      <button class="bg-black text-white rounded-full p-3 m-2 flex items-center justify-center hover:bg-gray-800">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="2" stroke="currentColor" class="w-5 h-5">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-4.35-4.35m0 0a7.5 7.5 0 1 0-10.6-10.6 7.5 7.5 0 0 0 10.6 10.6z"/>
        </svg>
      </button>
    </div>
  </div> --}}
</header>
