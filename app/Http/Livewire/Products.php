<?php

namespace App\Http\Livewire;


use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductType;
use Livewire\Component;
use Livewire\WithPagination;


class Products extends Component
{
	use WithPagination;

	protected $paginationTheme = 'bootstrap';
	public $selected_id, $keyWord, $reference, $reference2, $description, $price, $producttype_id, $brand_id;
	public $updateMode = false;
	public $brands, $ptypes, $imagen;
	public $sort = 'created_at';
	public $direction = 'desc';

	public function mount()
	{
		$this->brands = Brand::orderBy('description')->get();
		$this->ptypes = ProductType::all();
	}

	public function render()
	{
		$keyWord = '%' . $this->keyWord . '%';
		$products = Product::with('images')
			->orWhere('description', 'LIKE', $keyWord) //==nombre modelo
			->orderBy($this->sort, $this->direction)
			->paginate(20);
		return view('livewire.products.view', compact('products'));
	}

	public function cancel()
	{
		$this->resetInput();
		$this->updateMode = false;
	}

	private function resetInput()
	{
		$this->reference  = null;
		$this->reference2 = null;
		$this->description = null;
		$this->price = null;
		$this->imagen = null;
		$this->producttype_id = null;
		$this->brand_id = null;
	}

	public function store()
	{
		$validated = $this->validate([
			'description' => 'required|unique:products',
			'price' => 'required',
			'producttype_id' => 'required|not_in:0',
			'brand_id' => 'required|not_in:0',
		]);
		Product::create($validated);

		$this->resetInput();
		$this->emit('close');
		session()->flash('message', 'Product Successfully created.');
	}

	public function edit($id)
	{
		$record = Product::findOrFail($id);
		//dd($record);

		$this->selected_id = $id;
		$this->id_nro = $record->id_nro;
		$this->id_type = $record->id_type;
		$this->client_type = $record->client_type;
		$this->name = $record->name;
		$this->email = $record->email;
		$this->phone = $record->phone;
		$this->address = $record->address;
		$this->city_id = $record->city_id;

		$this->updateMode = true;
	}

	public function update()
	{
		$this->validate([
			'id_nro' => 'required',
			'id_type' => 'required',
			'name' => 'required',
			'phone' => 'required',
			'city_id' => 'required',
		]);

		if ($this->selected_id) {
			$record = Product::find($this->selected_id);
			$record->update([
				'id_nro' => $this->id_nro,
				'id_type' => $this->id_type,
				'name' => $this->name,
				'email' => $this->email,
				'phone' => $this->phone,
				'address' => $this->address,
				'city_id' => $this->city_id
			]);

			$this->resetInput();
			$this->updateMode = false;
			session()->flash('message', 'Product Successfully updated.');
		}
	}

	public function destroy($id)
	{
		if ($id) {
			$record = Product::where('id', $id);
			$record->delete();
		}
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
	} //sort

}//class
