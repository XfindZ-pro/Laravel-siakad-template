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
            body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfdfe; }
            [x-cloak] { display: none !important; }
            .glass-effect { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); }
            .animate-fade-up { animation: fadeUp 0.6s ease-out forwards; }
            @keyframes fadeUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>

    <body class="min-h-screen selection:bg-blue-600 selection:text-white">

        <div x-data="{
            openCreate: false,
            openEdit: false,
            student: { id: '', name: '', email: '', prodi: 'Informatika', angkatan: 2023, is_graduated: false, gender: 'Laki-laki' }
        }">

            <!-- Navbar -->
            <nav class="glass-effect border-b border-slate-100 sticky top-0 z-40 transition-all">
                <div class="max-w-7xl mx-auto px-6 lg:px-10 h-20 flex justify-between items-center">
                    <div class="flex items-center gap-10">
                        <!-- Logo -->
                        <div class="flex items-center gap-3 group cursor-pointer">
                            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200 group-hover:rotate-6 transition-all">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            </div>
                            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">SIAkad<span class="text-blue-600">.</span></h1>
                        </div>
                        <div class="hidden md:flex gap-2">
                            <button class="px-4 py-2 bg-blue-50 text-blue-700 rounded-xl text-sm font-bold transition-all">Dashboard</button>
                            <button class="px-4 py-2 text-slate-400 text-sm font-bold">Students</button>
                            <button class="px-4 py-2 text-slate-400 text-sm font-bold">Settings</button>
                        </div>
                    </div>

                    <button @click="openCreate = true" type="button"
                        class="px-6 py-2.5 bg-slate-900 hover:bg-blue-600 text-white rounded-xl font-bold shadow-xl shadow-slate-100 transition-all active:scale-95 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        Tambahkan Mahasiswa
                    </button>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto py-10 px-6 lg:px-10">

                <div class="mb-10 animate-fade-up">
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Academic Overview</h2>
                    <p class="text-slate-400 mt-1 font-medium italic">Manajemen sistem informasi akademik mahasiswa.</p>
                </div>

                <!-- Stats Tabs -->
                <div class="flex flex-wrap items-center gap-4 mb-10 animate-fade-up" style="animation-delay: 0.1s">
                    <div class="bg-white px-5 py-3 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 shrink-0 hover:shadow-md transition-all">
                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-8 0 3 3 0 018 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest leading-none">Total</h4>
                            <p class="text-xl font-black text-slate-900 mt-1 leading-none">{{ array_sum($prodiData) }}</p>
                        </div>
                    </div>
                    <div class="bg-white px-5 py-3 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 shrink-0">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest leading-none">Graduated</h4>
                            <p class="text-xl font-black text-slate-900 mt-1 leading-none">{{ array_sum($graduatedData) }}</p>
                        </div>
                    </div>
                    <div class="bg-white px-5 py-3 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 shrink-0">
                        <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest leading-none">Active</h4>
                            <p class="text-xl font-black text-slate-900 mt-1 leading-none">{{ array_sum($prodiData) - array_sum($graduatedData) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12 animate-fade-up" style="animation-delay: 0.2s">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-100/50">
                        <h3 class="font-black text-slate-800 text-xs uppercase tracking-widest mb-6">Per Program Studi</h3>
                        <div class="h-56 relative"><canvas id="prodiChart"></canvas></div>
                    </div>
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-100/50">
                        <h3 class="font-black text-slate-800 text-xs uppercase tracking-widest mb-6">Tren Akademik</h3>
                        <div class="h-56 relative"><canvas id="combinedChart"></canvas></div>
                    </div>
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-100/50">
                        <h3 class="font-black text-slate-800 text-xs uppercase tracking-widest mb-6">Distribusi Gender</h3>
                        <div class="h-56 relative"><canvas id="genderChart"></canvas></div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/40 overflow-hidden animate-fade-up" style="animation-delay: 0.3s">
                    <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/20">
                        <h3 class="text-lg font-black text-slate-900">List Mahasiswa</h3>
                        <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-bold rounded-lg uppercase tracking-widest">Total {{ $students->total() }} Records</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] border-b border-slate-100">
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
                                            <div class="w-10 h-10 bg-slate-900 rounded-xl flex items-center justify-center text-white font-black text-sm">
                                                {{ substr($s->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-900 text-sm">{{ $s->name }}</div>
                                                <div class="text-[10px] text-slate-400 font-medium italic">{{ $s->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4"><span class="px-3 py-1 bg-blue-50 text-blue-700 text-[10px] font-black rounded-lg uppercase tracking-wider">{{ $s->prodi }}</span></td>
                                    <td class="px-6 py-4 text-center font-bold text-slate-500 text-sm italic">{{ $s->angkatan }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @if($s->is_graduated)
                                            <span class="px-3 py-1 bg-emerald-500 text-white text-[9px] font-black rounded-lg uppercase">Lulus</span>
                                        @else
                                            <span class="px-3 py-1 bg-blue-500 text-white text-[9px] font-black rounded-lg uppercase">Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-4">
                                        <div class="flex justify-center items-center gap-2">
                                            <button @click="student = {{ json_encode($s) }}; openEdit = true" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-all shadow-sm"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                            <form action="{{ route('student.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus data?')" class="m-0">@csrf @method('DELETE')<button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all shadow-sm"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-8 py-5 bg-slate-50/50 border-t border-slate-100">{{ $students->links() }}</div>
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

                // Combined Chart
                new Chart(document.getElementById('combinedChart'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode(array_keys($angkatanData)) !!},
                        datasets: [
                            { data: {!! json_encode(array_values($angkatanData)) !!}, borderColor: '#2563eb', backgroundColor: 'rgba(37, 99, 235, 0.1)', fill: true, tension: 0.4, borderWidth: 4, pointRadius: 0 },
                            { data: {!! json_encode(array_values($graduatedData)) !!}, borderColor: '#10b981', backgroundColor: 'rgba(16, 185, 129, 0.1)', fill: true, tension: 0.4, borderWidth: 4, pointRadius: 0 }
                        ]
                    },
                    options: { ...baseOptions, plugins: { legend: { display: true, position: 'bottom' } } }
                });

                // Gender Chart
                new Chart(document.getElementById('genderChart'), {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode(array_keys($genderData)) !!},
                        datasets: [{ data: {!! json_encode(array_values($genderData)) !!}, backgroundColor: ['#2563eb', '#db2777'], borderWidth: 0, cutout: '70%' }]
                    },
                    options: { ...baseOptions, plugins: { legend: { display: true, position: 'bottom' } } }
                });
            });
        </script>
    </body>
</html>