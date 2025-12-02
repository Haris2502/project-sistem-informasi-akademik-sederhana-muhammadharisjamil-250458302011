<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Nilai;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CetakRapor extends Component
{
    public $siswa;
    public $nilaiList = [];

    public function mount()
    {
        // Ambil data siswa yang sedang login
        $this->siswa = Siswa::with('user', 'kelas')
            ->where('user_id', Auth::id())
            ->first();

        $this->loadNilai();
    }

    public function loadNilai()
    {
        if (!$this->siswa) return;

        $this->nilaiList = Nilai::with('mapel')
            ->where('siswa_id', $this->siswa->id)
            ->get();
    }

    public function exportPdf()
    {
        $pdf = Pdf::loadView('pdf.rapor', [
            'siswa' => $this->siswa,
            'nilaiList' => $this->nilaiList,
        ]);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            'rapor-'.$this->siswa->user->name.'.pdf'
        );
    }

    public function render()
    {
        return view('livewire.siswa.cetak-rapor');
    }
}
