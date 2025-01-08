<?php

namespace App\Exports;

use App\Models\StockMovement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class StokMovementExport implements FromCollection, WithHeadings, WithMapping
{
    protected $cabangId;

    /**
     * Constructor to accept cabangId.
     */
    public function __construct($cabangId)
    {
        $this->cabangId = $cabangId;
    }

    /**
     * Menyediakan koleksi data untuk diekspor.
     */
    public function collection()
    {
        // Mengambil data stock movement berdasarkan cabang yang sedang login
        return StockMovement::with(['cabang', 'barang', 'user'])
            ->where('cabang_id', $this->cabangId)
            ->get();
    }

    /**
     * Menyediakan heading untuk file Excel.
     */
    public function headings(): array
    {
        return [
            'No',
            'Cabang',
            'Barang',
            'User',
            'Type',
            'Quantity',
            'Movement Date',
        ];
    }

    /**
     * Memetakan data ke dalam format yang sesuai.
     */
    public function map($stockMovement): array
    {
        return [
            $stockMovement->id,
            $stockMovement->cabang->name,
            $stockMovement->barang->nama_barang,
            $stockMovement->user->name,
            ucfirst($stockMovement->type),
            $stockMovement->quantity,
            Carbon::parse($stockMovement->movement_date)->format('Y-m-d H:i:s'), // Convert to Carbon and format
        ];
    }
}
