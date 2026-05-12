<!-- CREATE MODAL -->
<div
    x-show="openCreate"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm flex items-center justify-center z-50 p-4">

    <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
        
        <!-- Header -->
        <div class="bg-slate-50 px-8 py-6 border-b border-slate-100">
            <h2 class="text-2xl font-bold text-slate-800">
                New Student Entry
            </h2>
            <p class="text-slate-500 text-sm mt-1">Register a new student to the academic system.</p>
        </div>

        <form action="{{ route('student.store') }}" method="POST" class="p-8 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 px-1">Full Name</label>
                <input type="text"
                    name="name"
                    placeholder="Enter full name"
                    required
                    class="w-full border-2 border-slate-100 bg-slate-50 p-4 rounded-2xl focus:border-slate-900 focus:bg-white focus:outline-none transition-all duration-200 placeholder:text-slate-400">
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 px-1">Email Address</label>
                <input type="email"
                    name="email"
                    placeholder="student@example.com"
                    required
                    class="w-full border-2 border-slate-100 bg-slate-50 p-4 rounded-2xl focus:border-slate-900 focus:bg-white focus:outline-none transition-all duration-200 placeholder:text-slate-400">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 px-1">Program Studi</label>
                    <select name="prodi" required class="w-full border-2 border-slate-100 bg-slate-50 p-4 rounded-2xl focus:border-slate-900 focus:bg-white focus:outline-none transition-all duration-200">
                        <option value="Informatika">Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Elektro">Teknik Elektro</option>
                        <option value="Teknik Mesin">Teknik Mesin</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 px-1">Angkatan</label>
                    <input type="number" name="angkatan" value="2023" required class="w-full border-2 border-slate-100 bg-slate-50 p-4 rounded-2xl focus:border-slate-900 focus:bg-white focus:outline-none transition-all duration-200">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 px-1">Gender</label>
                    <select name="gender" required class="w-full border-2 border-slate-100 bg-slate-50 p-4 rounded-2xl focus:border-slate-900 focus:bg-white focus:outline-none transition-all duration-200">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="flex items-center pt-8">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="hidden" name="is_graduated" value="0">
                        <input type="checkbox" name="is_graduated" value="1" class="w-5 h-5 rounded border-2 border-slate-200 text-slate-900 focus:ring-slate-900 transition-all">
                        <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900 transition-colors">Sudah Lulus</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button
                    type="button"
                    @click="openCreate = false"
                    class="px-6 py-3 rounded-xl font-bold text-slate-400 hover:text-slate-900 transition-colors">
                        Cancel
                </button>

                <button
                    type="submit"
                    class="px-8 py-3 bg-slate-900 hover:bg-black text-white font-bold rounded-xl shadow-lg shadow-slate-200 transition-all active:scale-95">
                        Create Record
                </button>
            </div>

        </form>
    </div>
</div>

<!-- EDIT MODAL -->
<div
    x-show="openEdit"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">

    <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
        
        <!-- Header -->
        <div class="bg-slate-50 px-8 py-6 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Update Student</h2>
                <p class="text-slate-500 text-sm mt-1">Modify existing student information.</p>
            </div>
            <button @click="openEdit = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form
            :action="'/student/' + student.id"
            method="POST"
            class="p-8 space-y-6">

            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 px-1">Full Name</label>
                <input
                    type="text"
                    name="name"
                    x-model="student.name"
                    required
                    class="w-full border-2 border-slate-100 bg-slate-50 p-4 rounded-2xl focus:border-slate-900 focus:bg-white focus:outline-none transition-all duration-200">
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 px-1">Email Address</label>
                <input
                    type="email"
                    name="email"
                    x-model="student.email"
                    required
                    class="w-full border-2 border-slate-100 bg-slate-50 p-4 rounded-2xl focus:border-slate-900 focus:bg-white focus:outline-none transition-all duration-200">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 px-1">Program Studi</label>
                    <select name="prodi" x-model="student.prodi" required class="w-full border-2 border-slate-100 bg-slate-50 p-4 rounded-2xl focus:border-slate-900 focus:bg-white focus:outline-none transition-all duration-200">
                        <option value="Informatika">Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Elektro">Teknik Elektro</option>
                        <option value="Teknik Mesin">Teknik Mesin</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 px-1">Angkatan</label>
                    <input type="number" name="angkatan" x-model="student.angkatan" required class="w-full border-2 border-slate-100 bg-slate-50 p-4 rounded-2xl focus:border-slate-900 focus:bg-white focus:outline-none transition-all duration-200">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 px-1">Gender</label>
                    <select name="gender" x-model="student.gender" required class="w-full border-2 border-slate-100 bg-slate-50 p-4 rounded-2xl focus:border-slate-900 focus:bg-white focus:outline-none transition-all duration-200">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="flex items-center pt-8">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="hidden" name="is_graduated" value="0">
                        <input type="checkbox" name="is_graduated" value="1" x-model="student.is_graduated" class="w-5 h-5 rounded border-2 border-slate-200 text-slate-900 focus:ring-slate-900 transition-all">
                        <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900 transition-colors">Sudah Lulus</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button
                    type="button"
                    @click="openEdit = false"
                    class="px-6 py-3 rounded-xl font-bold text-slate-400 hover:text-slate-900 transition-colors">
                        Discard
                </button>

                <button
                    type="submit"
                    class="px-8 py-3 bg-slate-900 hover:bg-black text-white font-bold rounded-xl shadow-lg shadow-slate-200 transition-all active:scale-95">
                    Save Changes
                </button>
            </div>

        </form>
    </div>
</div>