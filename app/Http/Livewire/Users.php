<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    public $search;
    protected $paginationTheme = "bootstrap";


    public function render()
    {
        $users = User::with('roles')
            ->where('name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
            ->paginate();
        return view('livewire.users.view', compact('users'));
    } //render


    public function updatingSearch()
    {
        $this->resetPage();
    } //liveWire liveCycle method




}//class
