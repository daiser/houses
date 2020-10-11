<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class House
 * @package App\Models
 *
 * @property int    $id
 * @property string $name
 * @property int    $price
 * @property int    $bedrooms
 * @property int    $bathrooms
 * @property int    $storeys
 * @property int    $garages
 */
class House extends Model
{
    use HasFactory;

    public const TABLE = TBL_HOUSES;
    protected $table = self::TABLE;
    public $incrementing = true;
    public $timestamps = true;
    protected $casts = [
        'price'     => 'integer',
        'bedrooms'  => 'integer',
        'bathrooms' => 'integer',
        'storeys'   => 'integer',
        'garages'   => 'integer',
    ];
}
