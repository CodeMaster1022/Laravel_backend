<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Request;
use App\Models\Driver;
use Carbon\Carbon;

class DriverEarning extends Component
{
    public $drivers;

    public function mount()
    {
        $this->drivers = Driver::select('id', 'first_name', 'last_name')->get();
        foreach($this->drivers as $driver) {
            $driver->total_earning = Request::where('driver_id', $driver->id)
                                                ->where('status', 1)
                                                ->sum('cost');
            $driver->month_earning = Request::where('driver_id', $driver->id)
                                                ->where('status', 1)
                                                ->whereYear('end_date', Carbon::now()->year)
                                                ->whereMonth('end_date', Carbon::now()->month)
                                                ->sum('cost');
            $driver->today_earning = Request::where('driver_id', $driver->id)
                                                ->where('status', 1)
                                                ->whereDate('end_date', Carbon::today())
                                                ->sum('cost');
        }
    }

    public function render()
    {
        return view('livewire.driverearning');
    }
}
