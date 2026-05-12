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
            
            <!-- Main Content Container -->
            <div class="max-w-5xl mx-auto py-12 px-6">

                <!-- Header Section -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6 animate-fade-in-up">
                    <div>
                        <div class="inline-block px-3 py-1 rounded-lg bg-slate-100 text-slate-600 text-xs font-bold tracking-wider uppercase mb-3">
                            Management Dashboard
                        </div>
                        <h1 class="text-5xl font-black text-slate-900 tracking-tight">
                            SIAkad<span class="text-accent">.</span>
                        </h1>
                        <p class="text-slate-600 mt-3 text-lg max-w-md leading-relaxed font-medium">
                            Efficiently manage student data with our professional academic system.
                        </p>
                    </div>

                    <button
                        @click="openCreate = true"
                        class="inline-flex items-center justify-center px-8 py-4 font-bold text-white transition-all duration-200 bg-slate-900 rounded-xl hover:bg-slate-800 shadow-xl shadow-slate-200 active:scale-95">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New Student
                    </button>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12 animate-fade-in-up" style="animation-delay: 0.1s">
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
                <div class="bg-white rounded-3xl shadow-2xl shadow-slate-200/50 border border-slate-200 overflow-hidden animate-scale-in">
                    
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