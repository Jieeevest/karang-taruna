@extends('layouts.public')

@section('title', 'Kegiatan')

@section('content')

{{-- Hero Section --}}
<div class="relative text-white py-20 overflow-hidden" style="background: linear-gradient(to right, rgba(17, 94, 89, 0.85), rgba(17, 94, 89, 0.85)), url('{{ asset('images/homepage/hero-activities.png') }}'); background-size: cover; background-position: center;">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Kegiatan Karang Taruna</h1>
        <p class="text-xl text-blue-100">Program dan aktivitas yang kami jalankan</p>
    </div>
</div>

{{-- Year Filter Section --}}
<div class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-center overflow-x-auto">
            <div class="inline-flex rounded-lg bg-gray-100 p-1">
                <button onclick="filterYear('2026')" class="year-tab px-6 py-3 rounded-md font-semibold transition-all" data-year="2026">2026</button>
                <button onclick="filterYear('2025')" class="year-tab px-6 py-3 rounded-md font-semibold transition-all" data-year="2025">2025</button>
                <button onclick="filterYear('2024')" class="year-tab px-6 py-3 rounded-md font-semibold transition-all" data-year="2024">2024</button>
                <button onclick="filterYear('2023')" class="year-tab px-6 py-3 rounded-md font-semibold transition-all" data-year="2023">2023</button>
            </div>
        </div>
    </div>
</div>

{{-- Activities Grid --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div id="activities-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="col-span-full text-center py-16">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p class="text-gray-500 text-lg">Pilih tahun untuk melihat kegiatan</p>
        </div>
    </div>
</div>

<script>
let currentYear = null;

document.addEventListener('DOMContentLoaded', function() {
    filterYear('2024');
});

function filterYear(year) {
    currentYear = year;
    
    document.querySelectorAll('.year-tab').forEach(tab => {
        if (tab.dataset.year === year) {
            tab.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-teal-600', 'text-white');
            tab.classList.remove('text-gray-700', 'hover:bg-gray-200');
        } else {
            tab.classList.remove('bg-gradient-to-r', 'from-blue-600', 'to-teal-600', 'text-white');
            tab.classList.add('text-gray-700', 'hover:bg-gray-200');
        }
    });
    
    fetchActivities(year);
}

function fetchActivities(year) {
    const container = document.getElementById('activities-container');
    
    container.innerHTML = `
        <div class="col-span-full text-center py-16">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            <p class="mt-4 text-gray-600">Memuat kegiatan...</p>
        </div>
    `;
    
    fetch(`/api/activities?year=${year}`)
        .then(response => response.json())
        .then(data => {
            if (data.activities && data.activities.length > 0) {
                displayActivities(data.activities);
            } else {
                container.innerHTML = `
                    <div class="col-span-full text-center py-16 bg-gray-50 rounded-2xl">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg">Belum ada kegiatan pada tahun ${year}</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            container.innerHTML = `
                <div class="col-span-full text-center py-16 bg-gray-50 rounded-2xl">
                    <svg class="mx-auto h-16 w-16 text-red-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">Gagal memuat kegiatan</p>
                </div>
            `;
        });
}

function displayActivities(activities) {
    const container = document.getElementById('activities-container');
    
    const cardsHTML = activities.map(activity => {
        const isUpcoming = new Date(activity.date) >= new Date();
        return `
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="h-48 overflow-hidden">
                    ${activity.image 
                        ? `<img src="${activity.image}" alt="${activity.title}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">`
                        : `<div class="w-full h-full bg-gradient-to-br from-blue-400 to-teal-500 flex items-center justify-center">
                            <svg class="h-20 w-20 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                           </div>`
                    }
                </div>
                <div class="p-6">
                    ${activity.category 
                        ? `<span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-3">${activity.category}</span>`
                        : ''
                    }
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">
                        ${activity.title}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">${activity.description}</p>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            ${activity.date}
                        </div>
                    </div>

                    <span class="inline-flex items-center text-sm font-semibold ${isUpcoming ? 'text-green-600' : 'text-gray-500'}">
                        <span class="w-2 h-2 rounded-full ${isUpcoming ? 'bg-green-600' : 'bg-gray-400'} mr-2"></span>
                        ${isUpcoming ? 'Akan Datang' : 'Selesai'}
                    </span>
                </div>
            </div>
        `;
    }).join('');
    
    container.innerHTML = cardsHTML;
}
</script>

@endsection
