<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid black; padding: 6px; }
        h2, h3 { text-align: center; margin-bottom: 5px; }
    </style>
</head>
<body>

<h2>RAPOR SISWA</h2>
<h3>Data Nilai</h3>

<p><strong>Nama:</strong> {{ $siswa->user->name }}</p>
<p><strong>Kelas:</strong> {{ $siswa->kelas->nama_kelas }}</p>

<table>
    <thead>
        <tr>
            <th>Mata Pelajaran</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($nilaiList as $n)
        <tr>
            <td>{{ $n->mapel->nama_mapel }}</td>
            <td>{{ $n->nilai }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
