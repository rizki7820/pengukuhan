<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Absensi</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-4xl font-bold text-gray-800">
                📊 Dashboard Absensi
            </h1>

            <p class="text-gray-500">
                Monitoring Absensi Siswa & Orang Tua
            </p>
        </div>

        <div class="bg-white px-4 py-2 rounded-xl shadow">
            <p class="text-sm text-gray-500">
                Auto Refresh 15 Detik
            </p>
        </div>

    </div>

    @php

    $totalSiswa = count($data ?? []);

$totalOrtu = count($data ?? []);

$hadirSiswa = collect($data)
    ->where('status_siswa','✔')
    ->count();

$belumSiswa = $totalSiswa - $hadirSiswa;

$hadirOrtu = collect($data)
    ->where('status_ortu','✔')
    ->count();

$belumOrtu = $totalSiswa + $totalOrtu - $hadirOrtu - $hadirSiswa;

$total = $totalSiswa + $totalOrtu;

$kelasList = collect($data)
    ->pluck('kelas')
    ->unique();

    @endphp

    <!-- CARD -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

        <div class="bg-white p-5 rounded-2xl shadow">

            <p class="text-gray-500 text-sm">
                Total Data
            </p>

            <h2 class="text-3xl font-bold text-gray-800 mt-2">
                {{ $total }}
            </h2>

        </div>

        <div class="bg-green-100 p-5 rounded-2xl shadow">

            <p class="text-sm text-green-700">
                Siswa Hadir
            </p>

            <h2 class="text-3xl font-bold text-green-700 mt-2">
                {{ $hadirSiswa }}
            </h2>

        </div>

        <div class="bg-blue-100 p-5 rounded-2xl shadow">

            <p class="text-sm text-blue-700">
                Ortu Hadir
            </p>

            <h2 class="text-3xl font-bold text-blue-700 mt-2">
                {{ $hadirOrtu }}
            </h2>

        </div>

        <div class="bg-red-100 p-5 rounded-2xl shadow">

            <p class="text-sm text-red-700">
                Belum Hadir
            </p>

            <h2 class="text-3xl font-bold text-red-700 mt-2">
                {{ $belumOrtu }}
            </h2>

        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white p-5 rounded-2xl shadow mb-6 flex flex-col md:flex-row gap-4 md:items-center">

        <div>
            <h2 class="text-lg font-semibold text-gray-700">
                Filter Data
            </h2>
        </div>

        <select
            id="filterKelas"
            class="border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        >

            <option value="all">
                Semua Kelas
            </option>

            @foreach($kelasList as $kelas)

                <option value="{{ $kelas }}">
                    {{ $kelas }}
                </option>

            @endforeach

        </select>

    </div>



    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="p-5 border-b">

            <h2 class="text-lg font-semibold text-gray-700">
                Data Absensi
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-gray-700">

                    <tr>

                        <th class="p-4 text-left">
                            Nama Siswa
                        </th>

                        <th class="p-4 text-left">
                            Kelas
                        </th>

                        <th class="p-4 text-left">
                            Status Siswa
                        </th>

                        <th class="p-4 text-left">
                            Jam
                        </th>

                        <th class="p-4 text-left">
                            Nama Ortu
                        </th>

                        <th class="p-4 text-left">
                            Status Ortu
                        </th>

                        <th class="p-4 text-left">
                            Jam
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($data as $row)

                    <tr
                        class="border-b hover:bg-gray-50 transition data-row"
                        data-kelas="{{ $row['kelas'] ?? '' }}"
                    >

                        <!-- NAMA -->
                        <td class="p-4 font-medium text-gray-800">
                            {{ $row['nama'] ?? '-' }}
                        </td>

                        <!-- KELAS -->
                        <td class="p-4">
                            {{ $row['kelas'] ?? '-' }}
                        </td>

                        <!-- STATUS SISWA -->
                        <td class="p-4">

                            @if(($row['status_siswa'] ?? '') == '✔')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    ✔ Hadir
                                </span>

                            @else

                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">
                                    Belum
                                </span>

                            @endif

                        </td>

                        <!-- JAM SISWA -->
<td class="p-4 text-gray-600">

    @if(
        !empty($row['jam_siswa']) &&
        strtotime($row['jam_siswa'])
    )

        {{ $row['jam_siswa'] }}

    @else

        -

    @endif

</td>

<!-- NAMA ORTU -->
<td class="p-4 text-gray-700">

    {{ $row['nama_ortu'] ?? '-' }}

</td>

<!-- STATUS ORTU -->
<td class="p-4">

    @if(($row['status_ortu'] ?? '') == '✔')

        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
            ✔ Hadir
        </span>

    @else

        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">
            Belum
        </span>

    @endif

</td>

<!-- JAM ORTU -->
<td class="p-4 text-gray-600">

    @if(
        !empty($row['jam_ortu']) &&
        strtotime($row['jam_ortu'])
    )

        {{ $row['jam_ortu'] }}

    @else

        -

    @endif

</td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


    </div>
 <!-- CHART -->
        <div class="bg-white p-6 mt-6 rounded-2xl shadow mb-6">

            <h2 class="text-lg font-semibold mb-4">
                Statistik Kehadiran
            </h2>

            <div class="flex justify-center">

                <div class="w-64">
                    <canvas id="chart"></canvas>
                </div>

            </div>

        </div>
</div>

<!-- CHART -->
<script>

const ctx = document.getElementById('chart');

const chart = new Chart(ctx, {

    type: 'doughnut',

    data: {

        labels: [
            'Siswa Hadir',
            'Ortu Hadir',
            'Belum Hadir'
        ],

        datasets: [{

            data: [
                {{ $hadirSiswa }},
                {{ $hadirOrtu }},
                {{ $belumSiswa + $belumOrtu }}
            ]

        }]
    }

});


// FILTER KELAS

const filterKelas = document.getElementById('filterKelas');


// CARD ELEMENT

const totalDataEl = document.querySelectorAll('.text-3xl')[0];

const siswaHadirEl = document.querySelectorAll('.text-3xl')[1];

const ortuHadirEl = document.querySelectorAll('.text-3xl')[2];

const belumHadirEl = document.querySelectorAll('.text-3xl')[3];



filterKelas.addEventListener('change', function () {

    const selected = this.value;

    const rows = document.querySelectorAll('.data-row');

    let total = 0;

    let siswaHadir = 0;

    let ortuHadir = 0;

    let belum = 0;

    rows.forEach(row => {

        const kelas = row.dataset.kelas;

        const statusSiswa = row.querySelectorAll('td')[2]
            .innerText
            .includes('Hadir');

        const statusOrtu = row.querySelectorAll('td')[5]
            .innerText
            .includes('Hadir');

        const show =
            selected === 'all' ||
            kelas === selected;

        if (show) {

            row.style.display = '';

            total+= 2;

            if (statusSiswa) {

                siswaHadir++;

            } else {

                belum++;

            }

            if (statusOrtu) {

                ortuHadir++;

            } else {

                belum++;

            }

        } else {

            row.style.display = 'none';

        }

    });

    // UPDATE CARD

    totalDataEl.innerText = total;

    siswaHadirEl.innerText = siswaHadir;

    ortuHadirEl.innerText = ortuHadir;

    belumHadirEl.innerText = belum;


    // UPDATE CHART

    chart.data.datasets[0].data = [
        siswaHadir,
        ortuHadir,
        belum
    ];

    chart.update();

});

</script>

<!-- AUTO REFRESH -->
<meta http-equiv="refresh" content="15">

</body>
</html>
