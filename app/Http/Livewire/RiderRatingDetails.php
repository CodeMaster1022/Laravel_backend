<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Review;
use App\Models\Rider;
use Illuminate\Support\Facades\DB;

class RiderRatingDetails extends Component
{
    public $details;

    public function mount($id)
    {
        $this->details = Rider::select('id', "name", "photo")->where('id', $id)->first();

        $this->details->total_reviews = Review::where('rider_id', $this->details->id)
                                            ->whereRaw('type = 2')
                                            ->count('rider_id');
        $this->details->reviews = DB::table("review")
                                        ->select("review.*", DB::raw("CONCAT(first_name, ' ', last_name) as driver_name"))
                                        ->leftJoin("drivers", "drivers.id", "=", "review.driver_id")
                                        ->where('review.rider_id', $this->details->id)
                                        ->whereRaw('review.type = 2')
                                        ->get();

        $this->details->total_rating = Review::where('rider_id', $this->details->id)
                                            ->whereRaw('type = 2')
                                            ->sum('rating');

        if($this->details->total_reviews > 0) {
            $this->details->avg_rating = $this->details->total_rating / $this->details->total_reviews;
        } else {
            $this->details->avg_rating = 0;
        }
    }

    public function delete($id) {
        Review::where('id', $id)->delete();
        session()->flash('success', 'Review deleted successfully');

        $this->details = Rider::select('id', "name", "photo")->where('id', $this->details->id)->first();

        $this->details->total_reviews = Review::where('rider_id', $this->details->id)
                                            ->whereRaw('type = 2')
                                            ->count('rider_id');
        $this->details->reviews = DB::table("review")
                                        ->select("review.*", DB::raw("CONCAT(first_name, ' ', last_name) as driver_name"))
                                        ->leftJoin("drivers", "drivers.id", "=", "review.driver_id")
                                        ->where('review.rider_id', $this->details->id)
                                        ->whereRaw('review.type = 2')
                                        ->get();

        $this->details->total_rating = Review::where('rider_id', $this->details->id)
                                            ->whereRaw('type = 2')
                                            ->sum('rating');

        if($this->details->total_reviews > 0) {
            $this->details->avg_rating = $this->details->total_rating / $this->details->total_reviews;
        } else {
            $this->details->avg_rating = 0;
        }
    }

    public function render()
    {
        return view('livewire.riderratingdetails');
    }
}
