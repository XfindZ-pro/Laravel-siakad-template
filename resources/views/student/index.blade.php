<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIAkad | Premium Academic System</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body class="bg-[#f8fafc] min-h-screen font-sans selection:bg-primary selection:text-white">

        <div x-data="{
            openCreate: false,
            openEdit: false,
            openShow: false,
            activeTab: 'data',
            student: { 
                id: '', 
                name: '', 
                email: '',
                prodi: 'Informatika',
                angkatan: 2023,
                is_graduated: false,
                gender: 'Laki-laki'
            }
        }">

            <!-- Navbar -->
            <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-40">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="flex justify-between h-20">
                        <div class="flex items-center gap-12">
                            <!-- Logo -->
                            <div class="flex items-center gap-2">
                                <h1 class="text-3xl font-black text-slate-900 tracking-tight">
                                    SIAkad<span class="text-blue-600">.</span>
                                </h1>
                            </div>

                            <!-- Nav Links -->
                            <div class="hidden md:flex items-center gap-8">
                                <a href="#" 
                                   @click.prevent="activeTab = 'data'"
                                   :class="activeTab === 'data' ? 'text-blue-600' : 'text-slate-500 hover:text-slate-900'"
                                   class="text-sm font-bold transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2-2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                    Data Mahasiswa
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <button
                                @click="openCreate = true"
                                class="inline-flex items-center justify-center px-6 py-3 font-bold text-white transition-all duration-200 bg-slate-900 rounded-xl hover:bg-blue-600 shadow-lg shadow-slate-200 active:scale-95 text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add New Student
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Main Content Container -->
            <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">

                <!-- Header Section -->
                <div class="mb-10 animate-fade-in-up" x-show="activeTab === 'data'">
                    <div class="inline-block px-3 py-1 rounded-lg bg-blue-50 text-blue-600 text-xs font-bold tracking-wider uppercase mb-3">
                        Academic Overview
                    </div>
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight">
                        Data Mahasiswa
                    </h2>
                    <p class="text-slate-500 mt-2 text-lg font-medium">
                        Visualisasi statistik dan manajemen data mahasiswa SIAkad.
                    </p>
                </div>

                <!-- Charts Section -->
                <div x-show="activeTab === 'data'" class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12 animate-fade-in-up" style="animation-delay: 0.1s">
                    <!-- Bar Chart: Students per Prodi -->
                    <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <span class="w-2 h-6 bg-blue-500 rounded-full"></span>
                            Mahasiswa per Program Studi
                        </h3>
                        <div class="h-64">
                            <canvas id="prodiChart"></canvas>
                        </div>
                    </div>

                    <!-- Line Chart: Students per Angkatan -->
                    <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <span class="w-2 h-6 bg-emerald-500 rounded-full"></span>
                            Pertumbuhan Mahasiswa
                        </h3>
                        <div class="h-64">
                            <canvas id="angkatanChart"></canvas>
                        </div>
                    </div>

                    <!-- Line Chart: Graduated per Angkatan -->
                    <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <span class="w-2 h-6 bg-orange-500 rounded-full"></span>
                            Statistik Kelulusan
                        </h3>
                        <div class="h-64">
                            <canvas id="graduatedChart"></canvas>
                        </div>
                    </div>

                    <!-- Pie Chart: Gender Distribution -->
                    <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <span class="w-2 h-6 bg-purple-500 rounded-full"></span>
                            Distribusi Gender
                        </h3>
                        <div class="h-64 flex justify-center">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Main Data Table Card -->
                <div x-show="activeTab === 'data'" class="bg-white rounded-3xl shadow-2xl shadow-slate-200/50 border border-slate-200 overflow-hidden animate-scale-in" style="animation-delay: 0.2s">
                    
                    <!-- Table Header -->
                    <div class="grid grid-cols-6 bg-slate-50 border-b border-slate-200 px-8 py-5 font-bold text-slate-500 text-xs uppercase tracking-widest">
                        <div class="col-span-2">Student Name</div>
                        <div>Program Studi</div>
                        <div>Angkatan</div>
                        <div>Status</div>
                        <div class="text-right pr-4">Actions</div>
                    </div>

                    <!-- Student List -->
                    <div class="divide-y divide-slate-100">
                        @forelse($students as $index => $student)
                            <div class="grid grid-cols-6 items-center px-8 py-6 hover:bg-slate-50/50 transition-colors group" 
                                 style="animation: fade-in-up {{ 0.3 + ($index * 0.05) }}s ease-out forwards">

                                <!-- Name -->
                                <div class="col-span-2 flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-xl bg-slate-900 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-slate-200">
                                        {{ substr($student->name, 0, 1) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-900 text-lg leading-tight">
                                            {{ $student->name }}
                                        </span>
                                        <span class="text-xs text-slate-400 font-medium">
                                            {{ $student->email }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Prodi -->
                                <div class="text-slate-600 font-bold text-sm">
                                    {{ $student->prodi }}
                                </div>

                                <!-- Angkatan -->
                                <div class="text-slate-500 font-bold">
                                    {{ $student->angkatan }}
                                </div>

                                <!-- Status -->
                                <div>
                                    @if($student->is_graduated)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-600">
                                            Lulus
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-600">
                                            Aktif
                                        </span>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="flex justify-end gap-3">
                                    <!-- Edit Button -->
                                    <button 
                                        @click="
                                            openEdit = true;
                                            student.id = '{{ $student->id }}';
                                            student.name = '{{ $student->name }}';
                                            student.email = '{{ $student->email }}';
                                            student.prodi = '{{ $student->prodi }}';
                                            student.angkatan = '{{ $student->angkatan }}';
                                            student.is_graduated = {{ $student->is_graduated ? 'true' : 'false' }};
                                            student.gender = '{{ $student->gender }}';"
                                        class="p-3 rounded-xl border-2 border-slate-100 text-slate-400 hover:border-slate-900 hover:text-slate-900 transition-all duration-200 active:scale-90"
                                        title="Edit Student">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('student.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Delete this record permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="p-3 rounded-xl border-2 border-slate-100 text-slate-400 hover:border-red-500 hover:text-red-500 transition-all duration-200 active:scale-90"
                                            title="Delete Student">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="px-8 py-20 text-center">
                                <h3 class="text-slate-900 font-bold text-xl">No Students Found</h3>
                                <p class="text-slate-500 mt-2">Start by adding your first student.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Pagination Section -->
                <div class="mt-8">
                    {{ $students->links() }}
                </div>

                <!-- Footer Info -->
                <div class="mt-8 text-center text-slate-400 text-sm font-medium">
                    &copy; {{ date('Y') }} SIAkad Digital Solution. All rights reserved.
                </div>

            </div>

            <!-- Modal Overlays -->
            @include('student.form')

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const chartConfig = {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: true,
                                color: 'rgba(0,0,0,0.03)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                };

                // 1. Bar Chart: Prodi
                new Chart(document.getElementById('prodiChart'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode(array_keys($prodiData)) !!},
                        datasets: [{
                            label: 'Jumlah Mahasiswa',
                            data: {!! json_encode(array_values($prodiData)) !!},
                            backgroundColor: 'rgba(59, 130, 246, 0.8)',
                            borderRadius: 12,
                            borderSkipped: false,
                        }]
                    },
                    options: chartConfig
                });

                // 2. Line Chart: Angkatan
                new Chart(document.getElementById('angkatanChart'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode(array_keys($angkatanData)) !!},
                        datasets: [{
                            label: 'Total Mahasiswa',
                            data: {!! json_encode(array_values($angkatanData)) !!},
                            borderColor: 'rgb(16, 185, 129)',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 6,
                            pointBackgroundColor: '#fff',
                            pointBorderWidth: 3,
                            pointBorderColor: 'rgb(16, 185, 129)',
                        }]
                    },
                    options: chartConfig
                });

                // 3. Line Chart: Graduated
                new Chart(document.getElementById('graduatedChart'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode(array_keys($graduatedData)) !!},
                        datasets: [{
                            label: 'Lulusan',
                            data: {!! json_encode(array_values($graduatedData)) !!},
                            borderColor: 'rgb(245, 158, 11)',
                            backgroundColor: 'rgba(245, 158, 11, 0.1)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 6,
                            pointBackgroundColor: '#fff',
                            pointBorderWidth: 3,
                            pointBorderColor: 'rgb(245, 158, 11)',
                        }]
                    },
                    options: chartConfig
                });

                // 4. Pie Chart: Gender
                new Chart(document.getElementById('genderChart'), {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode(array_keys($genderData)) !!},
                        datasets: [{
                            data: {!! json_encode(array_values($genderData)) !!},
                            backgroundColor: [
                                'rgba(59, 130, 246, 0.8)',
                                'rgba(236, 72, 153, 0.8)'
                            ],
                            borderWidth: 0,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        ...chartConfig,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom'
                            }
                        },
                        scales: {
                            display: false
                        },
                        cutout: '70%'
                    }
                });
            });
        </script>
        
    </body>
</html>