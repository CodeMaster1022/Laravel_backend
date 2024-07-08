<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
use App\Models\Rider;

class RiderRatings extends Component
{
    public $ratings;

    public function mount()
    {
        $this->ratings = Rider::select('id', "name")->get();
        foreach($this->ratings as $item) {
            $item->total_reviews = Review::where('rider_id', $item->id)
                                                ->whereRaw('type = 2')
                                                ->count('rider_id');
            $item->total_rating = Review::where('rider_id', $item->id)
                                                ->whereRaw('type = 2')
                                                ->sum('rating');

            if($item->total_reviews > 0) {
                $item->avg_rating = $item->total_rating / $item->total_reviews;
            } else {
                $item->avg_rating = 0;
            }
        }
    }

    public function remove($id) {
        $deleted = Review::where('rider_id', $id)->delete();

        $this->ratings = Rider::select('id', "name")->get();
        foreach($this->ratings as $item) {
            $item->total_reviews = Review::where('rider_id', $item->id)
                                                ->whereRaw('type = 2')
                                                ->count('rider_id');
            $item->total_rating = Review::where('rider_id', $item->id)
                                                ->whereRaw('type = 2')
                                                ->sum('rating');

            if ($item->total_reviews > 0) {
                $item->avg_rating = $item->total_rating / $item->total_reviews;
            } else {
                $item->avg_rating = 0;
            }
        }
    }

    public function render()
    {
        return view('livewire.riderratings');
    }
}
