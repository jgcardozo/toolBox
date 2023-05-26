<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;
use App\Models\CouponDetail;
use Livewire\WithPagination;
use App\Traits\AuthorizesRoleOrPermission;

class Coupons extends Component
{
	use WithPagination;
	use AuthorizesRoleOrPermission;

	protected $paginationTheme = 'bootstrap';
	public $selected_id, $keyWord, $name, $description, $actived, $deleted, $limit, $discount, $type, $available_until;

	public $updateMode = false;
	public $sort = 'id';
	public $direction = 'desc';
	public $cant = '10';
	public $readyToload = true; //false //simular un lazyloading
	public $list = 'all';
	public $couponDetail = [];


	protected $queryString = [
		'cant' => ['except' => '10'],
		'sort' => ['except' => 'id'],
		'direction' => ['except' => 'desc'],
		'keyWord' => ['except' => ''],
	];

	protected $listeners = ['render', 'delete', 'untilChanged', 'changeStatus'];



	public function mount()
	{
		$this->authorizeRoleOrPermission('coupons.index');
	}



	public function render()
	{
		$keyWord = '%' . $this->keyWord . '%';

		if ($this->list == "all") {
			$actived = [0, 1];
		}
		if ($this->list == "not_ava") {
			$actived = [0];
		}
		if ($this->list == "available") {
			$actived = [1];
		} 

		$coupons = Coupon::where(function ($query) use ($keyWord) {
			$query->where('name', 'LIKE', $keyWord)
				->orWhere('description', 'LIKE', $keyWord);
		})
			->whereIn('actived', $actived)
			->orderBy($this->sort, $this->direction)
			->paginate($this->cant);

		$couponDetail = $this->couponDetail;

		return view('livewire.coupons.view', compact('coupons', 'couponDetail'));

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

	public function edit(Coupon $coupon)
	{
		//$record = Coupon::findOrFail($id);

		$this->selected_id = $coupon->id;
		$this->name = $coupon->name;
		$this->description = $coupon->description;
		$this->actived = $coupon->actived;
		$this->deleted = $coupon->deleted;
		$this->limit = $coupon->limit;
		$this->discount = $coupon->discount;
		$this->type = $coupon->type;
		$this->available_until = $coupon->available_until;

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


	public function untilChanged($datetime)
	{
		$this->available_until = $datetime;
	}



	public function updatedDiscount($value)
	{
		$value = preg_replace('/[^0-9]/', '', $value);
		if ($value) {
			$this->discount = number_format($value, 0);
		} else {
			$this->discount = $value;
		}
	}

	public function updatedLimit($value)
	{
		$value = preg_replace('/[^0-9]/', '', $value);
		if ($value) {
			$this->limit = number_format($value, 0);
		} else {
			$this->limit = $value;
		}
	}

	public function changeStatus(Coupon $coupon, $action)
	{
		if ($action == "enable") {
			$coupon->actived = 1;
		} else {
			$coupon->actived = 0;
		}
		$coupon->save();

	} // changeStatus

	public function couponDetail(Coupon $coupon)
	{
		$this->couponDetail = CouponDetail::where('coupon', $coupon->name)->get();
	}






} //class
