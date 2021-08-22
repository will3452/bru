<?php

namespace App\Traits;

trait Reportable
{
    public function getAgeReportAttribute()
    {
        $boxes = $this->boxes;
        $ages = collect();
        $keys = collect();

        foreach ($boxes as $box) {
            if (!$box->owner) {
                continue;
            }
            $age = $box->owner->bio->age;
            if ($keys->has($age)) {
                $ages[$age] = $ages++;
            } else {
                $ages[$age] = 1;
            }
        }

        return $ages;

    }
}
