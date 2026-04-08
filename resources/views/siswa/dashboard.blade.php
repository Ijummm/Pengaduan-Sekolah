<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa | Aspirasi Siswa SMKN 11</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                </div>
                <h1 class="text-xl font-extrabold text-slate-800 tracking-tight">Panel Aspirasi</h1>
            </div>
            <div class="flex items-center gap-6">
                <div class="hidden md:block text-right">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Siswa Aktif</p>
                    <p class="text-sm font-bold text-slate-700">NIS: {{ session('siswa_nis') }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf 
                    <button type="submit" class="bg-rose-50 text-rose-600 p-2.5 rounded-xl hover:bg-rose-100 transition border border-rose-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-4">
                <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden sticky top-28">
                    <div class="bg-blue-600 px-6 py-5 text-white relative overflow-hidden">
                        <h2 class="text-xl font-black relative z-10">Kirim Laporan</h2>
                        <p class="text-blue-100 text-[10px] font-medium opacity-80 relative z-10">Laporkan masalah sarana sekolah.</p>
                    </div>

                    <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                        @csrf
                        <input type="hidden" name="nis" value="{{ session('siswa_nis') }}">
                        
                        <div>
                            <label class="block text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Kategori</label>
                            <select name="id_kategori" class="w-full bg-slate-50 border-2 border-slate-50 rounded-xl px-4 py-2.5 text-xs text-slate-700 font-bold focus:bg-white focus:border-blue-500 outline-none transition-all cursor-pointer" required>
                                @foreach($kategoris as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Lokasi</label>
                            <div class="relative">
                                <input type="text" name="lokasi" class="w-full bg-slate-50 border-2 border-slate-50 rounded-xl px-4 py-2.5 pl-10 text-xs text-slate-700 font-semibold focus:bg-white focus:border-blue-500 outline-none transition-all" placeholder="Contoh: Lab RPL" required>
                                <svg class="absolute left-3.5 top-2.5 w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Foto Bukti</label>
                            <label class="flex flex-col items-center justify-center w-full h-20 border-2 border-slate-100 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-colors">
                                <div class="flex flex-col items-center justify-center py-2">
                                    <svg class="w-5 h-5 mb-1 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <p class="text-[9px] text-slate-400 font-medium">Klik untuk upload</p>
                                </div>
                                <input type="file" name="foto" class="hidden" />
                            </label>
                        </div>

                        <div>
                            <label class="block text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Keterangan</label>
                            <textarea name="ket" class="w-full bg-slate-50 border-2 border-slate-50 rounded-xl px-4 py-2.5 text-xs text-slate-700 font-medium focus:bg-white focus:border-blue-500 outline-none transition-all" rows="3" placeholder="Detail masalah..." required></textarea>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white font-black py-3.5 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-100 transition transform active:scale-[0.97] text-xs flex items-center justify-center gap-2">
                            Kirim Laporan
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/></svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                    <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                        <div>
                            <h2 class="font-black text-xl text-slate-800">Histori Laporan Anda</h2>
                            <p class="text-slate-400 text-sm font-medium mt-1">Pantau status pengaduan yang telah Anda kirim.</p>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="bg-emerald-100 text-emerald-600 text-[9px] px-3 py-1.5 rounded-full uppercase font-black tracking-widest flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                Live Sync
                            </span>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-white">
                                    <th class="px-10 py-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Detail Laporan</th>
                                    <th class="px-6 py-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Status</th>
                                    <th class="px-10 py-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Feedback Sekolah</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($aspirasis as $item)
                                <tr class="hover:bg-slate-50/80 transition-all cursor-pointer group" onclick="window.location='{{ route('aspirasi.show', $item->id_pelaporan) }}'">
                                    <td class="px-10 py-8">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-black text-blue-600 mb-1">#{{ $item->kategori->ket_kategori }}</span>
                                            <p class="text-sm font-bold text-slate-800 line-clamp-1 group-hover:text-blue-700 transition-colors">{{ $item->ket }}</p>
                                            <span class="text-[10px] text-slate-400 font-medium mt-2 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                {{ $item->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-8 text-center">
                                        @php
                                            $color = [
                                                'Selesai' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                'Proses' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                'Menunggu' => 'bg-rose-50 text-rose-600 border-rose-100'
                                            ][$item->status] ?? 'bg-slate-100 text-slate-600 border-slate-200';
                                        @endphp
                                        <span class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-wider border {{ $color }} shadow-sm">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="px-10 py-8">
                                        @if($item->feedback)
                                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 relative group-hover:bg-white transition-colors">
                                                <p class="text-xs text-slate-500 italic line-clamp-2 leading-relaxed">"{{ $item->feedback }}"</p>
                                            </div>
                                        @else
                                            <div class="flex items-center gap-2 px-2">
                                                <div class="w-1.5 h-1.5 bg-slate-200 rounded-full animate-pulse"></div>
                                                <p class="text-xs text-slate-300 font-medium italic">Menunggu tanggapan...</p>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                                @if($aspirasis->isEmpty())
                                <tr>
                                    <td colspan="3" class="px-10 py-24 text-center">
                                        <div class="flex flex-col items-center opacity-30">
                                            <svg class="w-20 h-20 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            <p class="font-bold text-slate-500">Belum ada aspirasi yang dikirim.</p>
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