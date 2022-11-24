<?php

namespace App\Http\Livewire;


use App\Models\City;
use App\Models\Client;
use App\Models\IdentificationType;
use Livewire\Component;
use Livewire\WithPagination;


class Clients extends Component
{
	use WithPagination;

	protected $paginationTheme = 'bootstrap';
	public $selected_id, $keyWord, $id_nro, $id_type, $client_type, $name, $email, $phone, $address, $city_id;
	public $updateMode = false;
	public $cities, $identificationTypes;
	public $sort = 'created_at'; 
	public $direction= 'desc';

	public function mount()
	{
		$this->cities = City::orderBy('description')->get();
		$this->itypes = IdentificationType::all();
	}

	public function render()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return view('livewire.clients.view', [
			'clients' => Client::orWhere('id_nro', 'LIKE', $keyWord)
				->orWhere('id_type', 'LIKE', $keyWord)
				->orWhere('client_type', 'LIKE', $keyWord)
				->orWhere('name', 'LIKE', $keyWord)
				->orWhere('email', 'LIKE', $keyWord)
				->orderBy($this->sort, $this->direction)
				->paginate(20),
		]);
	}

	public function cancel()
	{
		$this->resetInput();
		$this->updateMode = false;
	}

	private function resetInput()
	{
		$this->id_nro = null;
		$this->id_type = null;
		$this->client_type = null;
		$this->name = null;
		$this->email = null;
		$this->phone = null;
		$this->address = null;
		$this->city_id = null;
	}

	public function store()
	{
		$this->validate([
			'id_nro' => 'required|unique:clients',
			'id_type' => 'required|not_in:0',
			//'client_type' => 'required', //prospect , client
			'name' => 'required',
			'email' => 'required|email|unique:clients',
			'phone' => 'required',
			'city_id' => 'required|not_in:0',
		]);

		Client::create([
			'id_nro' => $this->id_nro,
			'id_type' => $this->id_type,
			//'client_type' => $this->client_type,
			'name' => $this->name,
			'email' => $this->email,
			'phone' => $this->phone,
			'address' => $this->address,
			'city_id' => $this->city_id
		]);

		$this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Client Successfully created.');
	}

	public function edit($id)
	{
		$record = Client::findOrFail($id);
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
			$record = Client::find($this->selected_id);
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
			session()->flash('message', 'Client Successfully updated.');
		}
	}

	public function destroy($id)
	{
		if ($id) {
			$record = Client::where('id', $id);
			$record->delete();
		}
	}


	public function order($sort)
	{	
		if ($this->sort==$sort) {
			if ($this->direction == 'desc') {
				$this->direction = 'asc';
			}else{
				$this->direction = 'desc';
			}	
		}else{
			$this->sort = $sort;
			$this->direction = 'asc';
		}
		
	}//sort

}//class
