<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Manajemen Aspirasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">

    <div class="container mx-auto px-6 py-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Pengaduan</h1>
                <p class="text-slate-500 mt-1 flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    Halo, Admin <span class="font-bold text-slate-700">{{ session('admin_username') }}</span>
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('kategori.index') }}" class="bg-white text-indigo-600 border border-indigo-100 px-5 py-3 rounded-2xl font-bold hover:bg-indigo-50 transition shadow-sm flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Kelola Kategori
                </a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf 
                    <button type="submit" class="bg-rose-50 text-rose-600 px-5 py-3 rounded-2xl font-bold hover:bg-rose-100 transition border border-rose-100">
                        Keluar
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm shadow-slate-200/50">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Laporan</p>
                <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $data_aspirasi->count() }}</h3>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm shadow-slate-200/50">
                <p class="text-xs font-bold text-amber-500 uppercase tracking-widest">Sedang Proses</p>
                <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $data_aspirasi->where('status', 'Proses')->count() }}</h3>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm shadow-slate-200/50">
                <p class="text-xs font-bold text-emerald-500 uppercase tracking-widest">Selesai</p>
                <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $data_aspirasi->where('status', 'Selesai')->count() }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="p-6 text-xs font-bold text-slate-400 uppercase tracking-widest">NIS & Lokasi</th>
                            <th class="p-6 text-xs font-bold text-slate-400 uppercase tracking-widest">Kategori</th>
                            <th class="p-6 text-xs font-bold text-slate-400 uppercase tracking-widest">Keterangan</th>
                            <th class="p-6 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Status Laporan</th>
                            <th class="p-6 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($data_aspirasi as $row)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="p-6">
                                <p class="font-bold text-slate-800">#{{ $row->nis }}</p>
                                <p class="text-xs text-slate-500 flex items-center gap-1 mt-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    {{ $row->lokasi }}
                                </p>
                            </td>
                            <td class="p-6">
                                <span class="bg-indigo-50 text-indigo-600 text-[10px] font-bold px-3 py-1.5 rounded-lg border border-indigo-100">
                                    {{ $row->kategori->ket_kategori }}
                                </span>
                            </td>
                            <td class="p-6 max-w-xs">
                                <p class="text-sm text-slate-600 truncate group-hover:whitespace-normal transition-all">
                                    {{ $row->ket }}
                                </p>
                            </td>
                            <td class="p-6 text-center">
                                <form action="{{ route('admin.update-status', $row->id_pelaporan) }}" method="POST" class="inline-block">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" 
                                        class="text-[11px] font-bold border-2 rounded-xl px-3 py-2 cursor-pointer outline-none transition-all
                                        {{ $row->status == 'Selesai' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : '' }}
                                        {{ $row->status == 'Menunggu' ? 'bg-rose-50 text-rose-600 border-rose-100' : '' }}
                                        {{ $row->status == 'Proses' ? 'bg-amber-50 text-amber-600 border-amber-100' : '' }}">
                                        <option value="Menunggu" {{ $row->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="Proses" {{ $row->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="Selesai" {{ $row->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>
                            </td>
                            <td class="p-6 text-center">
                                <a href="{{ route('admin.feedback', $row->id_pelaporan) }}" 
                                class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-xs font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 inline-flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                    Beri Feedback
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        @if($data_aspirasi->isEmpty())
                        <tr>
                            <td colspan="5" class="p-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="bg-slate-50 p-4 rounded-full mb-4">
                                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                    </div>
                                    <p class="text-slate-400 font-medium italic">Belum ada aspirasi yang masuk hari ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>