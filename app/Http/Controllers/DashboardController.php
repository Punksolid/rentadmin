<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Lessee;
use App\Models\Lessor;
use App\Models\Property;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $lessors = Lessor::count();
        $lessees = Lessee::count();
        $properties = Property::count();
        $contracts = Contract::count();

        return view('layouts/inicio', compact(
            'lessors',
            'lessees',
            'properties',
            'contracts'
        ));
    }
}
