<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Request;
use App\Models\Driver;
use App\Models\Rider;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class Dashboard extends Component
{
    public $total_earning;
    public $total_drivers;
    public $diff_drivers;
    public $total_riders;
    public $diff_riders;
    public $monthly_earning;
    public $diff_monthly_earning;
    public $total_request;
    public $request_progress;
    public $request_completion;
    public $request_cancellation;
    public $driver_incomme_rankings;
    public $monthly_earning_data;
    public $weekly_earning_data;

    public function mount() {
        $this->total_earning = Request::where('status', 1)->sum('cost');
        // $this->total_earning = number_format($this->total_earning);

        $this->total_drivers = Driver::count();
        $this->total_drivers = number_format($this->total_drivers);

        $last_month_total_drivers = Driver::whereYear('created_at', Carbon::now()->year)
                                                ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                                                ->count();

        $this_month_total_drivers = Driver::whereYear('created_at', Carbon::now()->year)
                                                ->whereMonth('created_at', Carbon::now()->month)
                                                ->count();

        $this->diff_drivers = $this_month_total_drivers - $last_month_total_drivers;
        
        $this->total_riders = Rider::count();
        $this->total_riders = number_format($this->total_riders);

        $last_month_total_riders = Rider::whereYear('created_at', Carbon::now()->year)
                                                ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                                                ->count();

        $this_month_total_riders = Rider::whereYear('created_at', Carbon::now()->year)
                                                ->whereMonth('created_at', Carbon::now()->month)
                                                ->count();

        $this->diff_riders = $this_month_total_riders - $last_month_total_riders;

        $this->monthly_earning = Request::where('status', 1)
                                            ->whereYear('end_date', Carbon::now()->year)
                                            ->whereMonth('end_date', Carbon::now()->month)
                                            ->sum('cost');

        $last_month_earning = Request::where('status', 1)
                                            ->whereYear('end_date', Carbon::now()->year)
                                            ->whereMonth('end_date', Carbon::now()->subMonth()->month)
                                            ->sum('cost');

        $this->diff_monthly_earning = $this->monthly_earning - $last_month_earning;

        $this->total_request = Request::count();
        $progress = Request::where('status', 0)->count();
        $completion = Request::where('status', 1)->count();
        $cancellation = Request::where('status', 2)->count();

        if($this->total_request == 0) {
            $this->request_progress = 0;
            $this->request_completion = 0;
            $this->request_cancellation = 0;
        } else {
            $this->request_progress = ($progress / $this->total_request) * 100;
            $this->request_completion = ($completion / $this->total_request) * 100;
            $this->request_cancellation = ($cancellation / $this->total_request) * 100;
        }

        $this->driver_incomme_rankings = Driver::select('id', 'driver_photo', 'first_name', 'last_name')->get();

        foreach($this->driver_incomme_rankings as $driver) {
            $driver->total_earning = Request::where('driver_id', $driver->id)
                                            ->where('status', 1)
                                            ->sum('cost');
        }

        $this->driver_incomme_rankings = $this->driver_incomme_rankings->sortByDesc('total_earning')->take(5);

        $weekly_data = DB::table('requests')
                                ->selectRaw('SUM(cost) as total_cost, DAYNAME(end_date) as day_of_week')
                                ->whereRaw('YEARWEEK(end_date, 1) = YEARWEEK(CURDATE(), 1)')
                                ->where('status', 1)
                                ->groupByRaw('DAYOFWEEK(end_date), end_date')
                                ->orderByRaw('DAYOFWEEK(end_date)')
                                ->get();
    
        $days_of_week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $this->weekly_earning_data = [];
        for($i = 0; $i < count($days_of_week); $i ++) {
            $this->weekly_earning_data[] = 0;
        }

        for($i = 0; $i < count($days_of_week); $i ++) {
            foreach($weekly_data as $day) {
                if($days_of_week[$i] == $day->day_of_week) {
                    $this->weekly_earning_data[$i] += (float) $day->total_cost;
                }
            }
        }

        $monthly_data = DB::table('requests')
                                        ->selectRaw('SUM(cost) as total_cost, MONTHNAME(end_date) as month')
                                        ->whereRaw('YEAR(end_date) = YEAR(CURDATE())')
                                        ->where('status', 1)
                                        ->groupByRaw('MONTH(end_date), month')
                                        ->orderByRaw('MONTH(end_date)')
                                        ->get();

        $months_of_year = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $this->monthly_earning_data = [];
        for($i = 0; $i < count($months_of_year); $i ++) {
            $this->monthly_earning_data[] = 0;
        }

        for($i = 0; $i < count($months_of_year); $i ++) {
            foreach($monthly_data as $month) {
                if($months_of_year[$i] == $month->month) {
                    $this->monthly_earning_data[$i] += (float) $month->total_cost;
                }
            }
        }
    }

    public function render()
    {
        return view('dashboard');
    }
}
