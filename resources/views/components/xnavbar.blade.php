<header class="bg-gray-50 shadow-md w-full relative z-40">
  <div class="w-full flex flex-wrap md:flex-nowrap items-center justify-between px-4 md:px-8 py-3 transition-all duration-300">
    
    <a href="/" class="flex-none">
      <div class="flex items-center space-x-2">
          <img src="{{ asset('images/umabali-v2.png') }}" alt="Logo" width="150" class="rounded-full md:w-[210px]">

          {{-- Ga dipake --}}
          {{-- <span class="font-bold text-xl md:text-2xl text-gray-900 hidden sm:block">UmaBali</span> --}}
{{--      @auth
            <div class="px-2 md:px-4 hidden lg:block">
              <span class="font-bold text-sm md:text-xl text-gray-900">Hi, {{Auth::user()->name}}!</span>
            </div>
          @endauth --}}
      </div>
    </a>

    {{-- profile --}}
    <div class="flex items-center space-x-2 md:space-x-4 order-2 md:order-3">
  
      @auth()
        <a href="/form/penginapan"
          class="hidden text-center lg:block lg:min-w-44 px-4 py-2 rounded-full text-black font-semibold bg-gray-50 hover:bg-gray-100 transition-colors duration-200 text-sm">
          Menjadi Tuan Rumah
        </a>
      @endauth
      @guest
        <a href="/login"
          class="hidden text-center lg:block lg:min-w-44 px-4 py-2 rounded-full text-black font-semibold bg-gray-50 hover:bg-gray-100 transition-colors duration-200 text-sm">
          Menjadi Tuan Rumah
        </a>
      @endguest
  
      
      <div x-data="{ openUser: false }" class="relative">
        <button @click="openUser = !openUser" class="flex items-center justify-center h-8 w-8 rounded-full bg-black text-white cursor-pointer hover:bg-gray-800">
          @auth
              <div class="rounded-full object-cover w-8 h-8">
                <img src="{{ asset('storage/' . Auth::user()->images) }}" alt="" class="rounded-full object-cover block w-8 h-8">
              </div>
          @endauth
          @guest
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 19.5a8.25 8.25 0 0 1 15 0v.75H4.5v-.75Z"/>
              </svg>
          @endguest
          
        </button>
  
        <div x-show="openUser" 
             @click.away="openUser = false"
             x-transition
             style="display: none;"
             class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-100 z-50">
           @guest
            <a href="/login" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-lg">Log in</a>
            <a href="/register" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-lg">Sign up</a>
           @endguest
           @auth
            <a href="/form/penginapan" class="block lg:hidden px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-semibold">Menjadi Tuan Rumah</a>
            <hr class="lg:hidden border-gray-200">
            <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View Profile</a>
            <form method="POST" action="{{ route('logout') }}">
               @csrf
               <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-lg" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); this.closest('form').submit();">
                  {{ __('Log Out') }}
               </a>
            </form>
           @endauth
        </div>
      </div>
  
      {{-- hamburger --}}
      <div x-data="{ openMenu: false }" class="relative">
        <button @click="openMenu = !openMenu" class="flex items-center justify-center h-8 w-8 rounded-full border border-black text-black cursor-pointer hover:bg-gray-200 transition-colors duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
               stroke-width="2" stroke="currentColor" class="h-5 w-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
        <div x-show="openMenu"
             @click.away="openMenu = false"
             x-transition
             style="display: none;"
             class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-100 z-50">
          <a href="{{ route('listings.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Menjadi Tuan Rumah</a>
          <a href="{{ route('reservation.my') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Reservasi</a>
          <a href="{{ route('menu.favorite') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Favorite</a>
          <a href="{{ route('menu.penginapan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Penginapan</a>
          <a href="{{ route('booking.my') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-lg">Booking List</a>
        </div>
      </div>
    </div>
  
    {{-- navbar --}}
    <nav class="w-full order-3 md:order-2 mt-4 md:mt-0 flex justify-center">
      <form action="/search" method="GET" class="w-full md:w-auto">
        @csrf
        <div class="w-full bg-white shadow-md md:shadow-xl rounded-full flex items-center divide-x divide-gray-300 overflow-hidden border border-gray-200 md:border-none">
          <div class="px-3 md:px-4 py-2 cursor-pointer flex-1 md:flex-none">
              <p class="text-[10px] md:text-xs text-center font-semibold text-gray-800">Lokasi</p>
              <input type="text" id="location_value" name="location_value" class="w-full md:w-32 lg:w-40 h-6 md:h-8 mt-1 text-center text-xs md:text-sm rounded-xl border-none focus:ring-0 p-0" placeholder="Jimbaran, Badung">
          </div>
          
          <div class="px-2 md:px-3 py-2 cursor-pointer flex-1 md:flex-none">
              <p class="text-[10px] md:text-xs text-center font-semibold text-gray-800">Tanggal</p>
              <input required type="text" id="date_range" name="date_range" placeholder="Hari ini" class="w-full md:w-32 lg:w-40 h-6 md:h-8 mt-1 text-center text-xs md:text-sm rounded-xl border-none focus:ring-0 p-0">
          </div>
          
          <div class="px-2 md:px-3 py-2 cursor-pointer w-16 md:w-auto">
              <p class="text-[10px] md:text-xs text-center font-semibold text-gray-800">Tamu</p>
              <input type="number" id="guest_count" placeholder="1" name="guest_count" class="w-full md:w-16 h-6 md:h-8 mt-1 rounded-xl text-center text-xs md:text-sm border-none focus:ring-0 p-0">
          </div>
          
          <button type="submit" class="bg-rose-500 text-white rounded-full p-2 md:p-3 my-1 md:my-2 mx-2 flex-none flex items-center justify-center hover:bg-rose-600 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5">
              <path stroke-linecap="round" stroke-linejoin="round"
                      d="m21 21-4.35-4.35m0 0a7.5 7.5 0 1 0-10.6-10.6 7.5 7.5 0 0 0 10.6 10.6z"/>
              </svg>
          </button>
        </div>
      </form>
    </nav>
  </div>
</header>