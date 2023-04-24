<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;

class Coupons extends Component
{
	use WithPagination;

	protected $paginationTheme = 'bootstrap';
	public $selected_id, $keyWord, $name, $description, $actived, $deleted, $limit, $discount, $type, $available_until;
	
	public $updateMode = false;
	public $sort = 'id';
	public $direction = 'desc';
	public $cant = '10';
	public $readyToload = true; //false //simular un lazyloading
	public $list = 'all';

	public $status;

	protected $queryString = [
		'cant' => ['except' => '10'],
		'sort' => ['except' => 'id'],
		'direction' => ['except' => 'desc'],
		'keyWord' => ['except' => ''],
	];

	protected $listeners = ['render', 'delete', 'untilChanged', 'changeStatus'];

	public function render()
	{

		//$query = [['activated', '=', '1'], ['subscribed', '<>', '1']];
		// https://stackoverflow.com/questions/16815551/how-to-do-this-in-laravel-subquery-where-in
		// juan aca voy
		// falta lista all, available
		// report of uses con cupon_detail
		// modulo de ver el detail en el numero de uses
		
		if ($this->list == "all") {
			$this->status = 1;
		}
		if ($this->list == "not_ava") {
			$this->status = 0;
		}
		if ($this->list == "available") {
			$this->status = 1;	
		}

		$keyWord = '%' . $this->keyWord . '%';
		return view('livewire.coupons.view', [
			'coupons' => Coupon::
				whereIn('actived', [1,0])
				//whereIn('actived', $this->status)
				//->orWhere('name', 'LIKE', $keyWord)
				//->orWhere('description', 'LIKE', $keyWord)
				
				->orderBy($this->sort, $this->direction)
				->paginate($this->cant)
		]);

	} //render

	public function cancel()
	{
		$this->resetInput();
		$this->updateMode = false;
	}

	private function resetInput()
	{
		$this->name = null;
		$this->description = null;
		$this->limit = null;
		$this->discount = null;
		$this->type = null;
		$this->available_until = null;
	}

	public function store()
	{
		$this->validate([
			'name' => 'required',
			'available_until' => 'required',
		]);

		Coupon::create([
			'name' => $this->name,
			'description' => $this->description,
			'actived' => 1,
			'deleted' => 0,
			'limit' => $this->limit,
			'discount' => $this->discount,
			'available_until' => $this->available_until
		]);

		$this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Coupon Successfully created.');
	}

	public function edit($id)
	{
		$record = Coupon::findOrFail($id);

		$this->selected_id = $id;
		$this->name = $record->name;
		$this->description = $record->description;
		$this->actived = $record->actived;
		$this->deleted = $record->deleted;
		$this->limit = $record->limit;
		$this->discount = $record->discount;
		$this->type = $record->type;
		$this->available_until = $record->available_until;

		$this->updateMode = true;
	}

	public function update()
	{
		$this->validate([
			'name' => 'required',
			'available_until' => 'required',
		]);

		if ($this->selected_id) {
			$record = Coupon::find($this->selected_id);
			$record->update([
				'name' => $this->name,
				'description' => $this->description,
				//'actived' => $this-> actived,
				//'deleted' => $this-> deleted,
				'limit' => $this->limit,
				'discount' => $this->discount,
				'type' => $this->type,
				'available_until' => $this->available_until
			]);

			$this->resetInput();
			$this->updateMode = false;
			session()->flash('message', 'Coupon Successfully updated.');
		}
	}


	//my classes ////////////////////////////////////

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
		//$coupon->delete(); //elimina de verdad, pero es mejor solo ocultarlo
		$coupon->deleted = 1;
		$coupon->save();
	}


	public function untilChanged($datetime){
		$this->available_until = $datetime;
	}


	public function updatedDiscount(){
		$num = str_replace([',','.'],'',$this->discount);
		$this->discount = number_format($num, 0);
	}

	public function updatedLimit()
	{
		$num = str_replace([',', '.'], '', $this->limit);
		$this->limit = number_format($num, 0);
	}

	public function changeStatus(Coupon $coupon, $action)
	{
		if ($action == "enable") {
			$coupon->actived = 1;
		} else {
			$coupon->actived = 0;
		}
		$coupon->save();
		 
	}// changeStatus


} //class
