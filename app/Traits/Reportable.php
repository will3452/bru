<?php

namespace App\Traits;

trait Reportable
{
    private function myBox()
    {
        return $this->boxes;
    }

    public function getAgeReportAttribute()
    {
        $ages = collect();
        $keys = collect();

        foreach ($this->myBox() as $box) {
            if (!$box->owner) {
                continue;
            }
            $age = $box->owner->bio->age;
            if ($keys->has($age)) {
                $ages[$age] = $ages++;
            } else {
                $ages[$age] = 1;
                $keys->push($age);
            }
        }
        return $ages;
    }

    public function getSexReportAttribute()
    {
        $sexes = collect();
        $keys = collect();

        foreach ($this->myBox() as $box) {
            if (!$box->owner) {
                continue;
            }
            $sex = $box->owner->bio->sex;
            if ($keys->has($sex)) {
                $sexes[$sex] = $sex++;
            } else {
                $sexes[$sex] = 1;
                $keys->push($sex);
            }
        }
        return $sexes;

    }

    public function getGenderReportAttribute()
    {
        $genders = collect();
        $keys = collect();

        foreach ($this->myBox() as $box) {
            if (!$box->owner) {
                continue;
            }
            $gender = $box->owner->bio->gender;
            if ($keys->has($gender)) {
                $genders[$gender] = $gender++;
            } else {
                $genders[$gender] = 1;
                $keys->push($gender);
            }
        }
        return $genders;

    }

    public function getCountryReportAttribute()
    {
        $coutries = collect();
        $keys = collect();

        foreach ($this->myBox() as $box) {
            if (!$box->owner) {
                continue;
            }
            $c = $box->owner->bio->country;
            if ($keys->has($c)) {
                $coutries[$c] = $c++;
            } else {
                $coutries[$c] = 1;
                $keys->push($c);
            }
        }
        return $coutries;

    }
}
