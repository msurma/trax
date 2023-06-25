<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Trip;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TripRepository
{
    public function getTripCollectionForUser(int $userId): Collection
    {
        $query = DB::raw("
    SELECT
        trips.id,
        trips.date,
        trips.miles,
        trips.car_id,
        SUM(trips.miles) OVER (
            PARTITION BY trips.car_id
            ORDER BY trips.date
            ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW
        ) as total
    FROM
        trips
    WHERE
        trips.user_id = :user_id
    ORDER BY
        trips.date ASC
");

        $trips = Trip::fromQuery($query, ['user_id' => $userId]);
        $trips->load('car');

        return $trips;
    }
}
