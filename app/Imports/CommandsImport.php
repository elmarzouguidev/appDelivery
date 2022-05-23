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
use Illuminate\Support\Str;

class CommandsImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $slug = Str::slug($row["produit_ref"]) . '-' . auth()->user()->uuid;

        $product = Product::whereUserId(auth()->id())->whereSlug($slug)->first();

        $ville = City::whereName($row["ville"])->first();

        if (!$product) {

            throw ValidationException::withMessages([
                'produit_not_found' => "Le produit ( {$row["produit_ref"]} ) n'existe pas dans le systeme !",
                'produit_add' => "Aucun command a été importé a cause de ce problem veuillez ajouter ce produit ( {$row["produit_ref"]} ) avant de continuer ! "
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

        if ($product && round($product->price) !== $prixExcel = round($row["prix"] / $row["qte"])) {

            throw ValidationException::withMessages([
                'produit_price' => "Le prix unitaire de ( {$product->name} ) dans le fichier EXCEL ( $prixExcel DH ) n'est pas égal au prix entrée dans le système ( $product->price DH )",
                'produit_error' => "Aucun command a été importé a cause de ce problem veuillez vérifier votre fichier excel !! "

            ]);
        }

        if ($product && $product->qte_rest < $row["qte"]) {

            throw ValidationException::withMessages([
                'produit_price' => "Le produit ( {$product->name} ) est en rupture de stock",
                'produit_error' => "Aucun command a été importé a cause de ce problem veuillez augmenter votre Stock !! "
            ]);
        } else {

            $command->items()->create([

                'command_uuid' => $command->uuid,
                'product_id' => $product ?  $product->id : null,
                'product_uuid' => $product ? $product->uuid : null,
                'designation' => $row["produit_ref"],
                'product' => $row["produit_ref"],
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
            'adresse' => ['required', 'string'],
            'produit_ref' => ['required', 'string'],
            'qte' => ['required', 'numeric'],
            'prix' => ['required', 'numeric'],
        ];
    }
}
