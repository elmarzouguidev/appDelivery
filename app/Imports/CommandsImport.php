<?php

namespace App\Imports;

use App\Models\Sameleon\Command;
use App\Models\Sameleon\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class CommandsImport implements ToModel, SkipsEmptyRows, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $data = [
            'client_name'     => $row["destinataire"],
            'client_phone'    => $row["telephone"],
            'client_city'    => $row["ville"],
            'client_address'    => $row["adresse"],

            /*'product_ref'    => $row["produit_ref"],
            'qte'    => $row["qte"],
            'price_total'    => $row["prix"],
            'source'    => $row["source"],
            'boutique'    => $row["boutique"],*/
            'user_id' => auth()->id(),
            'user_uuid' => auth()->user()->uuid,
            'is_imported' => true
        ];
        //dd($data);
        $command =  Command::create($data);

        $product = Product::whereName($row["produit_ref"])->first();

        if ($product) {

            $command->items()->create([
                'command_uuid' => $command->uuid,
                'product_id' => $product->id,
                'product_uuid' => $product->uuid,
                'designation' => $row["produit_ref"],
                'product' => $row["produit_ref"],
                'quantity' => $row["qte"],
                'prix_uni' => $row["prix"] / 2,
                'prix_total' => $row["prix"],
            ]);
        } else {

            $command->items()->create([
                'command_uuid' => $command->uuid,
                'designation' => $row["produit_ref"],
                'product' => $row["produit_ref"],
                'quantity' => $row["qte"],
                'prix_uni' => $row["prix"] / 2,
                'prix_total' => $row["prix"],
            ]);
        }
    }

    /*public function headingRow(): int
    {
        return 1;
    }*/
}
