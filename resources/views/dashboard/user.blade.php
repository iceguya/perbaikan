<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
<body class="font-sans antialiased bg-gray-100">

    <div class="relative bg-gradient-to-br from-indigo-500 to-purple-600 pt-16 pb-24 lg:pt-24 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8 lg:items-center">
                <div class="lg:col-span-6 text-center lg:text-left">
                    <h1 class="mt-4 text-4xl font-extrabold text-white sm:mt-5 sm:text-5xl lg:mt-6 xl:text-6xl">
                        Explore Over <br class="hidden md:block">
                        <span class="block text-indigo-200">HIRAWR</span> Opportunities
                    </h1>
                    <p class="mt-3 text-base text-indigo-100 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                        Find your dream job among thousands of listings.
                    </p>
                    <div class="mt-10 max-w-lg mx-auto sm:max-w-none sm:flex sm:justify-center lg:justify-start">
                        <div class="flex items-center w-full">
                            <input type="text" placeholder="Job Title, Keywords..." class="block w-full px-5 py-3 border border-transparent rounded-l-md text-gray-900 placeholder-gray-500 shadow-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                            <button class="flex items-center justify-center px-5 py-3 border border-transparent rounded-r-md shadow-sm text-base font-medium text-white bg-indigo-700 hover:bg-indigo-800">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                                Find Job
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-12 lg:mt-0 lg:col-span-6 lg:flex lg:justify-end">
                    <img class="max-w-full h-auto lg:max-h-[400px] object-cover" src="https://via.placeholder.com/400x400/9b59b6/ffffff?text=Man+Pointing" alt="Man pointing">
                </div>
            </div>
        </div>
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">Explore by Category</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <div class="bg-gray-50 rounded-lg p-6 text-center shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex justify-center mb-4">
                        <svg class="h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 .895 3 2s-1.343 2-3 2-3-.895-3-2 1.343-2 3-2z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Design</h3>
                    <p class="mt-1 text-sm text-gray-500">12 Jobs</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-6 text-center shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex justify-center mb-4">
                        <svg class="h-12 w-12 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4m-4 4l-4 4M6 9h6" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Technology</h3>
                    <p class="mt-1 text-sm text-gray-500">20 Jobs</p>
                </div>
                 <div class="bg-gray-50 rounded-lg p-6 text-center shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex justify-center mb-4">
                        <svg class="h-12 w-12 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Engineering</h3>
                    <p class="mt-1 text-sm text-gray-500">15 Jobs</p>
                </div>
                 <div class="bg-gray-50 rounded-lg p-6 text-center shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex justify-center mb-4">
                        <svg class="h-12 w-12 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v14M9 19a2 2 0 002 2h3a2 2 0 002-2M9 19C7.6 19 6.2 18.2 6.2 17s1.4-.8 2.8-.8m-2.8.8L9 6" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Finance</h3>
                    <p class="mt-1 text-sm text-gray-500">8 Jobs</p>
                </div>
                 <div class="bg-gray-50 rounded-lg p-6 text-center shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex justify-center mb-4">
                        <svg class="h-12 w-12 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4m-4 4l-4 4M6 9h6" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Programming</h3>
                    <p class="mt-1 text-sm text-gray-500">25 Jobs</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-20 bg-indigo-600 bg-opacity-90 text-white text-center">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-extrabold mb-4">Start Recruiting Now</h2>
            <p class="text-xl opacity-80 mb-8">
                Post your job today and find the perfect candidate.
            </p>
            <a href="#" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-100">
                Post a Job
            </a>
        </div>
    </div>

    <div class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900">Featured Jobs</h2>
                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">View All Jobs &rarr;</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <img class="h-12 w-12 rounded-full mr-4" src="https://via.placeholder.com/48x48/F44336/FFFFFF?text=A" alt="Company Logo">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">Community Manager</h3>
                            <p class="text-gray-600">Company A</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">
                        We are looking for a community manager to engage with our users.
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-indigo-600">Full-time</span>
                        <span class="text-lg font-bold text-gray-900">$70,000 - $90,000</span>
                    </div>
                    <a href="#" class="mt-4 block text-center text-indigo-600 hover:text-indigo-800 font-medium">View Details &rarr;</a>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <img class="h-12 w-12 rounded-full mr-4" src="https://via.placeholder.com/48x48/4CAF50/FFFFFF?text=B" alt="Company Logo">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">Visual Designer</h3>
                            <p class="text-gray-600">Company B</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Creative visual designer needed for a growing startup.
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-indigo-600">Part-time</span>
                        <span class="text-lg font-bold text-gray-900">$50/hour</span>
                    </div>
                    <a href="#" class="mt-4 block text-center text-indigo-600 hover:text-indigo-800 font-medium">View Details &rarr;</a>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <img class="h-12 w-12 rounded-full mr-4" src="https://via.placeholder.com/48x48/2196F3/FFFFFF?text=C" alt="Company Logo">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">Data Analyst</h3>
                            <p class="text-gray-600">Company C</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Seeking a data analyst to interpret complex data sets.
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-indigo-600">Full-time</span>
                        <span class="text-lg font-bold text-gray-900">$80,000 - $100,000</span>
                    </div>
                    <a href="#" class="mt-4 block text-center text-indigo-600 hover:text-indigo-800 font-medium">View Details &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900">Latest Jobs Post</h2>
                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">View All Jobs &rarr;</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-lg shadow-sm p-6">
                    <div class="flex items-center mb-4">
                        <img class="h-10 w-10 rounded-full mr-3" src="https://via.placeholder.com/40x40/FFC107/FFFFFF?text=D" alt="Company Logo">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Senior React Developer</h3>
                            <p class="text-gray-600 text-sm">Company D</p>
                        </div>
                    </div>
                    <p class="text-gray-700 text-sm mb-3">
                        Join our team as a Senior React Developer...
                    </p>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-gray-500">Full-time</span>
                        <span class="font-bold text-gray-800">$100k+</span>
                    </div>
                    <a href="#" class="mt-3 block text-center text-indigo-600 hover:text-indigo-800 text-sm font-medium">View Details &rarr;</a>
                </div>
                <div class="bg-gray-50 rounded-lg shadow-sm p-6">
                    <div class="flex items-center mb-4">
                        <img class="h-10 w-10 rounded-full mr-3" src="https://via.placeholder.com/40x40/9C27B0/FFFFFF?text=E" alt="Company Logo">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Mobile App Developer</h3>
                            <p class="text-gray-600 text-sm">Company E</p>
                        </div>
                    </div>
                    <p class="text-gray-700 text-sm mb-3">
                        We need a talented mobile app developer for iOS/Android...
                    </p>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-gray-500">Contract</span>
                        <span class="font-bold text-gray-800">$70/hour</span>
                    </div>
                    <a href="#" class="mt-3 block text-center text-indigo-600 hover:text-indigo-800 text-sm font-medium">View Details &rarr;</a>
                </div>
                 <div class="bg-gray-50 rounded-lg shadow-sm p-6">
                    <div class="flex items-center mb-4">
                        <img class="h-10 w-10 rounded-full mr-3" src="https://via.placeholder.com/40x40/00BCD4/FFFFFF?text=F" alt="Company Logo">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Marketing Specialist</h3>
                            <p class="text-gray-600 text-sm">Company F</p>
                        </div>
                    </div>
                    <p class="text-gray-700 text-sm mb-3">
                        Seeking an experienced marketing specialist for digital campaigns...
                    </p>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-gray-500">Full-time</span>
                        <span class="font-bold text-gray-800">$60k+</span>
                    </div>
                    <a href="#" class="mt-3 block text-center text-indigo-600 hover:text-indigo-800 text-sm font-medium">View Details &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-gray-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">CMouse</h3>
                    <p class="text-gray-400 text-sm">
                        Find your dream job effortlessly. We connect talented individuals with great companies.
                    </p>
                </div>

                <div>
                    <h4 class="font-semibold text-lg mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold text-lg mb-4">Categories</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-white">Design</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Development</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Marketing</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Finance</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold text-lg mb-4">Subscribe Our Newsletter</h4>
                    <form class="flex">
                        <input type="email" placeholder="Your email address" class="flex-grow px-4 py-2 rounded-l-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-900">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-r-md">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-500 text-sm">
                &copy; 2023 CMouse. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>