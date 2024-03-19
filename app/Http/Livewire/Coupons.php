<?php

namespace App\Http\Livewire;


use App\Models\Log;
use App\Models\Coupon;
use Livewire\Component;
use App\Models\CouponDetail;
use Livewire\WithPagination;
use App\Classes\CouponImport;
use Livewire\WithFileUploads;
use App\Classes\CouponDetailExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\AuthorizesRoleOrPermission;
use Illuminate\Validation\ValidationException;



class Coupons extends Component
{
	use WithPagination;
	use WithFileUploads;
	use AuthorizesRoleOrPermission;


	protected $paginationTheme = 'bootstrap';
	public $selected_id, $keyWord, $name, $description, $actived, $deleted, $limit, $discount, $type, $available_until;
	public $excel_file;

	public $loadingDetail, $loadingCoupons = false;

	public $updateMode = false;
	public $sort = 'times_used';
	public $direction = 'desc';
	public $cant = '10';
	public $readyToload = true; //false //simular un lazyloading
	public $list = 'all';
	public $couponDetail = [];


	protected $queryString = [
		'cant' => ['except' => '10'],
		'sort' => ['except' => 'times_used'],
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
			$deleted = [0, 1];
			$available_condition = '<=';
		}
		if ($this->list == "not_ava") {
			$actived = [0, 1];
			$deleted = [1];
			$available_condition = '>=';
		}
		if ($this->list == "available") {
			$actived = [1];
			$deleted = [0];
			$available_condition = '<=';
		}

		//->orWhere('available_until', $available_condition, Carbon::now()->format('Y-m-d H:i'))
		$coupons = Coupon::leftjoin('coupon_details', 'coupons.name', '=', 'coupon_details.coupon')
			->selectRaw('coupons.*, COALESCE(COUNT(coupon_details.coupon), 0) as times_used')
			->where(function ($query) use ($keyWord) {
				$query->where('coupons.name', 'LIKE', '%' . $keyWord . '%')
					->orWhere('coupons.description', 'LIKE', '%' . $keyWord . '%');
			})
			->whereIn('coupons.actived', $actived)
			->whereIn('coupons.deleted', $deleted)
			->groupBy('coupons.id')
			->orderBy($this->sort, $this->direction)
			->paginate($this->cant);

		//$couponDetail = $this->couponDetail;
		//debug($this->couponDetail);
		return view('livewire.coupons.view', compact('coupons')); //, 'couponDetail'

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
			'name' => 'required|unique:coupons',
			'available_until' => 'required',
			'discount' => 'required',
			'limit' => 'required',
		]);

		$coupon = Coupon::create([
			'name' => $this->name,
			'description' => $this->description,
			'actived' => 1,
			'deleted' => 0,
			'limit' => $this->limit,
			'discount' => $this->discount,
			'available_until' => $this->available_until
		]);
		$log = new Log();
		$log['action'] = 'created';
		$log['user_id'] = auth()->user()->id;
		$log['keyword'] = $coupon->name;
		$log->logable()->associate($coupon);
		$log->save();

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
			'discount' => 'required',
			'limit' => 'required',
		]);

		if ($this->selected_id) {
			$coupon = Coupon::find($this->selected_id);
			$originalValues = $coupon->getOriginal();
			$coupon->update([
				'name' => $this->name,
				'description' => $this->description,
				'limit' => $this->limit,
				'discount' => $this->discount,
				'type' => $this->type,
				'available_until' => $this->available_until
			]);
			$changes = $coupon->getChanges();
			$json_old = $json_new = "";
			foreach ($changes as $column => $newValue) {
				if ($column === 'updated_at') {
					continue;
				} else if ($column === 'available_until' && $originalValues['available_until'] == $newValue) {
					continue;
				} else {
					$json_old .= "$column: $originalValues[$column]" . PHP_EOL;
					$json_new .= "$column: $newValue" . PHP_EOL;
				}
			} //forEach field changed
			$log = new Log();
			$log['action'] = 'updated';
			$log['user_id'] = auth()->user()->id;
			$log['keyword'] = $coupon->name;
			$log['json_old'] = $json_old;
			$log['json_new'] = $json_new;
			$log->logable()->associate($coupon);
			$log->save();

			$this->resetInput();
			$this->updateMode = false;
			//session()->flash('message', 'Coupon Successfully updated.');
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
	public function updatingKeyWord()
	{
		$this->resetPage();
		$this->dispatchSearch(); //agilizar search
	}

	public function loadCoupons()
	{
		$this->readyToload = true;
	}


	public function delete(Coupon $coupon)
	{
		//$coupon->delete(); //elimina de verdad, pero es mejor solo ocultarlo
		$coupon->deleted = 1;
		$coupon->actived = 0;
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
		if ($action == "restore") {
			$coupon->deleted = 0;
			$coupon->actived = 1;
		}
		session()->flash('message', 'Coupon Successfully restored.');
		$coupon->save();

	} // changeStatus

	public function couponDetail(Coupon $coupon)
	{
		$this->loadingDetail = true;
		$this->name = $coupon->name;
		$this->couponDetail = CouponDetail::where('coupon', $this->name)
			->orderBy('created_at', 'desc')
			//->select('coupon', 'affiliate_id', 'affiliate', 'url', 'created_at')
			->get();
		$this->loadingDetail = false;
	}

	public function exportToExcel()
	{
		//dd($this->couponDetail);
		$filename = $this->name . "_" . date('Ymd-Hi') . ".xlsx";
		$this->emit('closeCouponDetail');
		session()->flash('message', "Excel-File: $filename exported successfully.");
		return Excel::download(new CouponDetailExport($this->couponDetail), $filename);
	}


	public function importFromExcel()
	{
		$this->validate([
			'excel_file' => 'required|mimes:xlsx,xls|max:2048',
		]);

		try {
			Excel::import(new CouponImport(), $this->excel_file->getRealPath());
			session()->flash('message', 'Excel imported successfully.');
			$this->emit('closeCouponImport');
		} catch (ValidationException $e) {
			$failures = $e->failures();
			foreach ($failures as $failure) {
				$rowIndex = $failure->row();
				$errorMessage = $failure->errors()[0];
				$this->addError('excel_file', "Error in row $rowIndex: $errorMessage");
			}
		}
		$this->excel_file = null;
	} //importExcel



} //class
