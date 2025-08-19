<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\HakAksesModel;
use App\Models\HubunganJabatan;
use App\Models\BiodataJabatanModel;
use App\Models\Dinas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class RekapBiodataExport implements FromView, ShouldAutoSize, WithStyles, WithDefaultStyles,WithColumnFormatting
{
    protected $dinas_id;
    protected $allData;

    public function __construct($dinas_id, $allData)
    {
        $this->dinas_id = $dinas_id;
        $this->allData = $allData;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            '1'    => [
                'font' => [
                    'alignment' => Alignment::HORIZONTAL_CENTER,
                    'size' => 14
                ]
            ],
        ];
    }

    public function defaultStyles(Style $defaultStyle)
    {
        return [
            'font' => [
                'name' => 'Calibri',
                'size' => 11,
            ],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function view(): View
    {
        $dinas_id = $this->dinas_id;
        $allData = $this->allData;
        if ($dinas_id != NULL) {
            $biodataJabatan = BiodataJabatanModel::whereHas('hubungan_jabatan_detail', function ($query) use ($dinas_id) {
                $query->where('dinas_id', $dinas_id);
            })->with(['hubungan_jabatan_detail.data_beban_kerja', 'hubungan_jabatan_detail.datajabatan', 'hubungan_jabatan_detail.get_parent.parent.datajabatan', 'hubungan_jabatan_detail.detaildinas'])->orderByRaw('CAST(REPLACE(kode_jabatan, " - ", ".") AS CHAR) ASC')->get();

            $namaopd = Dinas::where('id', $this->dinas_id)->first()->nama_dinas;
            return view('admin.laporan.excel-biodata-jabatan', [
                'biodataJabatan' => $biodataJabatan,
                'namaopd' => $namaopd,
                'allData' => $allData,
                'active' => 'laporan',
            ]);
        } else {
           $Alldinas = Dinas::all();

            $namaopd = "Pemerintahan";
            return view('admin.laporan.excel-all-biodata-jabatan', [
                'Alldinas' => $Alldinas,
                'allData' => $allData,
                'active' => 'laporan',
            ]);
        }
    }
}

