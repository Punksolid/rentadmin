<?php

namespace App\Http\Controllers;

use App\Models\CatTelefono;
use Illuminate\Http\Request;

class PhonesController extends Controller
{
    public function destroy(CatTelefono $phone)
    {
        $phone->delete();

        return redirect()->back();
    }
}
