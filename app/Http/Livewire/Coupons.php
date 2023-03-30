<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;

class Coupons extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search = "";
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToload = true; //false //simular un lazyloading
    public $list = 'all';


    //propiedades por la url
    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    protected $listeners = ['render', 'delete']; //para escuchar el evento emitido de createCoupon y delete es emitido por deleteCoupon y sweetalert como delete

    public function render()
    {
        //dd($this->list); 
        if ($this->list=="unavailable"){
            $query = [ ['activated', '=', '1'], ['subscribed', '<>', '1']] ;
           //where('deleted', 1);
        }else if ($this->list=="available"){

        }


        if ($this->readyToload) {
            $coupons = Coupon:://where('deleted', 1)
               where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $coupons = [];
        }

        return view('livewire.coupons.view', compact('coupons'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    // https: //laravel-livewire.com/docs/2.x/lifecycle-hooks
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadCoupons()
    {
        $this->readyToload = true;
    }


    public function delete(Coupon $coupon)
    {
        // $coupon->delete(); elimina de verdad, pero es mejor solo ocultarlo
        $coupon->deleted = 1;
        $coupon->save();
    }

} //class
