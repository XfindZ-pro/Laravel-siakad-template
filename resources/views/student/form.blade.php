<!-- CREATE MODAL -->
<div
    x-show="openCreate"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-8 md:p-24">

    <div 
        @click.away="openCreate = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        class="bg-white w-full max-w-md rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.2)] overflow-hidden border border-slate-100 flex flex-col max-h-[500px]">
        
        <!-- Header -->
        <div class="bg-white px-6 py-4 border-b border-slate-100 flex justify-between items-center shrink-0">
            <div>
                <h2 class="text-lg font-bold text-slate-900">New Student</h2>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-tight">Entry Form</p>
            </div>
            <button @click="openCreate = false" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form action="{{ route('student.store') }}" method="POST" class="flex flex-col flex-1 overflow-hidden">
            @csrf

            <!-- Scrollable Content -->
            <div class="p-6 space-y-4 overflow-y-auto flex-1 min-h-0 custom-scrollbar">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 px-1">Full Name</label>
                    <input type="text" name="name" placeholder="Enter name" required
                        class="w-full border-2 border-slate-50 bg-slate-50 px-4 py-2.5 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all text-sm font-bold">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 px-1">Email Address</label>
                    <input type="email" name="email" placeholder="student@example.com" required
                        class="w-full border-2 border-slate-50 bg-slate-50 px-4 py-2.5 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all text-sm font-bold">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 px-1">Program Studi</label>
                        <select name="prodi" required class="w-full border-2 border-slate-50 bg-slate-50 px-4 py-2.5 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all text-sm font-bold">
                            <option value="Informatika">Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Teknik Elektro">Teknik Elektro</option>
                            <option value="Teknik Mesin">Teknik Mesin</option>
                            <option value="Teknik Sipil">Teknik Sipil</option>
                            <option value="Psikologi">Psikologi</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 px-1">Angkatan</label>
                        <input type="number" name="angkatan" value="2023" required class="w-full border-2 border-slate-50 bg-slate-50 px-4 py-2.5 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all text-sm font-bold">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 px-1">Gender</label>
                        <select name="gender" required class="w-full border-2 border-slate-50 bg-slate-50 px-4 py-2.5 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all text-sm font-bold">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="flex items-center pt-5">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="hidden" name="is_graduated" value="0">
                            <input type="checkbox" name="is_graduated" value="1" class="w-5 h-5 rounded-lg border-2 border-slate-200 text-blue-600 focus:ring-blue-500 transition-all">
                            <span class="text-[11px] font-black text-slate-500 group-hover:text-blue-600 transition-colors uppercase tracking-wider">Lulus</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Fixed Footer -->
            <div class="px-6 py-4 border-t border-slate-50 flex justify-end gap-3 shrink-0 bg-slate-50/50">
                <button type="button" @click="openCreate = false" class="px-4 py-2 text-xs font-black text-slate-400 hover:text-slate-900 transition-colors uppercase tracking-widest">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-slate-900 hover:bg-blue-600 text-white text-xs font-black rounded-xl shadow-lg shadow-slate-100 transition-all active:scale-95 uppercase tracking-widest">Create</button>
            </div>
        </form>
    </div>
</div>

<!-- EDIT MODAL -->
<div
    x-show="openEdit"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-8 md:p-24">

    <div 
        @click.away="openEdit = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        class="bg-white w-full max-w-md rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.2)] overflow-hidden border border-slate-100 flex flex-col max-h-[500px]">
        
        <!-- Header -->
        <div class="bg-white px-6 py-4 border-b border-slate-100 flex justify-between items-center shrink-0">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Update Profile</h2>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-tight">Edit Mode</p>
            </div>
            <button @click="openEdit = false" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form :action="'/student/' + student.id" method="POST" class="flex flex-col flex-1 overflow-hidden">
            @csrf
            @method('PUT')

            <!-- Scrollable Content -->
            <div class="p-6 space-y-4 overflow-y-auto flex-1 min-h-0 custom-scrollbar">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 px-1">Full Name</label>
                    <input type="text" name="name" x-model="student.name" required
                        class="w-full border-2 border-slate-50 bg-slate-50 px-4 py-2.5 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all text-sm font-bold">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 px-1">Email Address</label>
                    <input type="email" name="email" x-model="student.email" required
                        class="w-full border-2 border-slate-50 bg-slate-50 px-4 py-2.5 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all text-sm font-bold">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 px-1">Program Studi</label>
                        <select name="prodi" x-model="student.prodi" required class="w-full border-2 border-slate-50 bg-slate-50 px-4 py-2.5 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all text-sm font-bold">
                            <option value="Informatika">Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Teknik Elektro">Teknik Elektro</option>
                            <option value="Teknik Mesin">Teknik Mesin</option>
                            <option value="Teknik Sipil">Teknik Sipil</option>
                            <option value="Psikologi">Psikologi</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 px-1">Angkatan</label>
                        <input type="number" name="angkatan" x-model="student.angkatan" required class="w-full border-2 border-slate-50 bg-slate-50 px-4 py-2.5 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all text-sm font-bold">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 px-1">Gender</label>
                        <select name="gender" x-model="student.gender" required class="w-full border-2 border-slate-50 bg-slate-50 px-4 py-2.5 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all text-sm font-bold">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="flex items-center pt-5">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="hidden" name="is_graduated" value="0">
                            <input type="checkbox" name="is_graduated" value="1" x-model="student.is_graduated" class="w-5 h-5 rounded-lg border-2 border-slate-200 text-blue-600 focus:ring-blue-500 transition-all">
                            <span class="text-[11px] font-black text-slate-500 group-hover:text-blue-600 transition-colors uppercase tracking-wider">Lulus</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Fixed Footer -->
            <div class="px-6 py-4 border-t border-slate-50 flex justify-end gap-3 shrink-0 bg-slate-50/50">
                <button type="button" @click="openEdit = false" class="px-4 py-2 text-xs font-black text-slate-400 hover:text-slate-900 transition-colors uppercase tracking-widest">Discard</button>
                <button type="submit" class="px-6 py-2 bg-slate-900 hover:bg-blue-600 text-white text-xs font-black rounded-xl shadow-lg shadow-slate-100 transition-all active:scale-95 uppercase tracking-widest">Update</button>
            </div>
        </form>
    </div>
</div>