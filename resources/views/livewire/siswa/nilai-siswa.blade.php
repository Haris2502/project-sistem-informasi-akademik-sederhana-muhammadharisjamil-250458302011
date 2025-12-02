<div class="container-fluid">
    <h4 class="mb-4">📘 Nilai Akademik</h4>
    <div class="alert alert-info">
        Rata-Rata Nilai: <strong>{{ $rataRata }}</strong>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilaiList as $n)
                <tr>
                    <td>{{ $n->mapel->nama_mapel ?? '-' }}</td>
                    <td>{{ $n->nilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <a href="{{ route('siswa.cetak-rapor') }}" class="btn btn-primary mt-3">🧾 Cetak Rapor (PDF)</a> --}}
</div>
