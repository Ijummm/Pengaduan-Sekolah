<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa | Aspirasi Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-600 rounded-3xl shadow-xl shadow-blue-200 mb-5 transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Suara Siswa</h2>
            <p class="text-slate-500 mt-2 font-medium">Sampaikan aspirasimu untuk sekolah yang lebih baik.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-2xl shadow-blue-100/50 border border-slate-100 overflow-hidden">
            <div class="p-8 md:p-10">
                <form action="{{ route('siswa.login.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-[0.15em] mb-3 ml-1">Nomor Induk Siswa (NIS)</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0H5m14 0h-5"/>
                                </svg>
                            </span>
                            <input type="number" name="nis" 
                                class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl py-4 pl-12 pr-4 text-slate-700 font-semibold placeholder:text-slate-300 focus:bg-white focus:border-blue-600 outline-none transition-all" 
                                placeholder="Contoh: 12345" required autofocus>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-xl text-sm italic">
                            NIS yang Anda masukkan tidak terdaftar.
                        </div>
                    @endif

                    <button type="submit" 
                        class="w-full bg-blue-600 text-white font-bold py-4 rounded-2xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all transform active:scale-[0.97] flex items-center justify-center gap-3">
                        <span>Masuk ke Panel Aspirasi</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-slate-50 text-center">
                    <p class="text-slate-500 text-sm">
                        Belum memiliki akun? 
                        <a href="/register-siswa" class="text-blue-600 font-bold hover:underline ml-1">Daftar sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>