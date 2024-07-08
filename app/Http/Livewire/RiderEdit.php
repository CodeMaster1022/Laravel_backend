<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Rider;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RiderEdit extends Component
{
    use WithFileUploads;

    public $rider;
    public $rider_id;
    public $name;
    public $email;
    public $phone_number;
    public $password;
    public $password_confirmation;
    public $photo;
    public $approval_date;
    public $status;

    public function mount($id)
    {
        $this->rider = Rider::find($id);
        $this->rider_id = $id;
        $this->name = $this->rider->name;
        $this->email = $this->rider->email;
        $this->phone_number = $this->rider->phone_number;
        $this->photo = $this->rider->photo;
        $this->join_date = $this->rider->join_date;
        $this->approval_date = $this->rider->approval_date;
        $this->status = $this->rider->status;
    }

    public function updateRider()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:riders,email,' . $this->rider->id,
            'phone_number' => 'required|string|max:20',
        ]);
        
        $this->rider->update($validatedData + [
            'status' => $this->status,
            'photo' => gettype($this->photo) != 'string' ? $this->photo->store('assets/img', 'public') : $this->rider->photo,
            'approval_date' => Carbon::now()
        ]);

        session()->flash('message', 'Rider updated successfully.');

        return redirect()->to('/riders');
    }

    public function resetPassword() {
        $this->rider = Rider::where('id', $this->rider_id)->update(['password' => Hash::make('12345678*')]);
        session()->flash('message', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.rideredit');
    }
}
