<?php

namespace App\Imports\Product;

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

use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductsImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation, WithChunkReading
{
    use RemembersRowNumber;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $productName = $row["name"] ?? $row["nom"] ?? throw ValidationException::withMessages([

            'produit_field' => "
                veuillez vérifier la structure de  votre fichier excel le column (name) ou (nom)
                n'existe pas dans le fichier excel
                
              ",

        ]);

        $productSlug = Str::slug(str_replace(' ', '', $productName)) . '-' . auth()->user()->uuid . ':' . auth()->id();

        $product = Product::whereUserId(auth()->id())
            ->whereUserUuid(auth()->user()->uuid)
            ->whereSlug($productSlug)->first();

        if ($product) {

            throw ValidationException::withMessages([
                'produit_found' => "Le produit ( {$productName} ) deja existe dans le systeme !",
                'produit_add' => "Aucun produits a été importé a cause de ce problem , supprimer de produit  ( {$productName} ) depuis votre fichier  avant de continuer ! "
            ]);
            exit();
        }

        $data = [
            'name'     => $row["name"] ?? $row['nom'],
            'slug'     => $productSlug,
            'description' => $row["description"] ?? $row['detail'],
            'price' => $row["price_unitaire"] ?? $row['prix_unitaire'],
            'qte_global' => $row["qte"] ?? $row['quantite'],
            'qte_rest' => $row["qte"] ?? $row['quantite'],
            'user_id' => client()->id ?? null,
            'user_uuid' => client()->uuid ?? null,
            'is_imported' => true

        ];
        $product =  Product::create($data);

        if ($product) {
   
        }
    }

    /*public function headingRow(): int
    {
        return 1;
    }*/

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'quantite' => ['required', 'numeric'],
            'prix_unitaire' => ['required', 'numeric'],
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
