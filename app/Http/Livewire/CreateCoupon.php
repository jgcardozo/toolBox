<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CreateCoupon extends Component
{

    public $open = false;
    public $name, $discount, $limit, $available_until, $description;
    protected $rules = [
        'name'     => 'required|max:30|unique:coupons,name',
        'discount' => 'required|max:7',
        'limit'    => 'required|max:7',
        'description' => 'required|max:255',
        'available_until' => 'required'
    ];
   
    public function render()
    {
        return view('livewire.coupon.create-coupon');
    }


    public function create()
    {
        $this->validate();

        Coupon::create([
            'name' => $this->name,
            'discount' => $this->discount,
            'limit' => str_replace(',','',$this->limit),
            'available_until' => $this->available_until, //date('Y-m-d H:i:s'),
            'description' => $this->description,
            'actived' => 1,
            'deleted' => 0
        ]);

        $this->reset(['open', 'name', 'discount', 'limit', 'available_until', 'description' ]);
        $this->emitTo('show-coupons','render'); //le decimos al show-coupons que se creo un nuevo coupon , para que refresque la lista
        $this->emit('alert', 'Coupon created successfully'); //para sweetAlert en app.blade
    }//create


    /* validar en vivo con wire:model debe quitar el .defer */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }




}//class
