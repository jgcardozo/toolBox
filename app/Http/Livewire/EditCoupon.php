<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;


class EditCoupon extends Component
{
    public $coupon;
    public $open = false;
    public $disableEdition = true;
    protected $rules = [
        'coupon.name'     => 'required|max:30',
        'coupon.discount' => 'required|max:7',
        'coupon.limit'    => 'required|max:7',
        'coupon.description' => 'required|max:255',
        'coupon.available_until' => 'required'
    ];
   

    public function mount(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    public function render()
    {
        return view('livewire.coupon.edit-coupon');
    }


    public function update()
    {
        $this->validate();
        $this->coupon->save(); //metodo save() eloquent
        $this->reset(['open']); //devuelve la(s) variable al valor default
        $this->emitTo('show-coupons', 'render');
        $this->emit('alert', 'Coupon has been updated successfully');
    }




}//class
