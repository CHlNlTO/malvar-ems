<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Municipality of Malvar - Environmental Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .hero-pattern {
            background-color: rgba(0, 100, 0, 0.8);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%23ffffff' fill-opacity='0.1' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="text-white bg-green-800 shadow-md">
        <div class="container flex flex-col items-center justify-between px-4 py-4 mx-auto md:flex-row">
            <div class="flex items-center mb-4 md:mb-0">
                <img src="{{ asset('images/malvar_logo.jpg') }}" alt="Malvar Logo" class="w-16 h-16 mr-3 rounded-full">
                <div>
                    <h1 class="text-xl font-bold">Municipality of Malvar</h1>
                    <p class="text-sm text-green-200">Environmental Management System</p>
                </div>
            </div>
            <nav class="flex space-x-6">
                <a href="#announcements" class="hover:text-green-200">Announcements</a>
                <a href="#waste-collection" class="hover:text-green-200">Waste Collection</a>
                <a href="#documents" class="hover:text-green-200">Documents</a>
                <a href="#barangays" class="hover:text-green-200">Barangays</a>
                <a href="#officials" class="hover:text-green-200">Officials</a>
                <a href="{{ url('/admin') }}" class="px-4 py-2 bg-green-600 rounded-md hover:bg-green-700">Admin</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="py-20 text-white hero-pattern">
        <div class="container px-4 mx-auto text-center">
            <h1 class="mb-4 text-4xl font-bold">Environmental Management System</h1>
            <p class="max-w-2xl mx-auto mb-8 text-xl">Streamlining waste management across Malvar's 15 barangays for a
                cleaner, greener community.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#waste-collection"
                    class="px-6 py-3 font-semibold text-green-800 bg-white rounded-md hover:bg-green-100">View Waste
                    Reports</a>
                <a href="#documents"
                    class="px-6 py-3 font-semibold bg-transparent border-2 border-white rounded-md hover:bg-white hover:text-green-800">Download
                    Documents</a>
            </div>
        </div>
    </section>

    <!-- Announcements Section -->
    <section id="announcements" class="py-16 bg-white">
        <div class="container px-4 mx-auto">
            <h2 class="mb-10 text-3xl font-bold text-center text-green-800">Announcements</h2>

            @if ($announcements->count() > 0)
                <div id="announcements-carousel" class="relative w-full" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-96 overflow-hidden rounded-lg md:h-[500px]">
                        @foreach ($announcements as $index => $announcement)
                            <div class="hidden duration-700 ease-in-out"
                                data-carousel-item="{{ $index === 0 ? 'active' : '' }}">
                                <div
                                    class="absolute block w-full h-full p-6 -translate-x-1/2 -translate-y-1/2 rounded-lg shadow-md top-1/2 left-1/2 bg-green-50">
                                    <div class="flex flex-col h-full md:flex-row md:items-center md:gap-6">
                                        @if ($announcement->url)
                                            <div class="mb-4 md:w-1/2 md:mb-0">
                                                <div
                                                    class="relative h-60 md:h-80 overflow-hidden rounded-lg shadow-lg transition-transform hover:scale-[1.02] duration-300">
                                                    <img src="{{ $announcement->url }}" alt="{{ $announcement->title }}"
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
                                                        class="inline-flex items-center px-4 py-2 text-white transition duration-200 bg-green-700 rounded-md hover:bg-green-800">
                                                        View Full Image
                                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                @endif

                                                @if ($announcement->file)
                                                    <a href="{{ asset('storage/' . $announcement->file) }}"
                                                        target="_blank"
                                                        class="inline-flex items-center px-4 py-2 text-white transition duration-200 bg-green-700 rounded-md hover:bg-green-800">
                                                        Download
                                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
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

                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
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
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            @else
                <div class="py-8 text-center rounded-lg bg-green-50">
                    <p class="text-lg text-gray-600">No active announcements at this time.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Waste Collection Summary Section -->
    <section id="waste-collection" class="py-16 bg-green-50">
        <div class="container px-4 mx-auto">
            <h2 class="mb-10 text-3xl font-bold text-center text-green-800">Waste Collection Summary</h2>

            <!-- Filters -->
            <div class="p-6 mb-8 bg-white rounded-lg shadow">
                <form action="{{ route('home') }}" method="GET" class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label for="start_date" class="block mb-1 text-sm font-medium text-gray-700">Start
                            Date</label>
                        <input type="date" id="start_date" name="start_date" value="{{ $startDate }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                    </div>

                    <div class="flex-1 min-w-[200px]">
                        <label for="end_date" class="block mb-1 text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" id="end_date" name="end_date" value="{{ $endDate }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                    </div>

                    <div class="flex-1 min-w-[200px]">
                        <label for="barangay_id" class="block mb-1 text-sm font-medium text-gray-700">Barangay</label>
                        <select id="barangay_id" name="barangay_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
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
                            class="bg-green-700 hover:bg-green-800 text-white font-medium rounded-lg text-sm px-5 py-2.5">Apply
                            Filters</button>
                    </div>

                    <div class="flex items-start">
                        <a href="{{ route('home') }}"
                            class="text-green-700 bg-transparent hover:bg-green-100 border border-green-700 font-medium rounded-lg text-sm px-5 py-2.5">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
                <!-- Total Waste Card -->
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-green-100 rounded-full">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Waste Collected</p>
                            <h3 class="text-2xl font-bold">{{ number_format($totalWaste, 2) }} kg</h3>
                        </div>
                    </div>
                </div>

                <!-- Collection Efficiency Card -->
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-blue-100 rounded-full">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Collection Efficiency</p>
                            <h3 class="text-2xl font-bold">{{ $collectionEfficiency }}%</h3>
                        </div>
                    </div>
                </div>

                <!-- Biodegradable Waste Card -->
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-green-100 rounded-full">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Biodegradable Waste</p>
                            <h3 class="text-2xl font-bold">{{ number_format($wasteByType->biodegradable ?? 0, 2) }} kg
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Non-Biodegradable Waste Card -->
                <div class="p-6 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-yellow-100 rounded-full">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Non-Biodegradable Waste</p>
                            <h3 class="text-2xl font-bold">
                                {{ number_format($wasteByType->non_biodegradable ?? 0, 2) }} kg</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Waste Collection by Barangay -->
            <div class="p-6 mb-8 bg-white rounded-lg shadow">
                <h3 class="mb-4 text-xl font-bold">Waste Collection by Barangay</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3">Barangay</th>
                                <th scope="col" class="px-6 py-3">Total Waste (kg)</th>
                                <th scope="col" class="px-6 py-3">Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalBarangayWaste = $wasteByBarangay->sum('total_volume');
                            @endphp

                            @foreach ($wasteByBarangay as $barangayWaste)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $barangayWaste->name }}</td>
                                    <td class="px-6 py-4">{{ number_format($barangayWaste->total_volume, 2) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @php
                                                $percentage =
                                                    $totalBarangayWaste > 0
                                                        ? ($barangayWaste->total_volume / $totalBarangayWaste) * 100
                                                        : 0;
                                            @endphp
                                            <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2">
                                                <div class="bg-green-600 h-2.5 rounded-full"
                                                    style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <span>{{ number_format($percentage, 1) }}%</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Upcoming Collection Schedules -->
            <div class="p-6 bg-white rounded-lg shadow">
                <h3 class="mb-4 text-xl font-bold">Upcoming Collection Schedules</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3">Barangay</th>
                                <th scope="col" class="px-6 py-3">Collection Date</th>
                                <th scope="col" class="px-6 py-3">Collection Time</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($upcomingSchedules as $schedule)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $schedule->barangay->name }}</td>
                                    <td class="px-6 py-4">{{ $schedule->collection_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">{{ $schedule->collection_time->format('h:i A') }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ ucfirst($schedule->status) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Download Full Report Button -->
            <div class="mt-8 text-center">
                <a href="{{ url('/admin/export-waste-report?' . http_build_query(request()->query())) }}"
                    target="_blank"
                    class="inline-flex items-center px-6 py-3 font-semibold text-white bg-green-700 rounded-md shadow hover:bg-green-800">
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

    <!-- Documents Section -->
    <section id="documents" class="py-16 bg-white">
        <div class="container px-4 mx-auto">
            <h2 class="mb-10 text-3xl font-bold text-center text-green-800">Documents</h2>

            @if ($documents->count() > 0)
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    @foreach ($documents as $category => $categoryDocuments)
                        <div class="p-6 rounded-lg shadow bg-green-50">
                            <h3 class="pb-2 mb-4 text-xl font-bold text-green-800 border-b">{{ $category }}</h3>
                            <ul class="space-y-4">
                                @foreach ($categoryDocuments as $document)
                                    <li class="pb-4 border-b border-gray-200 last:border-0">
                                        <h4 class="mb-1 text-lg font-semibold">{{ $document->title }}</h4>
                                        <p class="mb-2 text-gray-600">{{ $document->description }}</p>

                                        <div class="flex space-x-2">
                                            @if ($document->file)
                                                <a href="{{ asset('storage/' . $document->file) }}" target="_blank"
                                                    class="inline-flex items-center px-3 py-1.5 bg-green-700 text-white text-sm rounded hover:bg-green-800">
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
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
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
                <div class="py-8 text-center rounded-lg bg-green-50">
                    <p class="text-lg text-gray-600">No documents available at this time.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Barangays Section -->
    <section id="barangays" class="py-16 bg-green-50">
        <div class="container px-4 mx-auto">
            <h2 class="mb-10 text-3xl font-bold text-center text-green-800">Barangays</h2>

            <div class="flex justify-end mb-4">
                <div class="inline-flex rounded-md shadow">
                    <button id="sort-name"
                        class="px-4 py-2 text-sm font-medium text-green-800 bg-white rounded-l-lg">Sort by
                        Name</button>
                    <button id="sort-population"
                        class="px-4 py-2 text-sm font-medium text-white bg-green-700 rounded-r-lg">Sort by
                        Population</button>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3" id="barangays-grid">
                @foreach ($barangays as $barangay)
                    <div class="overflow-hidden bg-white rounded-lg shadow" data-name="{{ $barangay->name }}"
                        data-population="{{ $barangay->population }}">
                        <div class="p-6">
                            <h3 class="mb-2 text-xl font-bold text-green-800">{{ $barangay->name }}</h3>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Population:</span>
                                <span class="font-medium">{{ number_format($barangay->population) }}</span>
                            </div>
                            <div class="flex justify-between mb-4">
                                <span class="text-gray-600">Area:</span>
                                <span class="font-medium">{{ number_format($barangay->area, 2) }} km²</span>
                            </div>

                            @php
                                $barangayWaste = $wasteByBarangay->firstWhere('barangay_id', $barangay->barangay_id);
                                $wasteVolume = $barangayWaste ? $barangayWaste->total_volume : 0;
                            @endphp

                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-700">Waste Collection (Current Period)</p>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                    @php
                                        $maxWaste = $wasteByBarangay->max('total_volume') ?: 1;
                                        $percentage = ($wasteVolume / $maxWaste) * 100;
                                    @endphp
                                    <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $percentage }}%">
                                    </div>
                                </div>
                                <p class="mt-1 text-xs text-right text-gray-600">{{ number_format($wasteVolume, 2) }}
                                    kg</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Officials Section -->
    <section id="officials" class="py-16 bg-white">
        <div class="container px-4 mx-auto">
            <h2 class="mb-10 text-3xl font-bold text-center text-green-800">Municipal Officials</h2>

            @if ($officials->count() > 0)
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    @foreach ($officials as $category => $categoryOfficials)
                        <div class="p-6 rounded-lg shadow bg-green-50">
                            <h3 class="pb-2 mb-4 text-xl font-bold text-green-800 border-b border-green-200">
                                {{ $category }}</h3>

                            <ul class="space-y-4">
                                @foreach ($categoryOfficials as $official)
                                    <li class="pb-2 border-b border-gray-200 last:border-0">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h4 class="font-medium">{{ $official->name }}</h4>
                                                <p class="text-sm text-gray-600">{{ $official->position }}</p>
                                            </div>
                                            @if ($official->barangay)
                                                <span
                                                    class="px-2 py-1 text-xs text-green-800 bg-green-100 rounded">{{ $official->barangay->name }}</span>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-8 text-center rounded-lg bg-green-50">
                    <p class="text-lg text-gray-600">No officials data available at this time.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 text-white bg-green-900">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div>
                    <h3 class="mb-4 text-lg font-bold">Municipality of Malvar</h3>
                    <p class="mb-4">Environmental Management System</p>
                    <div class="flex items-center">
                        <img src="{{ asset('images/malvar_logo.jpg') }}" alt="Malvar Logo"
                            class="w-12 h-12 mr-3 rounded-full">
                    </div>
                </div>

                <div>
                    <h3 class="mb-4 text-lg font-bold">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#announcements" class="hover:text-green-200">Announcements</a></li>
                        <li><a href="#waste-collection" class="hover:text-green-200">Waste Collection</a></li>
                        <li><a href="#documents" class="hover:text-green-200">Documents</a></li>
                        <li><a href="#barangays" class="hover:text-green-200">Barangays</a></li>
                        <li><a href="#officials" class="hover:text-green-200">Officials</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="mb-4 text-lg font-bold">Contact Information</h3>
                    <address class="not-italic">
                        <p class="mb-2">Municipal Hall, Malvar, Batangas</p>
                        <p class="mb-2">Phone: (123) 456-7890</p>
                        <p class="mb-2">Email: info@malvar.gov.ph</p>
                    </address>
                </div>
            </div>

            <div class="pt-8 mt-8 text-sm text-center border-t border-green-800">
                <p>&copy; 2025 Municipality of Malvar. Environmental Management System. All rights reserved.</p>
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
                sortByName.classList.remove('bg-green-700', 'text-white');
                sortByName.classList.add('bg-white', 'text-green-800');
                sortByPopulation.classList.remove('bg-white', 'text-green-800');
                sortByPopulation.classList.add('bg-green-700', 'text-white');
            });

            sortByPopulation.addEventListener('click', function() {
                sortBarangays('population');
                sortByPopulation.classList.remove('bg-green-700', 'text-white');
                sortByPopulation.classList.add('bg-white', 'text-green-800');
                sortByName.classList.remove('bg-white', 'text-green-800');
                sortByName.classList.add('bg-green-700', 'text-white');
            });
        });
    </script>
</body>

</html>
