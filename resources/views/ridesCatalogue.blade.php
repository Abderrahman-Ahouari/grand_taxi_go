<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RidesCatalogue - TaxiRide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #f59e0b;
            --primary-dark: #d97706;
            --secondary: #1e40af;
            --secondary-light: #3b82f6;
            --light: #f3f4f6;
            --dark: #1f2937;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
        }
        
        .taxi-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            background: white;
        }
        
        .taxi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .ride-price {
            font-weight: 700;
            color: var(--secondary);
            font-size: 1.5rem;
        }
        
        .book-button {
            background-color: var(--primary);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .book-button:hover {
            background-color: var(--primary-dark);
            transform: scale(1.05);
        }
        
        .navbar {
            background: linear-gradient(90deg, var(--secondary) 0%, var(--secondary-light) 100%);
        }
        
        .profile-menu {
            position: absolute;
            top: 60px;
            right: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 100;
        }
        
        .profile-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .divider {
            height: 1px;
            background-color: #e5e7eb;
            margin: 8px 0;
        }
        
        .footer {
            background: var(--dark);
            color: var(--light);
        }
        
        /* Card tag styles */
        .tag {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .tag-seats {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .tag-time {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        /* Location indicators */
        .location-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
        
        .start-dot {
            background-color: #10b981;
        }
        
        .end-dot {
            background-color: #ef4444;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 px-6 py-4 shadow-md navbar">
        <div class="container flex items-center justify-between mx-auto">
            <a href="#" class="flex items-center text-2xl font-bold text-white">
                <i class="mr-2 fas fa-taxi"></i>
               GrandTaxiGo
            </a>
            
            <div class="hidden space-x-8 md:flex">
                <a href="#" class="text-white transition duration-300 hover:text-yellow-200">Home</a>
                <a href="#" class="text-white transition duration-300 hover:text-yellow-200">About Us</a>
                <a href="#" class="font-bold text-white transition duration-300 hover:text-yellow-200">Rides</a>
            </div>
            
            <div class="relative">
                <button id="profileButton" class="p-2 text-white transition duration-300 rounded-full hover:bg-white/10">
                    <i class="text-xl fas fa-user-circle"></i>
                </button>
                
                <div id="profileMenu" class="w-48 px-3 py-2 profile-menu">
                    <a href="../profile/" class="block px-2 py-2 text-gray-700 transition duration-300 rounded-md hover:bg-gray-100">
                        <i class="mr-2 fas fa-user"></i> My Profile
                    </a>
                    <div class="divider"></div>
                    <a href="#" class="block px-2 py-2 text-red-500 transition duration-300 rounded-md hover:bg-red-50">
                        <i class="mr-2 fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
            
            <!-- Mobile Menu Button -->
            <button id="mobileMenuButton" class="text-white md:hidden">
                <i class="text-xl fas fa-bars"></i>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="absolute left-0 hidden w-full p-4 bg-white shadow-md md:hidden top-16">
            <div class="flex flex-col space-y-3">
                <a href="#" class="py-2 text-gray-800 transition duration-300 hover:text-blue-600">Home</a>
                <a href="#" class="py-2 text-gray-800 transition duration-300 hover:text-blue-600">About Us</a>
                <a href="#" class="py-2 font-bold text-gray-800 transition duration-300 hover:text-blue-600">Rides</a>
                <div class="divider"></div>
                <a href="#" class="flex items-center py-2 text-gray-800 transition duration-300 hover:text-blue-600">
                    <i class="mr-2 fas fa-user"></i> My Profile
                </a>
                <a href="#" class="flex items-center py-2 text-red-500 transition duration-300 hover:text-red-700">
                    <i class="mr-2 fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container px-4 py-8 mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Available Rides</h1>
            <div class="flex space-x-2">
                <button class="px-4 py-2 transition duration-300 bg-white border border-gray-200 rounded-md shadow-sm hover:bg-gray-50">
                    <i class="mr-2 fas fa-filter"></i> Filter
                </button>
                <button class="px-4 py-2 transition duration-300 bg-white border border-gray-200 rounded-md shadow-sm hover:bg-gray-50">
                    <i class="mr-2 fas fa-sort"></i> Sort
                </button>
            </div>
        </div>
        
        
        <!-- Rides Grid -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
              
            @foreach ($rides as $ride)
            <!-- Ride Card 5 -->
            <div class="shadow-md taxi-card">
                <div class="relative">
                    <div class="h-40 bg-gradient-to-r from-teal-500 to-green-500"></div>
                    <div class="absolute px-3 py-1 bg-white rounded-md shadow-md bottom-3 left-3">
                        <span class="font-bold text-gray-800">{{ $ride->departure_day }}</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="mb-4">
                        <div class="flex items-center mb-2">
                            <span class="location-dot start-dot"></span>
                            <p class="font-medium text-gray-700">{{$ride->start_location}}</p>
                        </div>
                        <div class="border-l-2 border-dashed border-gray-300 h-6 ml-1.5"></div>
                        <div class="flex items-center">
                            <span class="location-dot end-dot"></span>
                            <p class="font-medium text-gray-700">{{$ride->end_location}}</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mb-4">
                        <span class="tag tag-time">
                            <i class="mr-1 far fa-clock"></i> {{$ride->departure_time}}
                        </span>
                        <span class="tag tag-seats">
                            <i class="mr-1 fas fa-user"></i> {{$ride->available_seats}}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="ride-price">${{$ride->price}}</div>

                        <form action="{{ route('rideReservation', ['id' => $ride->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="trajet_id" value="{{ $ride->id }}">
                            <button type="submit" class="px-4 py-2 font-semibold text-white transition bg-gray-500 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                Réserver
                            </button>
                        </form>
                    {{-- <form action="{{ route('rideReservation') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ride_id" value="{{$ride->id}}">
                        <button type="submit" class="book-button">Book Now</button>
                    </form> --}}
                    </div>
                </div>
            </div>
            @endforeach        

        </div>
        
        <!-- Pagination -->
        <div class="flex justify-center mt-10">
            <nav class="inline-flex rounded-md shadow">
                <a href="#" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">
                    Previous
                </a>
                <a href="#" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border-t border-b border-gray-300">
                    1
                </a>
                <a href="#" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border-t border-b border-gray-300 hover:bg-gray-50">
                    2
                </a>
                <a href="#" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border-t border-b border-gray-300 hover:bg-gray-50">
                    3
                </a>
                <a href="#" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">
                    Next
                </a>
            </nav>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-10 mt-16 footer">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <div>
                    <h3 class="mb-4 text-xl font-bold text-white">TaxiRide</h3>
                    <p class="mb-4 text-gray-300">The most reliable taxi service in the city. Book your ride anytime, anywhere.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 transition duration-300 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-300 transition duration-300 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-300 transition duration-300 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="mb-4 text-lg font-semibold text-white">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 transition duration-300 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-300 transition duration-300 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-300 transition duration-300 hover:text-white">Rides</a></li>
                        <li><a href="#" class="text-gray-300 transition duration-300 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="mb-4 text-lg font-semibold text-white">Contact</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-300">
                            <i class="mt-1 mr-2 fas fa-map-marker-alt"></i>
                            <span>123 City Street, Downtown</span>
                        </li>
                        <li class="flex items-center text-gray-300">
                            <i class="mr-2 fas fa-phone-alt"></i>
                            <span>+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-center text-gray-300">
                            <i class="mr-2 fas fa-envelope"></i>
                            <span>info@taxiride.com</span>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="mb-4 text-lg font-semibold text-white">Newsletter</h3>
                    <p class="mb-4 text-gray-300">Subscribe to get updates on our latest offers.</p>
                    <div class="flex">
                        <input type="email" placeholder="Your email" class="w-full px-4 py-2 text-white bg-gray-700 rounded-l-md focus:outline-none">
                        <button class="px-4 py-2 text-white transition duration-300 bg-yellow-500 hover:bg-yellow-600 rounded-r-md">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="pt-6 mt-8 text-center text-gray-400 border-t border-gray-700">
                <p>&copy; 2025 TaxiRide. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Profile dropdown toggle
        const profileButton = document.getElementById('profileButton');
        const profileMenu = document.getElementById('profileMenu');
        
        profileButton.addEventListener('click', function() {
            profileMenu.classList.toggle('active');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!profileButton.contains(event.target) && !profileMenu.contains(event.target)) {
                profileMenu.classList.remove('active');
            }
        });
        
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            
            // Toggle icon
            const icon = mobileMenuButton.querySelector('i');
            if (icon.classList.contains('fa-bars')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    </script>
</body>
</html>