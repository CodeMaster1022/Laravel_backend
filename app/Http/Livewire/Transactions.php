<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Transactions extends Component
{
    public $transactions;

    public function mount()
    {
        $this->transactions = DB::table("requests")
                                ->select("requests.*", DB::raw("CONCAT(drivers.first_name, ' ', drivers.last_name) as driver_name"), "riders.name as rider_name")
                                ->leftJoin("drivers", "drivers.id", "=", "requests.driver_id")
                                ->leftJoin("riders", "riders.id", "=", "requests.rider_id")
                                ->get();
    }

    public function render()
    {
        return view('livewire.transactions');
    }
}
