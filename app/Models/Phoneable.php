<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Phoneable
{

    public function addPhoneData(string $phone_number, string $description, bool $status): Model;

    public function getPhoneData();

    public function phoneNumbers(): \Illuminate\Database\Eloquent\Relations\MorphMany;

    public function defaultPhoneNumber();

}
