<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BookingDoctor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif']
                    },
                    colors: {
                        ink: '#16302F',
                        pine: {
                            900: '#0E3536',
                            800: '#134344',
                            700: '#1B5658',
                            600: '#0F766E',
                            500: '#14938A',
                            100: '#D7EFEC',
                            50: '#EEF8F6'
                        },
                        paper: '#F4F7F6',
                        line: '#DEE7E5'
                    }
                }
            }
        }
    </script>
    <style>
        /* Field & tombol dipakai ulang supaya konsisten */
        .field {
            width: 100%;
            border: 1px solid #CBD8D5;
            border-radius: 0.5rem;
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
            color: #16302F;
            background: #fff;
            transition: border-color .15s, box-shadow .15s;
        }

        .field:focus {
            outline: none;
            border-color: #0F766E;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, .18);
        }

        .btn:focus-visible,
        .nav-item:focus-visible {
            outline: 2px solid #14938A;
            outline-offset: 2px;
        }
    </style>
</head>

<body class="bg-paper font-sans text-ink antialiased">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Menu -->
        <aside class="w-16 md:w-64 shrink-0 bg-pine-900 flex flex-col">
            <div class="flex items-center gap-3 px-4 md:px-6 h-16 border-b border-white/10">
                <div class="w-9 h-9 shrink-0 rounded-lg bg-pine-500 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12M6 12h12" />
                    </svg>
                </div>
                <span class="hidden md:block text-white text-lg font-bold tracking-tight">BookingDoctor</span>
            </div>

            <ul class="mt-4 px-2 md:px-3 space-y-1 text-sm font-medium">
                <li class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg bg-white/10 text-white cursor-pointer" title="Dashboard">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10h5v-6h4v6h5V10" />
                    </svg>
                    <span class="hidden md:inline">Dashboard</span>
                </li>
                <li class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-pine-100/80 hover:bg-white/5 hover:text-white cursor-pointer transition" title="Master Komponen (Dokter)">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21v-1a6 6 0 016-6h4a6 6 0 016 6v1" />
                    </svg>
                    <span class="hidden md:inline">Master Komponen (Dokter)</span>
                </li>
                <li class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-pine-100/80 hover:bg-white/5 hover:text-white cursor-pointer transition" title="Menu Appointment">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z" />
                    </svg>
                    <span class="hidden md:inline">Menu Appointment</span>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <div class="max-w-6xl mx-auto px-5 md:px-10 py-8">
                <div class="mb-8">
                    <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Dashboard Admin</h1>
                    <p class="text-sm text-slate-500 mt-1">Kelola data dokter dan pantau janji temu pasien.</p>
                </div>

                @if (session('success'))
                    <div class="flex items-start gap-3 bg-pine-50 border border-pine-500/30 text-pine-800 px-4 py-3 rounded-lg mb-6">
                        <svg class="w-5 h-5 mt-0.5 shrink-0 text-pine-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                    <!-- Card: Tambah Master Dokter -->
                    <section class="lg:col-span-2 bg-white p-6 rounded-xl border border-line">
                        <h2 class="text-lg font-bold">Tambah Master Dokter</h2>
                        <p class="text-sm text-slate-500 mt-1 mb-5">Isi data dokter baru untuk ditampilkan di daftar.</p>
                        <form action="{{ route('admin.doctors.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-semibold mb-1.5">Nama Dokter</label>
                                <input type="text" name="name" class="field" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold mb-1.5">Spesialisasi</label>
                                <input type="text" name="specialization" class="field" required>
                            </div>
                            <div class="mb-5">
                                <label class="block text-sm font-semibold mb-1.5">Biaya Konsultasi (Rp)</label>
                                <input type="number" name="consultation_fee" class="field" required>
                            </div>
                            <button type="submit" class="btn w-full bg-pine-600 text-white text-sm font-semibold px-4 py-2.5 rounded-lg hover:bg-pine-700 transition">Simpan Data</button>
                        </form>
                    </section>

                    <!-- Card: Daftar Dokter -->
                    <section class="lg:col-span-3 bg-white p-6 rounded-xl border border-line">
                        <h2 class="text-lg font-bold">Daftar Dokter Tersedia</h2>
                        <p class="text-sm text-slate-500 mt-1 mb-5">Edit atau hapus data dokter yang sudah terdaftar.</p>
                        <ul class="divide-y divide-line">
                            @forelse ($doctors as $doc)
                                <li class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 py-3.5 first:pt-0 last:pb-0">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="w-10 h-10 shrink-0 rounded-full bg-pine-100 text-pine-700 flex items-center justify-center font-bold text-sm">
                                            {{ strtoupper(mb_substr($doc->name, 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-semibold truncate">{{ $doc->name }}</p>
                                            <p class="text-sm text-slate-500 truncate">{{ $doc->specialization }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2 sm:shrink-0">
                                        <span class="text-pine-700 font-bold text-sm mr-2">Rp {{ number_format($doc->consultation_fee, 0, ',', '.') }}</span>

                                        <!-- Tombol Edit -->
                                        <button type="button"
                                            onclick="openEditModal({{ $doc->id }}, '{{ $doc->name }}', '{{ $doc->specialization }}', {{ $doc->consultation_fee }})"
                                            class="btn text-sm font-semibold px-3 py-1.5 rounded-lg border border-line text-ink hover:border-pine-600 hover:text-pine-700 hover:bg-pine-50 transition">
                                            Edit
                                        </button>

                                        <!-- Form Hapus (Delete) -->
                                        <form action="{{ route('admin.doctors.destroy', $doc->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dokter ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn text-sm font-semibold px-3 py-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li class="py-10 text-center text-sm text-slate-500">
                                    Belum ada dokter. Tambahkan dokter pertama lewat formulir di sebelah kiri.
                                </li>
                            @endforelse
                        </ul>
                    </section>

                    <!-- Tabel Data Appointment -->
                    <section class="lg:col-span-5 bg-white rounded-xl border border-line overflow-hidden">
                        <div class="p-6 pb-4">
                            <h2 class="text-lg font-bold">Menu Appointment (Janji Temu Pasien)</h2>
                            <p class="text-sm text-slate-500 mt-1">Ubah status janji temu langsung dari kolom aksi.</p>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead>
                                    <tr class="bg-pine-50 text-slate-600 border-y border-line">
                                        <th class="px-6 py-3 font-semibold">Tanggal & Waktu</th>
                                        <th class="px-6 py-3 font-semibold">Pasien</th>
                                        <th class="px-6 py-3 font-semibold">Dokter</th>
                                        <th class="px-6 py-3 font-semibold">Status</th>
                                        <th class="px-6 py-3 font-semibold text-center">Aksi (Update)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-line">
                                    @forelse ($appointments as $appt)
                                        <tr class="hover:bg-paper/70 transition">
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $appt->appointment_date }}</td>
                                            <td class="px-6 py-4 font-medium">{{ $appt->user->name ?? 'Pasien Umum' }}</td>
                                            <td class="px-6 py-4">{{ $appt->doctor->name }}</td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $appt->status == 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                                                    <span class="w-1.5 h-1.5 rounded-full {{ $appt->status == 'pending' ? 'bg-amber-500' : 'bg-emerald-500' }}"></span>
                                                    {{ strtoupper($appt->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <!-- Tombol Ubah Status -->
                                                <form action="{{ route('admin.appointments.updateStatus', $appt->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" onchange="this.form.submit()" class="field !w-auto !py-1.5 !px-3 cursor-pointer">
                                                        <option value="pending" {{ $appt->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="confirmed" {{ $appt->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                        <option value="completed" {{ $appt->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                                Belum ada janji temu masuk.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>

                </div>
            </div>
        </main>
    </div>

    <!-- Modal Edit Dokter -->
    <div id="editModal" class="fixed inset-0 bg-ink/60 hidden items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-md">
            <h2 class="text-lg font-bold">Edit Master Dokter</h2>
            <p class="text-sm text-slate-500 mt-1 mb-5">Perbarui data dokter, lalu simpan perubahan.</p>

            <!-- Action URL akan diisi oleh JavaScript -->
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1.5">Nama Dokter</label>
                    <input type="text" id="edit_name" name="name" class="field" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1.5">Spesialisasi</label>
                    <input type="text" id="edit_specialization" name="specialization" class="field" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1.5">Biaya Konsultasi (Rp)</label>
                    <input type="number" id="edit_fee" name="consultation_fee" class="field" required>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeEditModal()"
                        class="btn text-sm font-semibold px-4 py-2.5 rounded-lg border border-line text-ink hover:bg-paper transition">Batal</button>
                    <button type="submit"
                        class="btn bg-pine-600 text-white text-sm font-semibold px-4 py-2.5 rounded-lg hover:bg-pine-700 transition">Update
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, specialization, fee) {
            // 1. Masukkan data ke dalam form input
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_specialization').value = specialization;
            document.getElementById('edit_fee').value = fee;

            // 2. Ubah URL form action sesuai dengan ID dokter yang akan diupdate
            let form = document.getElementById('editForm');
            form.action = '/admin/doctors/' + id;

            // 3. Tampilkan modal dengan menghapus 'hidden' dan menambah 'flex'
            let modal = document.getElementById('editModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditModal() {
            // Sembunyikan modal dan hapus 'flex'
            let modal = document.getElementById('editModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>

</html>
