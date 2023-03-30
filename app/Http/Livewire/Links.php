<?php

namespace App\Http\Livewire;

use App\Models\Link;
use Livewire\Component;
use Livewire\WithPagination;


class Links extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search = '';
    public $sort = 'updated_at';
    public $direction = 'desc';
    public $cant = '10';

    //queryString para que la variable se vea en la url
    protected $queryString = [
        'cant' =>['except' => '10'], 
        'sort' =>['except' => 'updated_at'], 
        'direction' =>['except' => 'desc'], 
        'search' =>['except' => ''], 
    ];
    

    // https://dev.to/othmane_nemli/laravel-wherehas-and-with-550o
    // https://blog.quickadminpanel.com/5-ways-to-use-raw-database-queries-in-laravel/
    public function render()
    {
        $links = Link::with('domain')
            ->where('alias', 'LIKE', '%' . $this->search . '%')
            ->orWhere('short_url', 'LIKE', '%' . $this->search . '%')
            ->orWhere('long_url', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        return view('livewire.links.view', compact('links'));
    } //render


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


    public function updatingSearch()
    {
        $this->resetPage();
    } //liveWire liveCycle method

} //class