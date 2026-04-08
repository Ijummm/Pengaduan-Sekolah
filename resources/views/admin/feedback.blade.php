<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanggapi Aspirasi | Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-slate-50 py-8 px-4">

<div class="container mx-auto max-w-3xl bg-white rounded-[2rem] shadow-xl shadow-slate-200 overflow-hidden border border-slate-100">

    <div class="bg-indigo-600 p-6 text-white relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-2xl font-extrabold tracking-tight">Beri Tanggapan Resmi</h2>
            <p class="text-indigo-100 text-xs mt-1 font-medium opacity-90">
                Berikan solusi atau informasi terkait keluhan siswa secara transparan.
            </p>
        </div>
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    <div class="p-6 md:p-8">

        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <span class="h-6 w-1 bg-indigo-600 rounded-full"></span>
                <h3 class="text-base font-bold text-slate-800 uppercase tracking-wider">
                    Detail Aspirasi Siswa
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100">

                <div>
                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest mb-1">Pengirim (NIS)</p>
                    <p class="text-slate-900 font-bold">{{ $aspirasi->nis }}</p>
                </div>

                <div>
                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest mb-1">Lokasi</p>
                    <p class="text-slate-900 font-bold flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        {{ $aspirasi->lokasi }}
                    </p>
                </div>

                <div>
                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest mb-1">Kategori</p>
                    <span class="inline-block bg-white text-indigo-600 text-xs px-3 py-1 rounded-lg font-bold border border-indigo-100 shadow-sm">
                        {{ $aspirasi->kategori->ket_kategori }}
                    </span>
                </div>

                <div class="md:col-span-1">
                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest mb-2">Foto Bukti</p>

                    @if($aspirasi->foto)
                        <div class="overflow-hidden rounded-xl border border-white shadow-md">
                            <img src="{{ asset('uploads/foto_aspirasi/' . $aspirasi->foto) }}"
                                 class="w-full h-28 object-cover">
                        </div>
                    @else
                        <div class="h-28 flex items-center justify-center bg-slate-100 rounded-xl border-2 border-dashed border-slate-200 text-slate-400 text-xs italic">
                            Tanpa Foto
                        </div>
                    @endif
                </div>

                <div class="md:col-span-2">
                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest mb-2">
                        Isi Laporan / Keluhan
                    </p>

                    <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm italic text-slate-600 text-sm leading-relaxed relative">
                        <span class="absolute top-1 right-3 text-slate-100 font-serif text-4xl">"</span>
                        {{ $aspirasi->ket }}
                    </div>
                </div>

            </div>
        </div>

        <form action="{{ route('admin.feedback.update', $aspirasi->id_pelaporan) }}" method="POST" class="space-y-6">
            @csrf

            <div class="flex items-center gap-3 mb-2">
                <span class="h-6 w-1 bg-emerald-500 rounded-full"></span>
                <h3 class="text-base font-bold text-slate-800 uppercase tracking-wider">
                    Form Tanggapan Admin
                </h3>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1">
                    Status Laporan Saat Ini
                </label>

                <div class="relative">
                    <select name="status"
                            class="appearance-none w-full bg-slate-50 border-2 border-slate-100 rounded-xl p-3 text-sm text-slate-700 font-semibold focus:bg-white focus:border-indigo-500 outline-none transition-all cursor-pointer">

                        <option value="Menunggu" {{ $aspirasi->status == 'Menunggu' ? 'selected' : '' }}>
                            🔴 Menunggu Konfirmasi
                        </option>

                        <option value="Proses" {{ $aspirasi->status == 'Proses' ? 'selected' : '' }}>
                            🟡 Sedang Diproses
                        </option>

                        <option value="Selesai" {{ $aspirasi->status == 'Selesai' ? 'selected' : '' }}>
                            🟢 Sudah Selesai
                        </option>

                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                            <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 
                            4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1">
                    Umpan Balik Resmi
                </label>

                <textarea name="feedback" rows="4"
                          class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl p-4 text-sm text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-indigo-500 outline-none transition-all shadow-inner"
                          placeholder="Tuliskan tindakan yang telah atau akan dilakukan oleh sekolah..."
                          required>{{ $aspirasi->feedback }}
                </textarea>
            </div>

            <!-- BUTTON -->
            <div class="flex flex-col md:flex-row gap-3 pt-2">

                <button type="submit"
                        class="flex-[2] bg-indigo-600 text-white font-bold py-3 rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition transform active:scale-[0.98] flex items-center justify-center gap-2">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5l7 7-7 7"/>
                    </svg>

                    Simpan Perubahan & Kirim Tanggapan
                </button>

                <a href="{{ route('admin.dashboard') }}"
                   class="flex-1 bg-slate-100 text-center text-slate-500 font-bold py-3 rounded-xl hover:bg-slate-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>


</body>
</html>