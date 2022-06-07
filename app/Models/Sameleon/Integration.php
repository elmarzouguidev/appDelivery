<?php

namespace App\Models\Sameleon;

use App\Traits\GetModelByUuid;
use App\Traits\HasSlug;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
class Integration extends Model
{
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;
    use HasSlug;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'description',
        'logo',
        'active',
        'header'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function sources()
    {
        return $this->hasMany(Source::class);
    }

    public function clients()
    {
        return $this->hasManyThrough(User::class, Source::class, 'client_id');
    }

    protected function shortDescription(): Attribute
    {
        return new Attribute(
            fn () => Str::limit($this->description, 100, ' (...)'),
        );
    }
}
