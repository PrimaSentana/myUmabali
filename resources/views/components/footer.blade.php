<footer class="bg-[#FDFDFC] border-t border-gray-200 text-gray-700 mt-12">
    <!-- Bagian Atas -->
    {{-- grid grid-cols-1 md:grid-cols-3 --}}
    <div class="container mx-auto px-6 py-12  gap-10"> 

        <!-- Kiri -->
        <div class="flex justify-between">
            <div>
                <h3 class="text-sm text-gray-500 uppercase mb-2 tracking-wide">Contact Us</h3>
                <h2 class="text-2xl font-semibold leading-snug mb-4">
                    Let’s Discuss Your Vision.<br>With Us
                </h2>
                <button class="inline-flex items-center gap-2 bg-gray-900 text-white px-5 py-2 rounded-full text-sm hover:bg-gray-800 transition">
                    Schedule a call now
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12l-3.75 3.75M21 12H3" />
                    </svg>
                </button>

                <p class="text-xs uppercase text-gray-500 mt-6 mb-2">Or reach us at</p>
                <div class="flex items-center bg-gray-100 rounded-full px-4 py-2 w-fit gap-2">
                    <span class="text-sm text-gray-700 select-all">hey@umabali.id</span>
                    <button onclick="navigator.clipboard.writeText('hey@umabali.id')" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8m-8-4h8m-8-4h8M5 8h.01M5 12h.01M5 16h.01M3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Tengah -->
            <div class="flex flex-col sm:flex-row md:flex-col lg:flex-row justify-between gap-20">
                <div>
                    <h4 class="text-sm text-gray-500 uppercase mb-2 tracking-wide">Quick Links</h4>
                    <ul class="space-y-1">
                        <li><a href="#" class="hover:text-gray-900 transition">Home</a></li>
                        <li><a href="#" class="hover:text-gray-900 transition">Gallery</a></li>
                        <li><a href="#" class="hover:text-gray-900 transition">Blog</a></li>
                        <li><a href="#" class="hover:text-gray-900 transition">About Us</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm text-gray-500 uppercase mb-2 tracking-wide">Information</h4>
                    <ul class="space-y-1">
                        <li><a href="#" class="hover:text-gray-900 transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-gray-900 transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-gray-900 transition">Cookies Settings</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Kanan -->
        <div class="mt-12">
            <div></div>
            <div class="flex gap-4 justify-end">
                <!-- GitHub -->
                <a href="https://github.com/" target="_blank" class="text-gray-600 hover:text-gray-900 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                        <path d="M12 .5C5.73.5.5 5.73.5 12a11.5 11.5 0 0 0 7.84 10.93c.57.1.78-.25.78-.56v-2.03c-3.18.69-3.85-1.53-3.85-1.53-.52-1.3-1.26-1.64-1.26-1.64-1.03-.7.08-.68.08-.68 1.14.08 1.74 1.18 1.74 1.18 1.01 1.74 2.65 1.24 3.3.95.1-.73.4-1.24.73-1.52-2.54-.29-5.22-1.27-5.22-5.67 0-1.25.45-2.27 1.18-3.07-.12-.29-.51-1.47.11-3.07 0 0 .96-.31 3.15 1.18a10.9 10.9 0 0 1 5.74 0c2.19-1.49 3.15-1.18 3.15-1.18.62 1.6.23 2.78.11 3.07.73.8 1.18 1.82 1.18 3.07 0 4.41-2.68 5.38-5.24 5.66.41.36.77 1.08.77 2.18v3.23c0 .31.21.67.79.56A11.5 11.5 0 0 0 23.5 12C23.5 5.73 18.27.5 12 .5Z" />
                    </svg>
                </a>

                <!-- Instagram -->
                <a href="https://instagram.com/" target="_blank" class="text-gray-600 hover:text-gray-900 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                        <path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm10 2c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3h10zm-5 3a5 5 0 1 0 .001 10.001A5 5 0 0 0 12 7zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6zm4.5-.75a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5z" />
                    </svg>
                </a>

                <!-- LinkedIn -->
                <a href="https://linkedin.com/" target="_blank" class="text-gray-600 hover:text-gray-900 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                        <path d="M4.98 3.5A2.5 2.5 0 1 1 5 8.5 2.5 2.5 0 0 1 4.98 3.5zM3 9h4v12H3zm7 0h3.8v1.7h.1c.5-.9 1.8-1.9 3.7-1.9 3.9 0 4.6 2.6 4.6 6v6.2h-4V16c0-1.4 0-3.2-2-3.2s-2.3 1.5-2.3 3.1v5.1H10z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Bagian Bawah -->
    <div class="border-t border-gray-200 py-4 text-center text-sm text-gray-500">
        © 2025 UmaBali. All rights reserved.
    </div>
</footer>
