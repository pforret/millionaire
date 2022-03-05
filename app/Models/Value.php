<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Value
 *
 * @property int $id
 * @property string $type
 * @property string $name
 * @property int $price
 * @property string $url_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Value newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Value newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Value query()
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereUrlImage($value)
 * @mixin \Eloquent
 */
class Value extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

}
