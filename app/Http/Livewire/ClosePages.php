<?php

namespace App\Http\Livewire;


use App\Traits\UrlValid;
use Carbon\Carbon;
use App\Models\Domain;
use Livewire\Component;
use App\Models\ClosePage;
use App\Classes\FtpServers;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use App\Traits\AuthorizesRoleOrPermission;

class ClosePages extends Component
{

    use WithPagination;
    use AuthorizesRoleOrPermission;
    use UrlValid;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $url_page, $url_waitlist, $close_at;
   
    public $timezone = "CT - America/Chicago";
    public $updateMode = false;
    public $sort = 'close_at';
    public $direction = 'desc';
    public $cant = '10';

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'close_at'],
        'direction' => ['except' => 'desc'],
        'keyWord' => ['except' => ''],
    ];

    protected $listeners = ['render', 'closetimeChanged', 'delete'];
    

    public function mount()
    {
        $this->authorizeRoleOrPermission('closepages.index');
    }

    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';
        $pages = ClosePage::where('url_page', 'LIKE', $keyWord)
            ->orWhere('url_waitlist', 'LIKE', $keyWord)
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
            
        return view('livewire.closepages.view', compact('pages'));
    } //render



    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }

    private function resetInput()
    {
        $this->url_page = null;
        $this->url_waitlist = null;
        $this->close_at = null;
        $this->timezone = "CT - America/Chicago";
    }

    public function store()
    {
        $this->validate([
            'url_page' => 'required',
            //'url_waitlist' => 'required',
            'close_at' => 'required',
            'timezone' => 'required|not_in:0',
        ]);

        if($this->urlValid($this->url_page))
        {
            $domain_name = trim(strstr(str_replace(['http://', 'https://', 'www.'], '', $this->url_page), '/', true));
            $domains = Domain::pluck('name')->toArray();
            if (in_array($domain_name, $domains)) {
                debug("mio " . $domain_name);
                $domain_id = Domain::where('name', $domain_name)->first()->id;
                ClosePage::create([
                    'url_page' => $this->url_page,
                    'url_waitlist' => $this->url_waitlist,
                    'close_at' => $this->close_at,
                    'timezone' => $this->timezone,
                    'domain_id' => $domain_id,
                    'user_id' => auth()->user()->id,
                ]);
                $this->resetInput();
                $this->emit('closeModal');
                session()->flash('message', 'Close Page scheduled Successfully.');
            } else {
                $this->addError('url_page', 'Only allows url owned by ASK-Method.');
            }

        }else{
            $this->addError('url_page', 'Invalid Url or Page does not exist.');
        }

    }//store

    public function closetimeChanged($datetime)
    {
        $this->close_at = $datetime;
    }

    public function delete(ClosePage $page)
    {
        $page->delete();
    }

    public function edit(ClosePage $page)
    {
    
  //if (ftp_get($conn, $local_file, $remote_file, FTP_ASCII)) {
 /*        $path_closepages = "ClosePages/askmethod.com";
        $local_file = Storage::disk('local')->path("$path_closepages/index.php");
        $content = file_get_contents($local_file);
        $codeStartAt = strpos($content,'<!--start-script-->');
        $codeEndAt   = strrpos($content, '<!--end-script-->');
        if ($codeStartAt!==false && $codeEndAt!==false){
            $codeSearched = substr($content, $codeStartAt, ($codeEndAt-$codeStartAt) );
            $newCode = str_replace($codeSearched . '<!--end-script-->', "", $content);
            file_put_contents($local_file, $newCode);
        } */
    //else{dd("no hay code");}
       
  //}

		$this->selected_id = $page->id;
		$this->url_page = $page->url_page;
        $this->url_waitlist = $page->url_waitlist;
        $this->close_at = $page->close_at;
        $this->timezone = $page->timezone;
		$this->updateMode = true; 
    }//edit


    public function update()
    {
        $this->validate([
            'url_page' => 'required',
            //'url_waitlist' => 'required',
            'close_at' => 'required',
            'timezone' => 'required|not_in:0',
        ]);

        if ($this->selected_id) {
            $record = ClosePage::find($this->selected_id);
            $record->update([
                'url_page' => $this->url_page,
                'url_waitlist' => $this->url_waitlist,
                'close_at' => $this->close_at,
                'timezone' => $this->timezone,
                'done' => 0,
            ]);

            $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'PageToClose Successfully updated.');
        }
    }//update


} //class
