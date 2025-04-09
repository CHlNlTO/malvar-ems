<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $barangay->name }} - Malvar Environmental Management System</title>
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
                        <a href="{{ route('home') }}"
                            class="py-2 transition-colors border-b border-green-700 md:border-0 hover:text-green-200">Home</a>
                        <a href="#overview"
                            class="py-2 transition-colors border-b border-green-700 md:border-0 hover:text-green-200">Overview</a>
                        <a href="#waste-collection"
                            class="py-2 transition-colors border-b border-green-700 md:border-0 hover:text-green-200">Waste
                            Collection</a>
                        <a href="#officials"
                            class="py-2 transition-colors border-b border-green-700 md:border-0 hover:text-green-200">Officials</a>
                        <a href="#schedules" class="py-2 transition-colors hover:text-green-200">Schedules</a>
                    </div>
                    <a href="{{ url('/admin') }}"
                        class="hidden px-4 py-2 mt-4 font-medium transition-all bg-white rounded-lg shadow-sm bg-opacity-20 hover:bg-opacity-30 md:inline-block md:mt-0 md:ml-6 backdrop-blur-sm">Admin</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="py-16 text-white hero-gradient md:py-20">
        <div class="container px-4 mx-auto hero-content">
            <div class="max-w-3xl mx-auto text-center">
                <div class="inline-flex mb-4 px-4 py-1.5 bg-white bg-opacity-20 rounded-full backdrop-blur-sm">
                    <span class="text-sm font-medium">Barangay Profile</span>
                </div>
                <h1 class="mb-4 text-3xl font-bold md:text-5xl drop-shadow-md">Barangay {{ $barangay->name }}</h1>
                <p class="max-w-2xl mx-auto mb-10 text-lg text-green-50">
                    Environmental statistics and waste management data for Barangay {{ $barangay->name }}
                </p>

                <!-- Barangay Dropdown Navigation -->
                <div class="flex justify-center mb-6">
                    <div class="inline-block w-full max-w-xs">
                        <label for="barangay-dropdown" class="sr-only">Select Barangay</label>
                        <select id="barangay-dropdown"
                            class="bg-white bg-opacity-20 text-white text-sm rounded-lg block w-full p-2.5 border border-white border-opacity-20 focus:ring-green-500 focus:border-green-500 backdrop-blur-sm">
                            <option selected disabled>Switch to another barangay</option>
                            @foreach ($barangays as $b)
                                @if ($b->barangay_id != $barangay->barangay_id)
                                    <option value="{{ route('barangays.show', $b->slug) }}">{{ $b->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('admin.export-waste-report', ['barangay_id' => $barangay->barangay_id]) }}"
                        target="_blank"
                        class="flex items-center justify-center px-6 py-3 font-semibold text-green-800 transition-all bg-white rounded-lg shadow-md hover:shadow-lg hover:bg-green-50">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Download Waste Report
                        </div>
                    </a>
                    <a href="{{ route('home') }}"
                        class="flex items-center justify-center px-6 py-3 font-semibold transition-all bg-transparent border-2 border-white rounded-lg shadow-md hover:bg-white hover:text-green-800">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Dashboard
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="section-transition white-to-green"></div>

    <!-- Barangay Overview Section -->
    <section id="overview" class="py-16 bg-gradient-to-b from-green-50 to-white">
        <div class="container px-4 mx-auto">
            <div class="max-w-3xl mx-auto mb-12 text-center">
                <h2 class="mb-3 text-3xl font-bold text-green-800">Barangay Overview</h2>
                <p class="text-gray-600">Key information and demographics</p>
            </div>

            <!-- Barangay Stats Cards -->
            <div class="grid grid-cols-1 gap-6 mb-10 md:grid-cols-3">
                <!-- Population Card -->
                <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl card">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-blue-100 rounded-full shadow-sm">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Population</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ number_format($barangay->population) }}
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Area Card -->
                <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl card">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-green-100 rounded-full shadow-sm">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Area</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ number_format($barangay->area, 2) }} km²
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Population Density Card -->
                <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl card">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-yellow-100 rounded-full shadow-sm">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Population Density</p>
                            <h3 class="text-2xl font-bold text-gray-800">
                                {{ number_format($barangay->population_density) }} per km²</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Waste Collection Per Capita Context -->
            <div class="p-6 mb-8 bg-white border border-gray-100 shadow-md rounded-xl">
                <h3 class="mb-4 text-xl font-bold text-green-800">Waste Collection Per Capita</h3>
                <div class="flex flex-wrap gap-6">
                    <div class="flex-1 min-w-[250px]">
                        <div class="mb-2 text-sm font-medium text-gray-500">Total Waste per Resident</div>
                        <div class="text-2xl font-bold text-gray-800">
                            {{ number_format($wasteStats['perCapitaWaste'], 4) }} kg per person
                        </div>
                        <p class="mt-2 text-sm text-gray-600">
                            This represents the average amount of waste collected per resident in Barangay
                            {{ $barangay->name }}
                            for the selected period.
                        </p>
                    </div>

                    <div class="flex-1 min-w-[250px]">
                        <div class="mb-2 text-sm font-medium text-gray-500">Compared to Municipal Average</div>
                        @php
                            $municipalPerCapita = $comparisonData['municipal']['avgWaste'];
                            $difference = $wasteStats['perCapitaWaste'] - $municipalPerCapita;
                            $percentDiff = $municipalPerCapita != 0 ? ($difference / $municipalPerCapita) * 100 : 0;
                        @endphp
                        <div class="flex items-center">
                            <span class="mr-2 text-2xl font-bold text-gray-800">
                                {{ $difference > 0 ? '+' : '' }}{{ number_format($percentDiff, 1) }}%
                            </span>
                            @if ($difference > 0)
                                <span class="text-red-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </span>
                            @elseif($difference < 0)
                                <span class="text-green-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                </span>
                            @else
                                <span class="text-gray-500">—</span>
                            @endif
                        </div>
                        <p class="mt-2 text-sm text-gray-600">
                            {{ $difference > 0 ? 'Higher' : ($difference < 0 ? 'Lower' : 'Same as') }} than the
                            municipal average of
                            {{ number_format($municipalPerCapita, 4) }} kg per person.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Waste Collection Summary Section -->
    <section id="waste-collection" class="py-16 bg-white">
        <div class="container px-4 mx-auto">
            <div class="max-w-3xl mx-auto mb-12 text-center">
                <h2 class="mb-3 text-3xl font-bold text-green-800">Waste Collection Summary</h2>
                <p class="text-gray-600">Monitoring environmental impact in Barangay {{ $barangay->name }}</p>
            </div>

            <!-- Filters -->
            <div class="p-6 mb-8 bg-white border border-gray-100 shadow-md rounded-xl">
                <form action="{{ route('barangays.show', $barangay->slug) }}" method="GET"
                    class="flex flex-wrap items-end gap-4">
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

                    <div>
                        <button type="submit"
                            class="bg-green-700 hover:bg-green-800 text-white font-medium rounded-lg text-sm px-5 py-2.5 shadow-sm transition-all">
                            Apply Filters
                        </button>
                    </div>

                    <div class="flex items-start">
                        <a href="{{ route('barangays.show', $barangay->slug) }}"
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
                            <h3 class="text-2xl font-bold text-gray-800">
                                {{ number_format($wasteStats['totalWaste'], 2) }} kg</h3>
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
                            <h3 class="text-2xl font-bold text-gray-800">{{ $wasteStats['collectionEfficiency'] }}%
                            </h3>
                            <p class="mt-1 text-xs text-gray-500">{{ $wasteStats['completed'] }} completed,
                                {{ $wasteStats['missed'] }} missed</p>
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
                                {{ number_format($wasteStats['wasteByType']->biodegradable ?? 0, 2) }} kg
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
                                {{ number_format($wasteStats['wasteByType']->non_biodegradable ?? 0, 2) }} kg</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comparison with Municipal Average -->
            <div class="p-6 mb-10 bg-white border border-gray-100 shadow-md rounded-xl">
                <h3 class="mb-6 text-xl font-bold text-green-800">Comparison with Municipal Average</h3>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Collection Efficiency Comparison -->
                    <div class="p-4 border border-gray-100 rounded-lg shadow-sm">
                        <div class="flex justify-between mb-2">
                            <h4 class="font-medium text-gray-700">Collection Efficiency</h4>
                            <div class="flex items-center">
                                @php
                                    $efficiencyDiff =
                                        $comparisonData['barangay']['collectionEfficiency'] -
                                        $comparisonData['municipal']['collectionEfficiency'];
                                @endphp
                                <span
                                    class="text-sm font-bold {{ $efficiencyDiff >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $efficiencyDiff >= 0 ? '+' : '' }}{{ number_format($efficiencyDiff, 1) }}%
                                </span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div>
                                <div class="flex justify-between text-xs text-gray-500">
                                    <span>{{ $barangay->name }}</span>
                                    <span>{{ $comparisonData['barangay']['collectionEfficiency'] }}%</span>
                                </div>
                                <div class="w-full h-2 mt-1 overflow-hidden bg-gray-200 rounded-full">
                                    <div class="h-2 bg-green-600 rounded-full"
                                        style="width: {{ $comparisonData['barangay']['collectionEfficiency'] }}%">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between text-xs text-gray-500">
                                    <span>Municipal Average</span>
                                    <span>{{ $comparisonData['municipal']['collectionEfficiency'] }}%</span>
                                </div>
                                <div class="w-full h-2 mt-1 overflow-hidden bg-gray-200 rounded-full">
                                    <div class="h-2 bg-blue-500 rounded-full"
                                        style="width: {{ $comparisonData['municipal']['collectionEfficiency'] }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Waste Composition Comparison -->
                    <div class="p-4 border border-gray-100 rounded-lg shadow-sm">
                        <div class="flex justify-between mb-2">
                            <h4 class="font-medium text-gray-700">Waste Composition</h4>
                        </div>

                        @php
                            $barangayTotal =
                                $comparisonData['barangay']['biodegradable'] +
                                $comparisonData['barangay']['nonBiodegradable'] +
                                $comparisonData['barangay']['hazardous'];
                            $municipalTotal =
                                $comparisonData['municipal']['avgBiodegradable'] +
                                $comparisonData['municipal']['avgNonBiodegradable'] +
                                $comparisonData['municipal']['avgHazardous'];

                            $barangayBioPercent =
                                $barangayTotal > 0
                                    ? ($comparisonData['barangay']['biodegradable'] / $barangayTotal) * 100
                                    : 0;
                            $barangayNonBioPercent =
                                $barangayTotal > 0
                                    ? ($comparisonData['barangay']['nonBiodegradable'] / $barangayTotal) * 100
                                    : 0;
                            $barangayHazardPercent =
                                $barangayTotal > 0
                                    ? ($comparisonData['barangay']['hazardous'] / $barangayTotal) * 100
                                    : 0;

                            $municipalBioPercent =
                                $municipalTotal > 0
                                    ? ($comparisonData['municipal']['avgBiodegradable'] / $municipalTotal) * 100
                                    : 0;
                            $municipalNonBioPercent =
                                $municipalTotal > 0
                                    ? ($comparisonData['municipal']['avgNonBiodegradable'] / $municipalTotal) * 100
                                    : 0;
                            $municipalHazardPercent =
                                $municipalTotal > 0
                                    ? ($comparisonData['municipal']['avgHazardous'] / $municipalTotal) * 100
                                    : 0;
                        @endphp

                        <div class="space-y-3">
                            <div>
                                <div class="mb-1 text-xs text-gray-500">{{ $barangay->name }}</div>
                                <div class="flex w-full h-4 overflow-hidden bg-gray-200 rounded-full">
                                    <div class="h-4 bg-green-500" style="width: {{ $barangayBioPercent }}%"></div>
                                    <div class="h-4 bg-yellow-500" style="width: {{ $barangayNonBioPercent }}%">
                                    </div>
                                    <div class="h-4 bg-red-500" style="width: {{ $barangayHazardPercent }}%"></div>
                                </div>
                                <div class="flex justify-between mt-1">
                                    <div class="flex items-center text-xs">
                                        <div class="w-2 h-2 mr-1 bg-green-500 rounded-full"></div>
                                        <span>Bio: {{ number_format($barangayBioPercent, 1) }}%</span>
                                    </div>
                                    <div class="flex items-center text-xs">
                                        <div class="w-2 h-2 mr-1 bg-yellow-500 rounded-full"></div>
                                        <span>Non-bio: {{ number_format($barangayNonBioPercent, 1) }}%</span>
                                    </div>
                                    <div class="flex items-center text-xs">
                                        <div class="w-2 h-2 mr-1 bg-red-500 rounded-full"></div>
                                        <span>Hazard: {{ number_format($barangayHazardPercent, 1) }}%</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="mb-1 text-xs text-gray-500">Municipal Average</div>
                                <div class="flex w-full h-4 overflow-hidden bg-gray-200 rounded-full">
                                    <div class="h-4 bg-green-400" style="width: {{ $municipalBioPercent }}%"></div>
                                    <div class="h-4 bg-yellow-400" style="width: {{ $municipalNonBioPercent }}%">
                                    </div>
                                    <div class="h-4 bg-red-400" style="width: {{ $municipalHazardPercent }}%"></div>
                                </div>
                                <div class="flex justify-between mt-1">
                                    <div class="flex items-center text-xs">
                                        <div class="w-2 h-2 mr-1 bg-green-400 rounded-full"></div>
                                        <span>Bio: {{ number_format($municipalBioPercent, 1) }}%</span>
                                    </div>
                                    <div class="flex items-center text-xs">
                                        <div class="w-2 h-2 mr-1 bg-yellow-400 rounded-full"></div>
                                        <span>Non-bio: {{ number_format($municipalNonBioPercent, 1) }}%</span>
                                    </div>
                                    <div class="flex items-center text-xs">
                                        <div class="w-2 h-2 mr-1 bg-red-400 rounded-full"></div>
                                        <span>Hazard: {{ number_format($municipalHazardPercent, 1) }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Waste Collection Trend Chart -->
            <div class="p-6 mb-8 bg-white border border-gray-100 shadow-md rounded-xl">
                <h3 class="mb-6 text-xl font-bold text-green-800">Waste Collection Trends</h3>
                <div class="h-80">
                    <canvas id="wasteCollectionLineChart"></canvas>
                </div>
            </div>

            <!-- Waste By Type Chart -->
            <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl">
                <h3 class="mb-6 text-xl font-bold text-green-800">Waste Collection by Type</h3>
                <div class="h-80">
                    <canvas id="wasteByTypeChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <div class="section-transition white-to-green"></div>

    <!-- Officials Section -->
    <section id="officials" class="py-16 bg-gradient-to-b from-green-50 to-white">
        <div class="container px-4 mx-auto">
            <div class="max-w-3xl mx-auto mb-12 text-center">
                <h2 class="mb-3 text-3xl font-bold text-green-800">{{ $barangay->name }} Officials</h2>
                <p class="text-gray-600">Meet the leaders responsible for barangay management</p>
            </div>

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
                                $barangayOfficials = $officials['Barangay Officials'];
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
                            <li class="py-3 text-center text-gray-500">No barangay officials available.</li>
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
                                $skOfficials = $officials['SK Officials'];
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
    </section>

    <!-- Schedules Section -->
    <section id="schedules" class="py-16 bg-white">
        <div class="container px-4 mx-auto">
            <div class="max-w-3xl mx-auto mb-12 text-center">
                <h2 class="mb-3 text-3xl font-bold text-green-800">Collection Schedules</h2>
                <p class="text-gray-600">Upcoming waste collection for Barangay {{ $barangay->name }}</p>
            </div>

            <div class="p-6 bg-white border border-gray-100 shadow-md rounded-xl">
                <h3 class="mb-6 text-xl font-bold text-green-800">Upcoming Collections</h3>

                @if ($upcomingSchedules->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-700">
                            <thead class="text-xs text-gray-700 uppercase rounded-t-lg bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 rounded-tl-lg">Collection Date</th>
                                    <th scope="col" class="px-6 py-3">Collection Time</th>
                                    <th scope="col" class="px-6 py-3 rounded-tr-lg">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($upcomingSchedules as $schedule)
                                    <tr class="transition-colors bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium">
                                            {{ $schedule->collection_date->format('M d, Y') }}</td>
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
                @else
                    <div class="py-8 text-center">
                        <p class="text-gray-600">No upcoming collection schedules available at this time.</p>
                    </div>
                @endif
            </div>
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
                        <li><a href="{{ route('home') }}"
                                class="text-green-100 transition-colors hover:text-white">Main Dashboard</a></li>
                        <li><a href="#overview" class="text-green-100 transition-colors hover:text-white">Barangay
                                Overview</a></li>
                        <li><a href="#waste-collection"
                                class="text-green-100 transition-colors hover:text-white">Waste Collection</a></li>
                        <li><a href="#officials"
                                class="text-green-100 transition-colors hover:text-white">Officials</a></li>
                        <li><a href="#schedules"
                                class="text-green-100 transition-colors hover:text-white">Schedules</a></li>
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

            // Barangay dropdown navigation
            const barangayDropdown = document.getElementById('barangay-dropdown');
            if (barangayDropdown) {
                barangayDropdown.addEventListener('change', function() {
                    if (this.value) {
                        window.location.href = this.value;
                    }
                });
            }

            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const navigationMenu = document.getElementById('navigation-menu');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');

            if (mobileMenuButton && navigationMenu && hamburgerIcon && closeIcon) {
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
            }
        });
    </script>
</body>

</html>
