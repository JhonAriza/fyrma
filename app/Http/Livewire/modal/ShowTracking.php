<?php

namespace App\Http\Livewire\Modal;

use App\Models\Trackings;
use Livewire\Component;

class ShowTracking extends Component
{
    public $open = false;
    public $show = false;
    public $trackings;

    protected $listeners = ['showTracking'];

    public function render()
    {
        return view('livewire.modal.show-tracking');
    }

    public function showTracking($id) {
        $this->trackings = Trackings::where('contract_id',$id)->get();
        $this->open = true;
        $this->show = (count($this->trackings) > 0) ? true : false;
    }
}
