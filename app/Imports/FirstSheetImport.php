<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Sameleon\Command;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FirstSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            
            $data = [
                'client_name'     => $row["destinataire"],
                'client_phone'    => $row["telephone"],
                'client_city'    => $row["ville"],
                'client_address'    => $row["adresse"],
                'product_ref'    => $row["produit_ref"],
                'qte'    => $row["qte"],
                'price_total'    => $row["prix"],
                'source'    => $row["source"],
                'boutique'    => $row["boutique"],
                'user_id' => auth()->id(),
                'user_uuid' => auth()->user()->uuid,
                'is_imported' => true
            ];
            dd(array_filter($data));
            Command::create(array_filter($data));
        }
    }
}
