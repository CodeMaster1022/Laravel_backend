<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Rider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class RiderCreate extends Component
{
    use WithFileUploads;

    public $rider;
    public $name;
    public $email;
    public $phone_number;
    public $password;
    public $password_confirmation;
    public $photo;
    public $join_date;

    public function mount(Rider $rider)
    {
        $this->rider = $rider;
        $this->name = $rider->name;
        $this->email = $rider->email;
        $this->phone_number = $rider->phone_number;
        $this->photo = $rider->photo;
        $this->join_date = $rider->join_date;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:800',
        ]);
    }

    public function save()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($this->photo) {
            $validatedData['photo'] = $this->photo->store('assets/img', 'public');
        }

        if ($this->password) {
            $validatedData['password'] = Hash::make($this->password);
        } else {
            unset($validatedData['password']);
        }

        try {
            // Attempt to create a new rider record
            $this->rider->create($validatedData);
            session()->flash('message', 'Rider information saved successfully.');
        } catch (QueryException $e) {
            // Check if the error is a duplicate entry for the 'email' column
            if ($e->errorInfo[1] == 1062) {
                $this->addError('email', 'The email has already been taken.');
            } else {
                // Handle other possible errors
                $this->addError('general', 'Failed to create new rider due to unexpected error.');
            }
        }
    }

    public function render()
    {
        return view('livewire.ridercreate');
    }
}
