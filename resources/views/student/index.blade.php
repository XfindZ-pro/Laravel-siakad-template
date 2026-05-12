<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIAkad - Academic Management System</title>
        
        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            [x-cloak] { display: none !important; }
            .glass-effect { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(15px); }
            .animate-fade-up { animation: fadeUp 0.6s ease-out forwards; }
            @keyframes fadeUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .custom-scrollbar::-webkit-scrollbar { width: 5px; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        </style>
    </head>

    <body class="bg-[#fcfdfe] min-h-screen selection:bg-blue-600 selection:text-white">

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
            <nav class="glass-effect border-b border-slate-100 sticky top-0 z-40">
                <div class="max-w-7xl mx-auto px-6 lg:px-10">
                    <div class="flex justify-between h-20">
                        <div class="flex items-center gap-10">
                            <!-- Logo -->
                            <div class="flex items-center gap-2 group cursor-pointer">
                                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200 transition-transform group-hover:rotate-6">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                                </div>
                                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                                    SIAkad<span class="text-blue-600">.</span>
                                </h1>
                            </div>

                            <!-- Nav Links -->
                            <div class="hidden md:flex items-center gap-1">
                                <a href="#" 
                                   @click.prevent="activeTab = 'data'"
                                   :class="activeTab === 'data' ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:text-slate-900'"
                                   class="px-4 py-2 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                    Dashboard
                                </a>
                                <a href="#" class="px-4 py-2 rounded-xl text-sm font-bold text-slate-400 cursor-not-allowed">Students</a>
                                <a href="#" class="px-4 py-2 rounded-xl text-sm font-bold text-slate-400 cursor-not-allowed">Settings</a>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <button
                                @click="openCreate = true"
                                class="inline-flex items-center justify-center px-6 py-2.5 font-bold text-white transition-all bg-slate-900 hover:bg-blue-600 rounded-xl shadow-lg shadow-slate-200 active:scale-95 text-sm group">
                                <svg class="w-4 h-4 mr-2 text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                Tambahkan Mahasiswa
                            </button>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto py-10 px-6 lg:px-10">

                <!-- Welcome Header -->
                <div class="mb-10 animate-fade-up">
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Academic Overview</h2>
                    <p class="text-slate-400 mt-1 font-medium italic">Manajemen .</p>
                </div>

                <!-- Stats Tabs Row -->
                <div class="flex flex-wrap items-center gap-4 mb-10 animate-fade-up" style="animation-delay: 0.1s">
                    <div class="bg-white px-5 py-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 shrink-0 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-8 0 3 3 0 018 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest leading-none">Total</h4>
                            <p class="text-xl font-black text-slate-900 mt-1 leading-none">{{ array_sum($prodiData) }}</p>
                        </div>
                    </div>

                    <div class="bg-white px-5 py-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 shrink-0 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest leading-none">Graduated</h4>
                            <p class="text-xl font-black text-slate-900 mt-1 leading-none">{{ array_sum($graduatedData) }}</p>
                        </div>
                    </div>

                    <div class="bg-white px-5 py-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 shrink-0 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest leading-none">Active</h4>
                            <p class="text-xl font-black text-slate-900 mt-1 leading-none">{{ array_sum($prodiData) - array_sum($graduatedData) }}</p>
                        </div>
                    </div>

                    <div class="bg-white px-5 py-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 shrink-0 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest leading-none">Programs</h4>
                            <p class="text-xl font-black text-slate-900 mt-1 leading-none">{{ count($prodiData) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12 animate-fade-up" style="animation-delay: 0.2s">
                    <!-- Bar Chart -->
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-100/50">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="font-black text-slate-800 tracking-tight text-sm uppercase italic">Per Program Studi</h3>
                            <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                        </div>
                        <div class="h-56 relative">
                            <canvas id="prodiChart"></canvas>
                        </div>
                    </div>

                    <!-- Combined Line Chart -->
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-100/50">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="font-black text-slate-800 tracking-tight text-sm uppercase italic">Tren Akademik</h3>
                            <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                        </div>
                        <div class="h-56 relative">
                            <canvas id="combinedChart"></canvas>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-100/50">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="font-black text-slate-800 tracking-tight text-sm uppercase italic">Distribusi Gender</h3>
                            <div class="w-2 h-2 bg-pink-500 rounded-full"></div>
                        </div>
                        <div class="h-56 relative">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Student Table Section -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-2xl shadow-slate-200/40 overflow-hidden animate-fade-up" style="animation-delay: 0.3s">
                    <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                        <div>
                            <h3 class="text-lg font-black text-slate-900 tracking-tight italic">List Mahasiswa</h3>
                            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mt-0.5">Total {{ $students->total() }} Records</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 text-slate-500 text-[10px] font-black uppercase tracking-[0.2em] border-b border-slate-100">
                                    <th class="px-8 py-4">Nama Mahasiswa</th>
                                    <th class="px-6 py-4">Program Studi</th>
                                    <th class="px-6 py-4 text-center">Angkatan</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-8 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($students as $s)
                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 bg-slate-900 rounded-lg flex items-center justify-center text-white font-black text-xs">
                                                {{ substr($s->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-900 text-sm leading-none">{{ $s->name }}</div>
                                                <div class="text-[10px] text-slate-400 mt-1 leading-none font-medium">{{ $s->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-bold text-slate-700 uppercase tracking-tight">{{ $s->prodi }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center font-bold text-slate-500 text-sm italic">{{ $s->angkatan }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @if($s->is_graduated)
                                            <span class="px-3 py-1 bg-emerald-500 text-white text-[9px] font-black rounded-lg uppercase tracking-wider shadow-sm shadow-emerald-100">Lulus</span>
                                        @else
                                            <span class="px-3 py-1 bg-blue-500 text-white text-[9px] font-black rounded-lg uppercase tracking-wider shadow-sm shadow-blue-100">Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-4">
                                        <div class="flex justify-center items-center gap-2">
                                            <!-- Edit -->
                                            <button 
                                                @click="student = {{ json_encode($s) }}; openEdit = true" 
                                                class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-all shadow-sm"
                                                title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </button>
                                            
                                            <!-- Delete -->
                                            <form action="{{ route('student.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')" class="m-0">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all shadow-sm" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-8 py-5 bg-slate-50/50 border-t border-slate-100">
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
            </div>

            @include('student.form')
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const baseOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { display: false }, border: { display: false } },
                        x: { grid: { display: false }, border: { display: false } }
                    }
                };

                // Prodi Chart
                new Chart(document.getElementById('prodiChart'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode(array_keys($prodiData)) !!},
                        datasets: [{
                            data: {!! json_encode(array_values($prodiData)) !!},
                            backgroundColor: 'rgba(37, 99, 235, 0.9)',
                            borderRadius: 10,
                            barThickness: 24
                        }]
                    },
                    options: baseOptions
                });

                // Combined Chart (Enrollment & Graduation)
                new Chart(document.getElementById('combinedChart'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode(array_keys($angkatanData)) !!},
                        datasets: [
                            {
                                label: 'Pendaftaran',
                                data: {!! json_encode(array_values($angkatanData)) !!},
                                borderColor: '#2563eb',
                                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                                fill: true,
                                tension: 0.4,
                                borderWidth: 4,
                                pointRadius: 0
                            },
                            {
                                label: 'Kelulusan',
                                data: {!! json_encode(array_values($graduatedData)) !!},
                                borderColor: '#10b981',
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                fill: true,
                                tension: 0.4,
                                borderWidth: 4,
                                pointRadius: 0
                            }
                        ]
                    },
                    options: {
                        ...baseOptions,
                        plugins: { legend: { display: true, position: 'bottom' } }
                    }
                });

                // Gender Pie Chart
                new Chart(document.getElementById('genderChart'), {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode(array_keys($genderData)) !!},
                        datasets: [{
                            data: {!! json_encode(array_values($genderData)) !!},
                            backgroundColor: ['#2563eb', '#db2777'],
                            hoverOffset: 10,
                            borderWidth: 0
                        }]
                    },
                    options: {
                        ...baseOptions,
                        cutout: '70%',
                        plugins: { legend: { display: true, position: 'bottom' } }
                    }
                });
            });
        </script>
    </body>
</html>