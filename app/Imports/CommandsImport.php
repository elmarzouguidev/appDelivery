<?php

namespace App\Imports;

use App\Models\Sameleon\City;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\Region;
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

class CommandsImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation, WithChunkReading
{

    use RemembersRowNumber;


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


        //$currentRowNumber = $this->getRowNumber();

        $productName = $row["produit_ref"] ?? $row["produit"] ?? throw ValidationException::withMessages([

            'produit_field' => "
                veuillez vérifier la structure de  votre fichier excel le column (produit ref) ou (produit)
                n'existe pas dans le fichier excel
                
              ",

        ]);

        $cityName = $row["ville"] ?? throw ValidationException::withMessages([

            'ville_field' => "
                veuillez vérifier la structure de  votre fichier excel le column (ville)
                n'existe pas dans le fichier excel
                
              ",

        ]);

        $productSlug = Str::slug(str_replace(' ', '', $productName)) . '-' . auth()->user()->uuid . ':' . auth()->id();

        $citySlug = Str::slug(str_replace(' ', '', $cityName));

        $regionSlug = Str::slug(str_replace(' ', '', $row['region']));

        $product = Product::whereUserId(auth()->id())
            ->whereUserUuid(auth()->user()->uuid)
            ->whereSlug($productSlug)->first();

        $ville = City::whereSlug($citySlug)->first();

        $region = Region::whereSlug($regionSlug)->first();

        if (!$ville) {

            throw ValidationException::withMessages([
                'city_not_found' => "La ville ( {$cityName} ) n'existe pas dans le systeme !",
                'produit_add' => "Aucun command a été importé a cause de ce problem veuillez vérifier le nom de la ville ( {$cityName} ) avant de continuer ! "
            ]);
            exit();
        }

        if ($row['region'] && !$region) {

            throw ValidationException::withMessages([
                'region_not_found' => "La région ( {$row['region']} ) n'existe pas dans le systeme !",
                'produit_add' => "Aucun command a été importé a cause de ce problem veuillez vérifier le nom de la région ( {$row['region']} ) avant de continuer ! "
            ]);
            exit();
        }

        if ($row['region'] && $region && !$region->city()->is($ville)) {

            $regionName = $row['region'];

            throw ValidationException::withMessages([
                'region_not_found' => "désole cette région ( $regionName ) ne correspond pas a la ville ($ville->name) !!",
                'produit_add' => "Aucun command a été importé a cause de ce problem veuillez vérifier le nom de la région ( {$row['region']} ) avant de continuer ! "
            ]);
            exit();
        }

        if (!$product) {

            throw ValidationException::withMessages([
                'produit_not_found' => "Le produit ( {$productName} ) n'existe pas dans le systeme !",
                'produit_add' => "Aucun command a été importé a cause de ce problem veuillez ajouter ce produit ( {$productName} ) avant de continuer ! "
            ]);
            exit();
        }

        $totalFrais = $ville->frais;

        if ($region) {

            $totalFrais += $region->frais;
        }

        $data = [
            'client_name'     => $row["destinataire"],
            'client_phone'    => $row["telephone"],
            'client_city'    => $row["ville"],
            'client_address'    => $row["adresse"],

            'city_id' => $ville ? $ville->id : null,
            'city_uuid' => $ville ? $ville->uuid : null,

            'region_id' => $region ? $region->id : null,
            'region_uuid' => $region ? $region->uuid : null,

            'user_id' => auth()->id(),
            'user_uuid' => auth()->user()->uuid,

            'is_imported' => true,
            'frais' => $totalFrais
        ];

        $command =  Command::create($data);

        /* if ($product && round($product->price) !== $prixExcel = round($row["prix"] / $row["qte"])) {

            throw ValidationException::withMessages([
                'produit_price' => "Le prix unitaire de ( {$product->name} ) dans le fichier EXCEL ( $prixExcel DH ) n'est pas égal au prix entrée dans le système ( $product->price DH )",
                'produit_error' => "Aucun command a été importé a cause de ce problem veuillez vérifier votre fichier excel !! "

            ]);
        }*/

        /*if ($product && $product->isOutOfStock($row["qte"])) {

            throw ValidationException::withMessages([
                'produit_rupture' => "Le produit ( {$product->name} ) est en rupture de stock",
                'produit_error' => "Aucun command a été importé a cause de ce problem veuillez augmenter votre Stock !! "
            ]);
        } */

        if ($command) {

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


    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'destinataire.required' => 'le destinataire et requis',
            'telephone.required' => 'le telephone et requis',
            'ville.required' => 'la ville et requis',
            'adresse.required' => "l'adresse et requis",
            'produit.required' => 'le produit et requis',
            'qte.required' => 'la quantité et requis',
            'prix.required' => 'le prix total et requis',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
