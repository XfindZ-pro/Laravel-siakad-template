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
    </head>

    <body class="bg-[#f8fafc] min-h-screen font-sans selection:bg-primary selection:text-white">

        <div x-data="{
            openCreate: false,
            openEdit: false,
            openShow: false,
            student: { id: '', name: '', email: '' }
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

                <!-- Main Data Table Card -->
                <div class="bg-white rounded-3xl shadow-2xl shadow-slate-200/50 border border-slate-200 overflow-hidden animate-scale-in">
                    
                    <!-- Table Header -->
                    <div class="grid grid-cols-3 bg-slate-50 border-b border-slate-200 px-8 py-5 font-bold text-slate-500 text-xs uppercase tracking-widest">
                        <div>Student Name</div>
                        <div>Email Address</div>
                        <div class="text-right pr-4">Actions</div>
                    </div>

                    <!-- Student List -->
                    <div class="divide-y divide-slate-100">
                        @forelse($students as $index => $student)
                            <div class="grid grid-cols-3 items-center px-8 py-6 hover:bg-slate-50/50 transition-colors group" 
                                 style="animation: fade-in-up {{ 0.3 + ($index * 0.05) }}s ease-out forwards">

                                <!-- Name -->
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-xl bg-slate-900 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-slate-200">
                                        {{ substr($student->name, 0, 1) }}
                                    </div>
                                    <span class="font-bold text-slate-900 text-lg">
                                        {{ $student->name }}
                                    </span>
                                </div>

                                <!-- Email -->
                                <div class="text-slate-600 font-semibold">
                                    {{ $student->email }}
                                </div>

                                <!-- Actions -->
                                <div class="flex justify-end gap-3">
                                    <!-- Edit Button -->
                                    <button 
                                        @click="
                                            openEdit = true;
                                            student.id = '{{ $student->id }}';
                                            student.name = '{{ $student->name }}';
                                            student.email = '{{ $student->email }}';"
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

                <!-- Footer Info -->
                <div class="mt-8 text-center text-slate-400 text-sm font-medium">
                    &copy; {{ date('Y') }} SIAkad Digital Solution. All rights reserved.
                </div>

            </div>

            <!-- Modal Overlays -->
            @include('student.form')

        </div>
        
    </body>
</html>