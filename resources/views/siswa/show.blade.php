<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aspirasi #{{ $aspirasi->id_pelaporan }} | Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .feedback-content {
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: pre-line;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-16 flex justify-center items-center">
        <div class="w-full max-w-3xl bg-white rounded-3xl shadow-2xl shadow-gray-100 overflow-hidden border border-gray-100 transform transition-all">
            
            @php
                $statusColors = [
                    'Selesai' => 'bg-green-600',
                    'Proses' => 'bg-amber-500',
                    'Menunggu' => 'bg-rose-600'
                ];
                $headerColor = $statusColors[$aspirasi->status] ?? 'bg-gray-600';
            @endphp
            <div class="{{ $headerColor }} p-8 text-white">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                    <div>
                        <p class="text-xs uppercase font-bold tracking-widest text-white/70">Aspirasi Siswa</p>
                        <h2 class="text-3xl font-extrabold tracking-tighter">Detail Laporan #{{ $aspirasi->id_pelaporan }}</h2>
                        <p class="text-sm mt-1 text-white/80">
                            Dikirim: {{ $aspirasi->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    <span class="inline-block bg-white/20 text-white text-xs px-5 py-2 rounded-full font-bold uppercase tracking-wider text-center self-start sm:self-center">
                        {{ $aspirasi->status }}
                    </span>
                </div>
            </div>

            <div class="p-8 md:p-10 space-y-10">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-gray-100">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Kategori</p>
                        <span class="inline-block bg-blue-50 text-blue-700 text-sm px-3 py-1.5 rounded-lg font-semibold border border-blue-100">
                            {{ $aspirasi->kategori->ket_kategori }}
                        </span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Lokasi Kejadian</p>
                        <p class="text-lg text-gray-800 font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $aspirasi->lokasi }}
                        </p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Isi Laporan / Keluhan</label>
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 text-gray-700 leading-relaxed italic relative">
                        <svg class="absolute -top-3 -left-3 w-8 h-8 text-blue-100" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.851h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9.012-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.851h4v10h-10.012z"/></svg>
                        <p class="pl-4">"{{ $aspirasi->ket }}"</p>
                    </div>
                </div>

                <div class="mt-8">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Foto Bukti Keadaan Sarana</label>
                    @if($aspirasi->foto)
                        <div class="relative group">
                            <div class="overflow-hidden rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:shadow-md">
                                <img src="{{ asset('uploads/foto_aspirasi/' . $aspirasi->foto) }}" 
                                    alt="Bukti Aspirasi" 
                                    class="w-full h-auto object-cover max-h-[400px] transition-transform duration-500 group-hover:scale-105">
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3 p-4 bg-orange-50 text-orange-600 rounded-xl italic text-sm border border-orange-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Siswa tidak menyertakan foto bukti.
                        </div>
                    @endif
                </div>

                <div class="pt-8 border-t border-gray-100">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Tanggapan Resmi Admin</label>
                    @if($aspirasi->feedback)
                        <div class="p-6 bg-blue-50/50 rounded-2xl border border-blue-100 text-blue-800">
                            <p class="feedback-content font-medium leading-relaxed">
                                {{ $aspirasi->feedback }}
                            </p>
                        </div>
                    @else
                        <div class="flex items-center gap-3 p-4 bg-gray-100 text-gray-500 rounded-xl italic text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Belum ada tanggapan resmi dari pihak sekolah.
                        </div>
                    @endif
                </div>
            </div>

            <div class="p-8 md:px-10 bg-gray-50 border-t border-gray-100">
                <a href="{{ route('siswa.dashboard') }}" class="block text-center w-full bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-100 transform active:scale-95">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</body>
</html>