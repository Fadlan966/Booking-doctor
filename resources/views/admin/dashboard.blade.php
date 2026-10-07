<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BookingDoctor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Menu -->
        <div class="w-64 bg-slate-800 shadow-md">
            <div class="p-4 text-white text-2xl font-bold border-b border-slate-700">BookingDoctor</div>
            <ul class="text-slate-300 mt-4">
                <li class="p-4 hover:bg-slate-700 cursor-pointer">Dashboard</li>
                <li class="p-4 hover:bg-slate-700 cursor-pointer">Master Komponen (Dokter)</li>
                <li class="p-4 hover:bg-slate-700 cursor-pointer">Menu Appointment</li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <h1 class="text-3xl text-gray-800 font-bold mb-6">Dashboard Admin</h1>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Card: Tambah Master Dokter -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4 border-b pb-2">Tambah Master Dokter</h2>
                    <form action="{{ route('admin.doctors.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-bold mb-2">Nama Dokter</label>
                            <input type="text" name="name" class="w-full border rounded p-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-bold mb-2">Spesialisasi</label>
                            <input type="text" name="specialization" class="w-full border rounded p-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-bold mb-2">Biaya Konsultasi (Rp)</label>
                            <input type="number" name="consultation_fee" class="w-full border rounded p-2" required>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Data</button>
                    </form>
                </div>

                <!-- Card: Daftar Dokter -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4 border-b pb-2">Daftar Dokter Tersedia</h2>
                    <ul class="space-y-3">
                        @foreach($doctors as $doc)
                        <li class="flex justify-between p-3 bg-gray-50 border rounded">
                            <div>
                                <p class="font-bold">{{ $doc->name }}</p>
                                <p class="text-sm text-gray-600">{{ $doc->specialization }}</p>
                            </div>
                            <span class="text-blue-600 font-bold">Rp {{ number_format($doc->consultation_fee, 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Tabel Data Appointment -->
            <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Menu Appointment (Janji Temu Pasien)</h2>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 border-b">
                            <th class="p-3">Tanggal & Waktu</th>
                            <th class="p-3">Pasien</th>
                            <th class="p-3">Dokter</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 text-center">Aksi (Update)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appt)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $appt->appointment_date }}</td>
                            <td class="p-3">{{ $appt->user->name ?? 'Pasien Umum' }}</td>
                            <td class="p-3">{{ $appt->doctor->name }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-white text-xs {{ $appt->status == 'pending' ? 'bg-yellow-500' : 'bg-green-500' }}">
                                    {{ strtoupper($appt->status) }}
                                </span>
                            </td>
                            <td class="p-3 text-center">
                                <!-- Tombol Ubah Status -->
                                <form action="{{ route('admin.appointments.updateStatus', $appt->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="border p-1 rounded text-sm">
                                        <option value="pending" {{ $appt->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $appt->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="completed" {{ $appt->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>
