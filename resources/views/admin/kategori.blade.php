<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori | Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen pb-12">

    <div class="container mx-auto px-6 py-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-200">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Kategori</h1>
                </div>
                <p class="text-slate-500 font-medium ml-11">Kelola klasifikasi pengaduan sarana sekolah.</p>
            </div>
            
            <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-2 bg-white text-slate-600 px-6 py-3 rounded-2xl font-bold border border-slate-200 hover:bg-slate-50 transition shadow-sm">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Dashboard
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 sticky top-10">
                    <h2 class="text-xl font-black text-slate-800 mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-indigo-600 rounded-full"></span>
                        Tambah Baru
                    </h2>
                    
                    @if(session('success'))
                        <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-5 py-4 rounded-2xl mb-6 text-sm flex items-center gap-3 font-medium animate-bounce">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('kategori.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3 ml-1">Nama Kategori</label>
                            <input type="text" name="ket_kategori" 
                                   class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-5 py-4 text-slate-700 font-semibold focus:bg-white focus:border-indigo-500 outline-none transition-all @error('ket_kategori') border-rose-500 @enderror"
                                   placeholder="Misal: Laboratorium, Lapangan..." required>
                            @error('ket_kategori')
                                <p class="text-rose-500 text-xs mt-2 ml-1 font-medium italic">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" class="w-full bg-indigo-600 text-white font-black py-5 rounded-2xl hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition transform active:scale-[0.97] flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            Simpan Kategori
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                    <div class="p-8 border-b border-slate-50 bg-slate-50/30">
                        <h3 class="text-lg font-bold text-slate-800 uppercase tracking-wider">Daftar Kategori Saat Ini</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-100">
                                    <th class="p-6 text-xs font-bold text-slate-400 uppercase tracking-widest w-24">ID</th>
                                    <th class="p-6 text-xs font-bold text-slate-400 uppercase tracking-widest">Keterangan Kategori</th>
                                    <th class="p-6 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Label Preview</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($kategoris as $k)
                                <tr class="hover:bg-slate-50/80 transition-colors group">
                                    <td class="p-6">
                                        <span class="text-xs font-bold text-slate-300 group-hover:text-indigo-400 transition-colors">#{{ $k->id_kategori }}</span>
                                    </td>
                                    <td class="p-6">
                                        <p class="font-extrabold text-slate-700">{{ $k->ket_kategori }}</p>
                                    </td>
                                    <td class="p-6 text-right">
                                        <span class="inline-block bg-indigo-50 text-indigo-600 text-[10px] font-black px-4 py-2 rounded-xl border border-indigo-100 shadow-sm">
                                            {{ strtoupper($k->ket_kategori) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach

                                @if($kategoris->isEmpty())
                                <tr>
                                    <td colspan="3" class="p-20 text-center">
                                        <div class="flex flex-col items-center opacity-30">
                                            <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                            <p class="font-bold italic">Belum ada kategori yang dibuat.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>