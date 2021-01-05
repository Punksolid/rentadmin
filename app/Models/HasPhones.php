<?php


namespace App\Models;


use App\Models\CatTelefono as PhoneNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasPhones
{
    public function addPhoneData(string $phone_number, string $description = '', bool $status = true): Model
    {
        return $this->phoneNumbers()->create([
            'telefono' => $phone_number,
            'descripcion' => $description,
            'estatus' => $status
        ]);
    }

    public function getPhoneData()
    {
        return $this->phoneNumbers()->active()->first();
    }

    public function phoneNumbers(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(PhoneNumber::class, 'phoneable');
    }

    public function defaultPhoneNumber(): MorphOne
    {
        return $this->morphOne(PhoneNumber::class,'phoneable')
            ->where('estatus',1);
    }


}
