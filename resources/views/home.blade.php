<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Municipality of Malvar - Environmental Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }

        .hero-gradient {
            background: linear-gradient(120deg, rgba(5, 90, 20, 0.9) 0%, rgba(16, 126, 76, 0.85) 100%);
            position: relative;
        }

        .hero-gradient::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%23ffffff' fill-opacity='0.1' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E");
            opacity: 0.6;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        }

        .tab-button {
            transition: all 0.2s ease;
        }

        .tab-button:hover:not(.active) {
            background-color: #f0fdf4;
        }

        .progress-bar {
            transition: width 1s ease-in-out;
        }

        .section-transition {
            position: relative;
            height: 50px;
            margin-top: -50px;
            z-index: 10;
        }

        .white-to-green {
            background: linear-gradient(to bottom, #ffffff 0%, #f0fdf4 100%);
        }

        .green-to-white {
            background: linear-gradient(to bottom, #f0fdf4 0%, #ffffff 100%);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header with Mobile Responsiveness -->
    <header class="sticky top-0 z-50 text-white shadow-lg bg-gradient-to-r from-green-800 to-green-700">
        <div class="container px-4 py-3 mx-auto">
            <div class="flex flex-wrap items-center justify-between">
                <!-- Logo and Title -->
                <div class="flex items-center">
                    <div class="flex items-center p-1 bg-white rounded-full shadow-md bg-opacity-10 backdrop-blur-sm">
                        <img src="{{ asset('images/malvar_logo.jpg') }}" alt="Malvar Logo"
                            class="w-10 h-10 border-2 border-white rounded-full sm:w-12 sm:h-12 border-opacity-30">
                    </div>
                    <div class="ml-3">
                        <h1 class="text-base font-bold sm:text-xl">Municipality of Malvar</h1>
                        <p class="text-xs text-green-100 sm:text-sm">Environmental Management System</p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <!-- Admin button - always visible -->
                    <div class="flex md:hidden">
                        <a href="{{ url('/admin') }}"
                            class="px-3 py-1.5 text-sm font-medium bg-white bg-opacity-20 hover:bg-opacity-30 rounded-lg transition-all shadow-sm backdrop-blur-sm">
                            Admin
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" type="button"
                        class="p-2 text-white transition-all rounded-lg md:hidden hover:bg-white hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-green-200">
                        <span class="sr-only">Open main menu</span>
                        <!-- Hamburger icon -->
                        <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <!-- X icon (hidden by default) -->
                        <svg id="close-icon" class="hidden w-6 h-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Navigation Menu -->
                <nav id="navigation-menu"
                    class="flex-col hidden w-full mt-4 md:flex md:flex-row md:items-center md:w-auto md:mt-0 md:ml-auto">
                    <div class="flex flex-col space-y-3 md:flex-row md:space-y-0 md:space-x-6">
                        <a href="#announcements"
                            class="py-2 transition-colors border-b border-green-700 md:border-0 hover:text-green-200">Announcements</a>
                        <a href="#waste-collection"
                            class="py-2 transition-colors border-b border-green-700 md:border-0 hover:text-green-200">Waste
                            Collection</a>
                        <a href="#documents"
                            class="py-2 transition-colors border-b border-green-700 md:border-0 hover:text-green-200">Documents</a>
                        <a href="#barangays"
                            class="py-2 transition-colors border-b border-green-700 md:border-0 hover:text-green-200">Barangays</a>
                        <a href="#officials" class="py-2 transition-colors hover:text-green-200">Officials</a>
                    </div>
                    <a href="{{ url('/admin') }}"
                        class="hidden px-4 py-2 mt-4 font-medium transition-all bg-white rounded-lg shadow-sm bg-opacity-20 hover:bg-opacity-30 md:inline-block md:mt-0 md:ml-6 backdrop-blur-sm">Admin</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="py-20 text-white hero-gradient">
        <div class="container px-4 mx-auto hero-content">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="mb-6 text-4xl font-bold md:text-5xl drop-shadow-md">Environmental Management System</h1>
                <p class="max-w-2xl mx-auto mb-10 text-lg md:text-xl text-green-50">Streamlining waste management across
                    Malvar's barangays for a cleaner, greener community.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#waste-collection"
                        class="flex items-center justify-center w-full max-w-xs px-6 py-3 font-semibold text-green-800 transition-all bg-white rounded-lg shadow-md hover:shadow-lg hover:bg-green-50">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                            View Waste Reports
                        </div>
                    </a>
                    <a href="#documents"
                        class="flex items-center justify-center w-full max-w-xs px-6 py-3 font-semibold transition-all bg-transparent border-2 border-white rounded-lg shadow-md hover:bg-white hover:text-green-800">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Download Documents
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="section-transition white-to-green"></div>

    <!-- Announcements Section -->
    <section id="announcements" class="py-16 bg-gradient-to-b from-green-50 to-white">
        <div class="container px-4 mx-auto">
            <div class="max-w-3xl mx-auto mb-12 text-center">
                <h2 class="mb-3 text-3xl font-bold text-green-800">Announcements</h2>
                <p class="text-gray-600">Stay informed about environmental initiatives and updates</p>
            </div>

            @if ($announcements->count() > 0)
                <div id="announcements-carousel" class="relative w-full" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-96 overflow-hidden rounded-2xl md:h-[500px] shadow-xl">
                        @foreach ($announcements as $index => $announcement)
                            <div class="hidden duration-700 ease-in-out"
                                data-carousel-item="{{ $index === 0 ? 'active' : '' }}">
                                <div
                                    class="absolute block w-full h-full p-6 -translate-x-1/2 -translate-y-1/2 shadow-lg rounded-2xl top-1/2 left-1/2 bg-gradient-to-br from-white to-green-50">
                                    <div class="flex flex-col h-full md:flex-row md:items-center md:gap-6">
                                        @if ($announcement->url)
                                            <div class="mb-4 md:w-1/2 md:mb-0">
                                                <div
                                                    class="relative h-60 md:h-80 overflow-hidden rounded-xl shadow-lg transition-transform hover:scale-[1.02] duration-300">
                                                    <img src="{{ $announcement->url }}"
                                                        alt="{{ $announcement->title }}"
                                                        class="absolute object-cover object-center w-full h-full">
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-60">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="{{ $announcement->url ? 'md:w-1/2' : 'w-full' }}">
                                            <h3 class="mb-3 text-2xl font-bold text-green-800">
                                                {{ $announcement->title }}</h3>
                                            <p class="mb-6 text-gray-700">{{ $announcement->description }}</p>

                                            <div class="flex flex-wrap gap-3">
                                                @if ($announcement->url)
                                                    <a href="{{ $announcement->url }}" target="_blank"
                                                        class="inline-flex items-center px-4 py-2 text-white transition duration-200 bg-green-700 rounded-lg shadow-md hover:bg-green-800">
                                                        <svg class="w-4 h-4 mr-2" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                            </path>
                                                        </svg>
                                                        View Full Image
                                                    </a>
                                                @endif

                                                @if ($announcement->file)
                                                    <a href="{{ asset('storage/' . $announcement->file) }}"
                                                        target="_blank"
                                                        class="inline-flex items-center px-4 py-2 text-white transition duration-200 bg-green-700 rounded-lg shadow-md hover:bg-green-800">
                                                        <svg class="w-4 h-4 mr-2" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                        Download
                                                    </a>
                                                @endif
                                            </div>

                                            <p class="mt-4 text-sm text-gray-500">Valid from
                                                {{ $announcement->start_date->format('M d, Y') }} to
                                                {{ $announcement->end_date->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                        @foreach ($announcements as $index => $announcement)
                            <button type="button"
                                class="w-3 h-3 rounded-full bg-white/50 {{ $index === 0 ? 'bg-white' : '' }}"
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"
                                data-carousel-slide-to="{{ $index }}"></button>
                        @endforeach
                    </div>

                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-neutral-300/30 group-hover:bg-white/50 group-hover:ring-4 group-hover:ring-green-900 group-focus:ring-4 group-focus:ring-green-900 group-focus:outline-none backdrop-blur-xs">
                            <svg class="w-4 h-4 text-green-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-neutral-300/30 group-hover:bg-white/50 group-hover:ring-4 group-hover:ring-green-900 group-focus:ring-4 group-focus:ring-green-900 group-focus:outline-none backdrop-blur-xs">
                            <svg class="w-4 h-4 text-green-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            @else
                <div class="py-8 text-center shadow-md rounded-xl bg-green-50">
                    <p class="text-lg text-gray-600">No active announcements at this time.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Waste Collection Summary Section -->
    <section id="waste-collection" class="py-16 bg-white">
        <div class="container px-4 mx-auto">
            <div class="max-w-3xl mx-auto mb-12 text-center">
                <h2 class="mb-3 text-3xl font-bold text-green-800">Waste Collection Summary</h2>
                <p class="text-gray-600">Monitoring our environmental impact through data</p>
            </div>

            <!-- Filters -->
            <div class="p-6 mb-8 bg-white border border-gray-100 shadow-md rounded-xl">
                <form action="{{ route('home') }}" method="GET" class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-700">Start
                            Date</label>
                        <input type="date" id="start_date" name="start_date" value="{{ $startDate }}"
                            class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 shadow-sm">
                    </div>

                    <div class="flex-1 min-w-[200px]">
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" id="end_date" name="end_date" value="{{ $endDate }}"
                            class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 shadow-sm">
                    </div>

                    <div class="flex-1 min-w-[200px]">
                        <label for="barangay_id" class="block mb-2 text-sm font-medium text-gray-700">Barangay</label>
                        <select id="barangay_id" name="barangay_id"
                            class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 shadow-sm">
                            <option value="">All Barangays</option>
                            @foreach ($barangays as $barangay)
                                <option value="{{ $barangay->barangay_id }}"
                                    {{ $selectedBarangayId == $barangay->barangay_id ? 'selected' : '' }}>
                                    {{ $barangay->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="submit"
                            class="bg-green-700 hover:bg-green-800 text-white font-medium rounded-lg text-sm px-5 py-2.5 shadow-sm transition-all">
                            Apply Filters
                        </button>
                    </div>

                    <div class="flex items-start">
                        <a href="{{ route('home') }}"
                            class="text-green-700 bg-white hover:bg-green-50 border border-green-700 font-medium rounded-lg text-sm px-5 py-2.5 shadow-sm transition-all">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-6 mb-10 md:grid-cols-2 lg:grid-cols-4">
                <!-- Total Waste Card -->
                <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl card">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-green-100 rounded-full shadow-sm">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Waste Collected</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ number_format($totalWaste, 2) }} kg</h3>
                        </div>
                    </div>
                </div>

                <!-- Collection Efficiency Card -->
                <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl card">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-blue-100 rounded-full shadow-sm">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Collection Efficiency</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $collectionEfficiency }}%</h3>
                        </div>
                    </div>
                </div>

                <!-- Biodegradable Waste Card -->
                <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl card">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-green-100 rounded-full shadow-sm">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Biodegradable Waste</p>
                            <h3 class="text-2xl font-bold text-gray-800">
                                {{ number_format($wasteByType->biodegradable ?? 0, 2) }} kg
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Non-Biodegradable Waste Card -->
                <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl card">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-yellow-100 rounded-full shadow-sm">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Non-Biodegradable Waste</p>
                            <h3 class="text-2xl font-bold text-gray-800">
                                {{ number_format($wasteByType->non_biodegradable ?? 0, 2) }} kg</h3>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Waste Collection by Barangay -->
            <div class="p-6 mb-8 bg-white border border-gray-100 shadow-md rounded-xl">
                <h3 class="mb-4 text-xl font-bold text-green-800">Waste Collection by Barangay</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="text-xs text-gray-700 uppercase rounded-t-lg bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 rounded-tl-lg">Barangay</th>
                                <th scope="col" class="px-6 py-3">Total Waste (kg)</th>
                                <th scope="col" class="px-6 py-3 rounded-tr-lg">Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalBarangayWaste = $wasteByBarangay->sum('total_volume');
                            @endphp

                            @foreach ($wasteByBarangay as $barangayWaste)
                                <tr class="transition-colors bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium">{{ $barangayWaste->name }}</td>
                                    <td class="px-6 py-4">{{ number_format($barangayWaste->total_volume, 2) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @php
                                                $percentage =
                                                    $totalBarangayWaste > 0
                                                        ? ($barangayWaste->total_volume / $totalBarangayWaste) * 100
                                                        : 0;
                                            @endphp
                                            <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2 overflow-hidden">
                                                <div class="bg-green-600 h-2.5 rounded-full progress-bar"
                                                    style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <span
                                                class="text-sm font-medium">{{ number_format($percentage, 1) }}%</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Upcoming Collection Schedules -->
            <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl">
                <h3 class="mb-4 text-xl font-bold text-green-800">Upcoming Collection Schedules</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="text-xs text-gray-700 uppercase rounded-t-lg bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 rounded-tl-lg">Barangay</th>
                                <th scope="col" class="px-6 py-3">Collection Date</th>
                                <th scope="col" class="px-6 py-3">Collection Time</th>
                                <th scope="col" class="px-6 py-3 rounded-tr-lg">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($upcomingSchedules as $schedule)
                                <tr class="transition-colors bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium">{{ $schedule->barangay->name }}</td>
                                    <td class="px-6 py-4">{{ $schedule->collection_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">{{ $schedule->collection_time->format('h:i A') }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded-full">{{ ucfirst($schedule->status) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Download Full Report Button -->
            <div class="mt-10 text-center">
                <a href="{{ route('admin.export-waste-report', request()->query()) }}" target="_blank"
                    class="inline-flex items-center px-6 py-3 font-semibold text-white transition-all rounded-lg shadow-md bg-gradient-to-r from-green-700 to-green-600 hover:shadow-lg hover:from-green-800 hover:to-green-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Download Full Report
                </a>
            </div>
        </div>
    </section>

    <div class="section-transition green-to-white"></div>

    <!-- Charts Section -->
    <section id="waste-charts" class="py-16 bg-gradient-to-b from-green-50 to-white">
        <div class="container px-4 mx-auto">
            <div class="max-w-3xl mx-auto mb-12 text-center">
                <h2 class="mb-3 text-3xl font-bold text-green-800">Waste Analytics</h2>
                <p class="text-gray-600">Visual insights into our waste management performance</p>
            </div>

            <!-- Waste Collection Line Chart -->
            <div class="p-6 mb-8 bg-white border border-gray-100 shadow-md rounded-xl">
                <h3 class="mb-6 text-xl font-bold text-green-800">Waste Collection Trends</h3>
                <div class="h-80">
                    <canvas id="wasteCollectionLineChart"></canvas>
                </div>
            </div>

            <!-- Two charts side by side -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                <!-- Waste By Type Bar Chart -->
                <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl">
                    <h3 class="mb-6 text-xl font-bold text-green-800">Waste Collection by Type</h3>
                    <div class="h-64">
                        <canvas id="wasteByTypeChart"></canvas>
                    </div>
                </div>

                <!-- Barangay Comparison Chart -->
                <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl">
                    <h3 class="mb-6 text-xl font-bold text-green-800">Top Barangays by Waste Volume</h3>
                    <div class="h-64">
                        <canvas id="wasteByBarangayChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Documents Section -->
    <section id="documents" class="py-16 bg-gradient-to-b from-green-50 to-white">
        <div class="container px-4 mx-auto">
            <div class="max-w-3xl mx-auto mb-12 text-center">
                <h2 class="mb-3 text-3xl font-bold text-green-800">Documents</h2>
                <p class="text-gray-600">Access official environmental management resources</p>
            </div>

            @if ($documents->count() > 0)
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    @foreach ($documents as $category => $categoryDocuments)
                        <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl card">
                            <h3 class="pb-2 mb-4 text-xl font-bold text-green-800 border-b border-green-100">
                                {{ $category }}</h3>
                            <ul class="space-y-4">
                                @foreach ($categoryDocuments as $document)
                                    <li class="pb-4 border-b border-gray-200 last:border-0">
                                        <h4 class="mb-1 text-lg font-semibold text-gray-800">{{ $document->title }}
                                        </h4>
                                        <p class="mb-2 text-gray-600">{{ $document->description }}</p>

                                        <div class="flex flex-wrap gap-2">
                                            @if ($document->file)
                                                <a href="{{ asset('storage/' . $document->file) }}" target="_blank"
                                                    class="inline-flex items-center px-3 py-1.5 bg-green-700 text-white text-sm rounded-lg hover:bg-green-800 shadow-sm transition-all">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                    Download
                                                </a>
                                            @endif

                                            @if ($document->url)
                                                <a href="{{ $document->url }}" target="_blank"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 shadow-sm transition-all">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                        </path>
                                                    </svg>
                                                    View Online
                                                </a>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-8 text-center bg-white shadow-md rounded-xl">
                    <p class="text-lg text-gray-600">No documents available at this time.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Barangays Section -->
    <section id="barangays" class="py-16 bg-white">
        <div class="container px-4 mx-auto">
            <div class="max-w-3xl mx-auto mb-12 text-center">
                <h2 class="mb-3 text-3xl font-bold text-green-800">Barangays</h2>
                <p class="text-gray-600">Explore waste management data across our community</p>
            </div>

            <div class="flex justify-end mb-6">
                <div class="inline-flex rounded-lg shadow-sm">
                    <button id="sort-name"
                        class="px-4 py-2 text-sm font-medium text-green-800 transition-colors bg-white border border-gray-200 rounded-l-lg">
                        Sort by Name
                    </button>
                    <button id="sort-population"
                        class="px-4 py-2 text-sm font-medium text-white transition-colors bg-green-700 border border-green-700 rounded-r-lg">
                        Sort by Population
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3" id="barangays-grid">
                @foreach ($barangays as $barangay)
                    <div class="overflow-hidden bg-white border border-gray-100 shadow-md rounded-xl card"
                        data-name="{{ $barangay->name }}" data-population="{{ $barangay->population }}">
                        <div class="p-6">
                            <h3 class="mb-2 text-xl font-bold text-green-800">{{ $barangay->name }}</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Population:</span>
                                    <span
                                        class="px-3 py-1 text-sm font-medium text-gray-800 rounded-full bg-green-50">{{ number_format($barangay->population) }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Area:</span>
                                    <span
                                        class="px-3 py-1 text-sm font-medium text-gray-800 rounded-full bg-blue-50">{{ number_format($barangay->area, 2) }}
                                        km²</span>
                                </div>
                            </div>

                            @php
                                $barangayWaste = $wasteByBarangay->firstWhere('barangay_id', $barangay->barangay_id);
                                $wasteVolume = $barangayWaste ? $barangayWaste->total_volume : 0;
                            @endphp

                            <div class="mt-6">
                                <p class="mb-2 text-sm font-medium text-gray-700">Waste Collection (Current Period)</p>
                                <div class="w-full h-3 mt-2 overflow-hidden bg-gray-100 rounded-full shadow-inner">
                                    @php
                                        $maxWaste = $wasteByBarangay->max('total_volume') ?: 1;
                                        $percentage = ($wasteVolume / $maxWaste) * 100;
                                    @endphp
                                    <div class="h-3 rounded-full bg-gradient-to-r from-green-500 to-green-600 progress-bar"
                                        style="width: {{ $percentage }}%">
                                    </div>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <span class="text-xs text-gray-500">0 kg</span>
                                    <span
                                        class="text-xs font-medium text-green-800">{{ number_format($wasteVolume, 2) }}
                                        kg</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-transition white-to-green"></div>

    <!-- Officials Section with Tabs -->
    <section id="officials" class="py-16 bg-gradient-to-b from-green-50 to-white">
        <div class="container px-4 mx-auto">
            <div class="max-w-3xl mx-auto mb-12 text-center">
                <h2 class="mb-3 text-3xl font-bold text-green-800">Barangay Officials</h2>
                <p class="text-gray-600">Meet the leaders responsible for our environmental initiatives</p>
            </div>

            @if (isset($officials['Municipal Officials']) ||
                    isset($officials['Barangay Officials']) ||
                    isset($officials['SK Officials']))
                <!-- Tabs Navigation -->
                <div class="mb-8 overflow-x-auto scrollbar-hide">
                    <div class="inline-flex rounded-lg shadow-md" role="tablist" id="officials-tabs">
                        <button type="button"
                            class="px-4 py-2 text-sm font-medium text-white rounded-l-lg bg-gradient-to-r from-green-600 to-green-700 tab-button active"
                            id="tab-municipal" data-barangay="municipal" role="tab" aria-selected="true">
                            Municipal Officials
                        </button>

                        @foreach ($barangays as $barangay)
                            <button type="button"
                                class="px-4 py-2 text-sm font-medium text-green-800 bg-white border-t border-b border-r border-gray-200 hover:bg-green-50 {{ $loop->last ? 'rounded-r-lg' : '' }} tab-button"
                                id="tab-{{ $barangay->barangay_id }}" data-barangay="{{ $barangay->barangay_id }}"
                                role="tab" aria-selected="false">
                                {{ $barangay->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Municipal Officials Tab -->
                    <div class="block tab-pane fade show" id="content-municipal" role="tabpanel">
                        <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl">
                            <h3 class="pb-2 mb-6 text-xl font-bold text-green-800 border-b border-green-100">
                                Municipal Officials
                            </h3>

                            <ul class="space-y-4">
                                @if (isset($officials['Municipal Officials']))
                                    @foreach ($officials['Municipal Officials'] as $official)
                                        <li
                                            class="p-2 pb-3 transition-colors border-b border-gray-100 rounded-lg last:border-0 hover:bg-gray-50">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h4 class="text-lg font-medium text-gray-800">
                                                        {{ $official->name }}</h4>
                                                    <p class="text-green-700">{{ $official->position }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="py-3 text-center text-gray-500">No municipal officials available.</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <!-- Barangay Tabs -->
                    @foreach ($barangays as $barangay)
                        <div class="hidden tab-pane fade" id="content-{{ $barangay->barangay_id }}" role="tabpanel">
                            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                                <!-- Barangay Officials -->
                                <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl">
                                    <h3 class="pb-2 mb-6 text-xl font-bold text-green-800 border-b border-green-100">
                                        Barangay Officials
                                    </h3>

                                    <ul class="space-y-4">
                                        @php
                                            $barangayOfficials = collect();
                                            if (isset($officials['Barangay Officials'])) {
                                                $barangayOfficials = $officials['Barangay Officials']->where(
                                                    'barangay_id',
                                                    $barangay->barangay_id,
                                                );
                                            }
                                        @endphp

                                        @if ($barangayOfficials->count() > 0)
                                            @foreach ($barangayOfficials as $official)
                                                <li
                                                    class="p-2 pb-3 transition-colors border-b border-gray-100 rounded-lg last:border-0 hover:bg-gray-50">
                                                    <div>
                                                        <h4 class="text-lg font-medium text-gray-800">
                                                            {{ $official->name }}</h4>
                                                        <p class="text-green-700">{{ $official->position }}</p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="py-3 text-center text-gray-500">No barangay officials available.
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                <!-- SK Officials -->
                                <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl">
                                    <h3 class="pb-2 mb-6 text-xl font-bold text-green-800 border-b border-green-100">
                                        SK Officials
                                    </h3>

                                    <ul class="space-y-4">
                                        @php
                                            $skOfficials = collect();
                                            if (isset($officials['SK Officials'])) {
                                                $skOfficials = $officials['SK Officials']->where(
                                                    'barangay_id',
                                                    $barangay->barangay_id,
                                                );
                                            }
                                        @endphp

                                        @if ($skOfficials->count() > 0)
                                            @foreach ($skOfficials as $official)
                                                <li
                                                    class="p-2 pb-3 transition-colors border-b border-gray-100 rounded-lg last:border-0 hover:bg-gray-50">
                                                    <div>
                                                        <h4 class="text-lg font-medium text-gray-800">
                                                            {{ $official->name }}</h4>
                                                        <p class="text-green-700">{{ $official->position }}</p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="py-3 text-center text-gray-500">No SK officials available.</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-8 text-center bg-white shadow-md rounded-xl">
                    <p class="text-lg text-gray-600">No officials data available at this time.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 text-white bg-gradient-to-br from-green-900 to-green-800">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div>
                    <h3 class="mb-4 text-lg font-bold">Municipality of Malvar</h3>
                    <p class="mb-4 text-green-100">Environmental Management System</p>
                    <div class="flex items-center">
                        <div class="p-1 bg-white rounded-full shadow-md bg-opacity-10">
                            <img src="{{ asset('images/malvar_logo.jpg') }}" alt="Malvar Logo"
                                class="w-12 h-12 rounded-full">
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="mb-4 text-lg font-bold">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#announcements"
                                class="text-green-100 transition-colors hover:text-white">Announcements</a></li>
                        <li><a href="#waste-collection"
                                class="text-green-100 transition-colors hover:text-white">Waste Collection</a></li>
                        <li><a href="#documents"
                                class="text-green-100 transition-colors hover:text-white">Documents</a></li>
                        <li><a href="#barangays"
                                class="text-green-100 transition-colors hover:text-white">Barangays</a></li>
                        <li><a href="#officials"
                                class="text-green-100 transition-colors hover:text-white">Officials</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="mb-4 text-lg font-bold">Contact Information</h3>
                    <address class="not-italic text-green-100">
                        <p class="flex items-start mb-2">
                            <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Municipal Hall, Malvar, Batangas
                        </p>
                        <p class="flex items-start mb-2">
                            <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            (123) 456-7890
                        </p>
                        <p class="flex items-start mb-2">
                            <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            inquiries@malvar.gov.ph
                        </p>
                    </address>
                </div>
            </div>

            <div class="pt-8 mt-8 text-sm text-center border-t border-green-800">
                <p class="text-green-100">&copy; 2025 Municipality of Malvar. Environmental Management
                    System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script>
        // Barangay sorting
        document.addEventListener('DOMContentLoaded', function() {
            const sortByName = document.getElementById('sort-name');
            const sortByPopulation = document.getElementById('sort-population');
            const barangaysGrid = document.getElementById('barangays-grid');

            function sortBarangays(sortBy) {
                const barangays = Array.from(barangaysGrid.children);

                barangays.sort((a, b) => {
                    if (sortBy === 'name') {
                        return a.dataset.name.localeCompare(b.dataset.name);
                    } else if (sortBy === 'population') {
                        return parseInt(b.dataset.population) - parseInt(a.dataset.population);
                    }
                });

                // Clear grid and append sorted barangays
                barangaysGrid.innerHTML = '';
                barangays.forEach(barangay => barangaysGrid.appendChild(barangay));
            }

            sortByName.addEventListener('click', function() {
                sortBarangays('name');
                sortByPopulation.classList.remove('bg-green-700', 'text-white', 'hover:bg-green-800',
                    'border', 'border-green-700');
                sortByPopulation.classList.add('bg-white', 'text-green-800', 'border', 'border-gray-200',
                    'hover:bg-gray-50');
                sortByName.classList.remove('bg-white', 'text-green-800', 'border',
                    'border-gray-200');
                sortByName.classList.add('bg-green-700', 'text-white', 'border', 'border-green-700',
                    'hover:text-green-800');
            });

            sortByPopulation.addEventListener('click', function() {
                sortBarangays('population');
                sortByName.classList.remove('bg-green-700', 'text-white', 'border',
                    'border-green-700', 'hover:bg-green-800',
                    'border', 'border-green-700');
                sortByName.classList.add('bg-white', 'text-green-800', 'border', 'border-gray-200',
                    'hover:bg-gray-50');
                sortByPopulation.classList.remove('bg-white', 'text-green-800', 'border',
                    'border-gray-200');
                sortByPopulation.classList.add('bg-green-700', 'text-white', 'border', 'border-green-700',
                    'hover:text-green-800');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('#officials-tabs button');
            const tabContents = document.querySelectorAll('.tab-pane');

            // Initialize - show municipal officials by default
            document.getElementById('content-municipal').classList.remove('hidden');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabs.forEach(t => {
                        t.classList.remove('text-white', 'bg-gradient-to-r',
                            'from-green-600', 'to-green-700', 'active');
                        t.classList.add('text-green-800', 'bg-white');
                        t.setAttribute('aria-selected', 'false');
                    });

                    // Add active class to current tab
                    this.classList.remove('text-green-800', 'bg-white');
                    this.classList.add('text-white', 'bg-gradient-to-r', 'from-green-600',
                        'to-green-700', 'active');
                    this.setAttribute('aria-selected', 'true');

                    // Hide all tab content
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });

                    // Show current tab content
                    const targetContent = document.getElementById('content-' + this.getAttribute(
                        'data-barangay'));
                    targetContent.classList.remove('hidden');
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const navigationMenu = document.getElementById('navigation-menu');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');

            // Toggle menu when button is clicked
            mobileMenuButton.addEventListener('click', function() {
                navigationMenu.classList.toggle('hidden');
                hamburgerIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });

            // Close menu when clicking navigation links on mobile
            const navLinks = navigationMenu.querySelectorAll('a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) { // Only on mobile
                        navigationMenu.classList.add('hidden');
                        hamburgerIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    navigationMenu.classList.remove('hidden');
                } else {
                    navigationMenu.classList.add('hidden');
                    hamburgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            });

            // Add subtle animations for cards
            const cards = document.querySelectorAll('.card');
            if (cards) {
                cards.forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-3px)';
                        this.style.boxShadow =
                            '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05)';
                    });

                    card.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0)';
                        this.style.boxShadow = '';
                    });
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Common chart options
            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#4b5563';
            Chart.defaults.plugins.tooltip.titleColor = '#065f46';
            Chart.defaults.plugins.tooltip.bodyColor = '#111827';
            Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(255, 255, 255, 0.9)';
            Chart.defaults.plugins.tooltip.borderColor = '#d1d5db';
            Chart.defaults.plugins.tooltip.borderWidth = 1;
            Chart.defaults.plugins.tooltip.padding = 10;
            Chart.defaults.plugins.tooltip.cornerRadius = 6;
            Chart.defaults.plugins.legend.labels.boxWidth = 12;
            Chart.defaults.plugins.legend.labels.padding = 15;

            // 1. Waste Collection Line Chart
            const lineChartData = @json($wasteCollectionLineData ?? []);
            if (document.getElementById('wasteCollectionLineChart')) {
                new Chart(document.getElementById('wasteCollectionLineChart'), {
                    type: 'line',
                    data: {
                        labels: lineChartData.labels ?? [],
                        datasets: [{
                            label: 'Total Waste (kg)',
                            data: lineChartData.data ?? [],
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            fill: true,
                            tension: 0.3,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Waste Volume (kg)',
                                    font: {
                                        weight: 'bold'
                                    }
                                },
                                ticks: {
                                    precision: 0
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Date',
                                    font: {
                                        weight: 'bold'
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + parseFloat(context.raw)
                                            .toFixed(2) + ' kg';
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // 2. Waste By Type Bar Chart
            const wasteTypeData = @json($wasteByTypeChartData ?? []);
            if (document.getElementById('wasteByTypeChart')) {
                new Chart(document.getElementById('wasteByTypeChart'), {
                    type: 'bar',
                    data: {
                        labels: wasteTypeData.labels ?? [],
                        datasets: [{
                                label: 'Biodegradable',
                                data: wasteTypeData.biodegradable ?? [],
                                backgroundColor: '#10b981', // Green
                                borderColor: '#10b981',
                                borderWidth: 1,
                            },
                            {
                                label: 'Non-Biodegradable',
                                data: wasteTypeData.non_biodegradable ?? [],
                                backgroundColor: '#f59e0b', // Amber
                                borderColor: '#f59e0b',
                                borderWidth: 1,
                            },
                            {
                                label: 'Hazardous',
                                data: wasteTypeData.hazardous ?? [],
                                backgroundColor: '#ef4444', // Red
                                borderColor: '#ef4444',
                                borderWidth: 1,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                stacked: false,
                                title: {
                                    display: true,
                                    text: 'Waste Volume (kg)',
                                    font: {
                                        weight: 'bold'
                                    }
                                },
                                ticks: {
                                    precision: 0
                                }
                            },
                            x: {
                                stacked: false,
                                title: {
                                    display: true,
                                    text: 'Period',
                                    font: {
                                        weight: 'bold'
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + parseFloat(context.raw)
                                            .toFixed(2) + ' kg';
                                    }
                                }
                            },
                            legend: {
                                position: 'top',
                                align: 'center'
                            }
                        }
                    }
                });
            }

            // 3. Waste By Barangay Chart
            const wasteByBarangayData = @json($wasteByBarangayChartData ?? []);
            if (document.getElementById('wasteByBarangayChart')) {
                new Chart(document.getElementById('wasteByBarangayChart'), {
                    type: 'bar',
                    data: {
                        labels: wasteByBarangayData.labels ?? [],
                        datasets: [{
                                label: 'Biodegradable',
                                data: wasteByBarangayData.biodegradable ?? [],
                                backgroundColor: '#10b981',
                                borderColor: '#10b981',
                                borderWidth: 1
                            },
                            {
                                label: 'Non-Biodegradable',
                                data: wasteByBarangayData.non_biodegradable ?? [],
                                backgroundColor: '#f59e0b',
                                borderColor: '#f59e0b',
                                borderWidth: 1
                            },
                            {
                                label: 'Hazardous',
                                data: wasteByBarangayData.hazardous ?? [],
                                backgroundColor: '#ef4444',
                                borderColor: '#ef4444',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Waste Volume (kg)',
                                    font: {
                                        weight: 'bold'
                                    }
                                },
                                ticks: {
                                    precision: 0
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Barangay',
                                    font: {
                                        weight: 'bold'
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + parseFloat(context.raw)
                                            .toFixed(2) + ' kg';
                                    }
                                }
                            },
                            legend: {
                                position: 'top',
                                align: 'center'
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>
