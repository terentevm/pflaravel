<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Rates extends ModelByUser
{
    protected $table = 'rates';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'currency_id',
        'date',
        'rate',
        'mult'
    ];

    /**
     * @param App\Services\RatesLoaders\RateData[] $rates
     * @param string $date1
     * @param string $date2
     */
    static function storeRates(array $rates, string $date1, string $date2)
    {
        $records = [];

        $date1 = Carbon::parse($date1)->startOfDay()->toDateTimeString();
        $date2 = Carbon::parse($date2)->endOfDay()->toDateTimeString();

        foreach ($rates as $rateData) {

            $ratesInDb = self::getRatesFromDb($rateData->currency, $date1, $date2);

            foreach ($rateData->getRates() as $dateInt => $rate) {

                $d = Carbon::parse($rate['date'])->startOfDay()->toDateString();

                if (!$ratesInDb->contains('date', $d)) {
                    $model = new static([
                        'currency_id' => $rateData->currency->id,
                        'date' => $rate['date'],
                        'rate' => $rate['rate'],
                        'mult' => $rate['mult']
                    ]);

                    array_push($records, $model);
                }
            }
        }

        foreach ($records as $modelRate) {
            $modelRate->save();
        }
    }

    /**
     * @param Currency $currency
     * @param $date1
     * @param $date2
     * @return mixed
     */
    static function getRatesFromDb(Currency $currency, $date1, $date2)
    {
        $result = static::where('currency_id', $currency->id)
            ->whereBetween('date', [$date1, $date2])->get();

        return $result;
    }

    /**
     * @param User $user
     * @param array $currencies contain id's [id1, id2....idn]
     * @param Carbon $date
     * @return array
     */
    public static function getLastRates(User $user, array $currencies = [], Carbon $date)
    {
        $strDate = $date->toDateString();

        $dateCondition = DB::raw("rv.validity @> date '$strDate'");

        $rates = DB::table('rates_validity as rv')
            ->select(DB::raw('currency_id as curr_id, rate, mult'))
            ->where('user_id', '=', $user->id)
            ->whereRaw($dateCondition);

        if (!empty($currencies)) {
            $rates->whereIn('currency_id', $currencies);
        }

        return $rates->get()->toArray();

    }


    private function getSQL_LastRates(\DateTime $date, $currenciesCondStr = "")
    {
        $sql =
            "select
          rv.currency_id as curr_id,
          rv.rate as rate,
          rv.mult as mult
          from rates_validity as rv 
          where user_id = :user_id
	        AND rv.validity @> date '" . $date->format('Y-m-d') . "'";

        if ($currenciesCondStr !== "") {

            $sql .= " AND rv.currency_id IN (" . $currenciesCondStr . ")";

        }

        return $sql;
    }
}
