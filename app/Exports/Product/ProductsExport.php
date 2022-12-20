<?php

namespace App\Exports\Product;

use App\Exports\ForUser;
use App\Models\Sameleon\Product;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductsExport implements FromQuery, WithHeadings, WithColumnFormatting, ShouldAutoSize, WithEvents
{
    use Exportable;
    use ForUser;

    const FORMAT_CURRENCY_MAD_SIMPLE = '#,##0.00_-"DH"';

    public $user;

    /*public function collection()
    {
        return Product::select(['id', 'name', 'description', 'qte_global', 'price'])->get();
    }*/

    public function query()
    {
        if ($this->user) {
            return Product::query()
                ->select(['id', 'name', 'description', 'qte_global', 'price'])
                ->whereUserId($this->user->id)
                ->whereUserUuid($this->user->uuid);
        }

        return Product::query()
            ->select(['id', 'name', 'description', 'qte_global', 'price']);
    }

    public function headings(): array
    {
        return [
            '#',
            'Nom',
            'Description',
            'Quantité',
            'Prix',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => self::FORMAT_CURRENCY_MAD_SIMPLE,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(16);
            },
        ];
    }
}
