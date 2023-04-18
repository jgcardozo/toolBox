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

	protected $queryString = [
		'cant' => ['except' => '10'],
		'sort' => ['except' => 'id'],
		'direction' => ['except' => 'desc'],
		'keyWord' => ['except' => ''],
	];

	protected $listeners = ['render', 'delete'];

	public function render()
	{

		if ($this->list == "unavailable") {
			$query = [['activated', '=', '1'], ['subscribed', '<>', '1']];
			//where('deleted', 1);
		} else if ($this->list == "available") {

		}

		$keyWord = '%' . $this->keyWord . '%';
		return view('livewire.coupons.view', [
			'coupons' => Coupon::latest() //where('deleted', 1)
				->orWhere('name', 'LIKE', $keyWord)
				->orWhere('description', 'LIKE', $keyWord)
				//->orWhere('type', 'LIKE', $keyWord)	
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
		//$this->actived = null;
		//$this->deleted = null;
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
		//$this->emit('closeModal');
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
			//'actived' => 'required',
			//'deleted' => 'required',
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


} //class
