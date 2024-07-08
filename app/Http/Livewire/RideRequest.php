<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Request;
use Illuminate\Support\Facades\DB;

class RideRequest extends Component
{
    public $requests;

    public function mount()
    {
        $this->requests = DB::table("requests")
                                ->select("requests.*", DB::raw("CONCAT(drivers.first_name, ' ', drivers.last_name) as driver_name"), "riders.name as rider_name")
                                ->leftJoin("drivers", "drivers.id", "=", "requests.driver_id")
                                ->leftJoin("riders", "riders.id", "=", "requests.rider_id")
                                ->get();
    }

    public function remove($id) {
        $request = Request::find($id);
        $request->delete();
        $this->requests = DB::table("requests")
                                ->select("requests.*", DB::raw("CONCAT(drivers.first_name, ' ', drivers.last_name) as driver_name"), "riders.name as rider_name")
                                ->leftJoin("drivers", "drivers.id", "=", "requests.driver_id")
                                ->leftJoin("riders", "riders.id", "=", "requests.rider_id")
                                ->get();
    }

    public function render()
    {
        return view('livewire.riderequest');
    }
}
