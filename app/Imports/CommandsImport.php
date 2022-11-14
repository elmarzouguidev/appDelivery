<?php

namespace App\Imports;

use App\Models\Sameleon\City;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CommandsImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation
{


    /*public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();
        dd($rowIndex, "###", $row);
    }*/

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        
        //dd(count($row["produit_ref"]));
        $productName = $row["produit_ref"] ?? $row["produit"] ?? throw ValidationException::withMessages([

            'produit_field' => "veuillez vérifier la structure de  votre fichier excel le column (produit ref) ou (produit) n'existe pas dans le fichier excel "

        ]);

        $slug = Str::slug(str_replace(' ', '', $productName)) . '-' . auth()->user()->uuid;

        $product = Product::whereUserId(auth()->id())
            ->whereUserUuid(auth()->user()->uuid)
            ->whereSlug($slug)->first();

        $ville = City::whereName($row["ville"])->first();

        //dd($product->total_commands_qte);

        if (!$product) {

            throw ValidationException::withMessages([
                'produit_not_found' => "Le produit ( {$productName} ) n'existe pas dans le systeme !",
                'produit_add' => "Aucun command a été importé a cause de ce problem veuillez ajouter ce produit ( {$productName} ) avant de continuer ! "
            ]);
            exit();
        }

        $data = [
            'client_name'     => $row["destinataire"],
            'client_phone'    => $row["telephone"],
            'client_city'    => $row["ville"],
            'client_address'    => $row["adresse"],
            'city_id' => $ville ? $ville->id : null,
            'user_id' => auth()->id(),
            'user_uuid' => auth()->user()->uuid,
            'is_imported' => true
        ];
        //dd($data);
        $command =  Command::create($data);

        /* if ($product && round($product->price) !== $prixExcel = round($row["prix"] / $row["qte"])) {

            throw ValidationException::withMessages([
                'produit_price' => "Le prix unitaire de ( {$product->name} ) dans le fichier EXCEL ( $prixExcel DH ) n'est pas égal au prix entrée dans le système ( $product->price DH )",
                'produit_error' => "Aucun command a été importé a cause de ce problem veuillez vérifier votre fichier excel !! "

            ]);
        }*/

        //dd($product && $product->total_commands_qte > 0  && $product->qte_rest <  $product->total_commands_qte);
        if ($product && $product->isOutOfStock($row["qte"])) {

            throw ValidationException::withMessages([
                'produit_rupture' => "Le produit ( {$product->name} ) est en rupture de stock",
                'produit_error' => "Aucun command a été importé a cause de ce problem veuillez augmenter votre Stock !! "
            ]);
        } else {

            $command->items()->create([

                'command_uuid' => $command->uuid,
                'product_id' => $product ?  $product->id : null,
                'product_uuid' => $product ? $product->uuid : null,
                'designation' => $productName,
                'product' => $productName,
                'quantity' => $row["qte"],
                'prix_uni' => round($row["prix"] / $row["qte"]),
                'prix_total' => $row["prix"],
            ]);
        }
    }

    /*public function headingRow(): int
    {
        return 1;
    }*/

    public function rules(): array
    {
        return [
            'destinataire' => ['required', 'string'],
            'telephone' => ['required', 'phone:MA'],
            'ville' => ['required', 'string'],
            'region' => ['nullable', 'string'],
            'adresse' => ['required', 'string'],
            'produit_ref' => ['nullable', 'string'],
            'produit' => ['required_if:produit_ref,=,null', 'string'],
            'qte' => ['required', 'numeric'],
            'prix' => ['required', 'numeric'],
        ];
    }
}
