<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daftar Nilai</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <h3>Daftar Nilai Siswa</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilaiList as $n)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $n->siswa->user->name ?? '-' }}</td>
                <td>{{ $n->siswa->kelas->nama_kelas ?? '-' }}</td>
                <td>{{ $n->mapel->nama_mapel ?? '-' }}</td>
                <td>{{ $n->nilai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
