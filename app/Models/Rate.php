<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * App\Models\Rate
 *
 * @property int $id
 * @property int $currency_id
 * @property string $date
 * @property float $rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Rate extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    static function last_rates(): array
    {
        $cache_id="CurrenciesLastRates";
        if(Cache::get($cache_id)){
            return Cache::get($cache_id);
        }
        $currencies = Currency::all();
        $result=[];
        foreach($currencies as $currency){
            $result[$currency->code] = Currency::query()
                ->join("rates", "rates.currency_id", "=", "currencies.id")
                ->where("code", "=", $currency->code)
                ->orderBy("rates.date","desc")
                ->select(["code","name","symbol","country","flag","date","rate"])
                ->first();
        }
        ksort($result);
        Cache::put($cache_id,$result,3600);
        return $result;
    }
}
