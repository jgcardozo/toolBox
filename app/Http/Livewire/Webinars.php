<?php

namespace App\Http\Livewire;

use App\Models\Domain;
use Livewire\Component;
use App\Classes\FtpServers;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use App\Traits\AuthorizesRoleOrPermission;

class Webinars extends Component
{

  use WithPagination;
  use AuthorizesRoleOrPermission;
  protected $paginationTheme = "bootstrap";
  protected $myftp;
  public $sort = 'time';
  public $direction = 'desc';
  public $cant = '10';


  public $show, $time, $timeEnd, $value, $smsListId, $smsText1, $smsText2, $calendarTitle, $calendarDescription, $unavailable;

  public $serverName, $serverFileSelected, $domainId;

  public $datesjson = [], $webinars = [], $servers = [], $serverFiles = [];

  public $dateSelected, $itemSelected; //editMethod


  protected $listeners = ['timeChanged', 'timeEndChanged', 'delete', 'render'];

  public function mount()
  {
    $this->authorizeRoleOrPermission('webinars.index');
    //$servers = Domain::orderBy('name')->pluck('name');
  }

  public function cancel()
  {
    $this->skipRender();
    $this->resetInput();
    //$this->updateMode = false;
  }

  private function resetInput()
  {
    $this->time = null;
    $this->timeEnd = null;
    $this->time = null;
    $this->timeEnd = null;
    $this->value = null;
    $this->smsListId = null;
    $this->smsText1 = null;
    $this->smsText2 = null;
    $this->calendarTitle = null;
    $this->calendarDescription = null;
  }

  private function listJson()
  {
    $this->domainId = Domain::where('name', $this->serverName)->pluck('id')->first();
    $this->myftp = new FtpServers();
    $this->serverFiles = $this->myftp->webinarListJson($this->domainId);
    $this->myftp->close();
  }

  public function updatedServerName($value)
  { 
    $this->listJson();
  }

  public function updatedServerFileSelected($value)
  {
    if ($value) {
      $filename = $value;
      $this->myftp = new FtpServers();
      $data = $this->myftp->webinarFile($this->domainId, $filename, 'get');
      $this->myftp->close();
      //
      $this->webinars = collect($data);
      $this->datesjson = $data;
    } //if
  }


  public function render()
  {
    return view('livewire.webinars.view', ['webinars' => $this->webinars, 'servers' => $this->servers]);
  } //render


  public function edit($itemSelected)
  {
    $this->skipRender();
    $dateSelected = array_filter($this->datesjson, function ($item) use ($itemSelected) {
      return $item['time'] === $itemSelected;
    });
    $this->itemSelected = $itemSelected;
   
    foreach ($dateSelected as $it) {  
      $this->show = $it['show'];
      $this->unavailable = $it['unavailable'];
      $this->time = $it['time'];
      $this->timeEnd = $it['timeEnd'];
      $this->value = $it['value'];
      $this->smsListId = $it['smsListId'];
      $this->smsText1 = $it['smsText1'];
      $this->smsText2 = $it['smsText2'];
      $this->calendarTitle = $it['calendarTitle'];
      $this->calendarDescription = $it['calendarDescription'];     
    } //for
  } //edit



  public function update()
  {
    $this->validate([
      'show' => 'required',
      'unavailable' => 'required',
      'time' => 'required',
      'timeEnd' => 'required',
      'value' => 'required',
      'smsListId' => 'required',
      'smsText1' => 'required',
      'smsText2' => 'required',
      'calendarTitle' => 'required',
      'calendarDescription' => 'required',
    ]);

    foreach ($this->datesjson as $key => $item) {
      if ($item['time'] === $this->itemSelected) {
        $this->datesjson[$key]['show'] = $this->show;
        $this->datesjson[$key]['unavailable'] = $this->unavailable;
        $this->datesjson[$key]['time'] = $this->time;
        $this->datesjson[$key]['timeEnd'] = $this->timeEnd;
        $this->datesjson[$key]['value'] = $this->value;
        $this->datesjson[$key]['smsListId'] = $this->smsListId;
        $this->datesjson[$key]['smsText1'] = $this->smsText1;
        $this->datesjson[$key]['smsText2'] = $this->smsText2;
        $this->datesjson[$key]['calendarTitle'] = $this->calendarTitle;
        $this->datesjson[$key]['calendarDescription'] = $this->calendarDescription;
        break;
      }
    }

    $newJson = json_encode($this->datesjson, JSON_UNESCAPED_UNICODE);
    debug($this->filename, $newJson);
    /*
    $domain_id = Domain::where('name', 'HybridExpert.com')->pluck('id')->first();
    $filename = "dates-workshop-test.json";
    $this->myftp = new FtpServers();
    $data = $this->myftp->webinarFile($domain_id, $filename, 'put', $newJson);
    $this->myftp->close();
    */

  } //update


  public function timeChanged($datetime)
  {
    $this->time = $datetime;
  }

  public function timeEndChanged($datetime)
  {
    $this->timeEnd = $datetime;
  }


  public function store()
  {
    $this->validate([
      'time' => 'required',
      'timeEnd' => 'required',
      'value' => 'required',
      'smsListId' => 'required',
      'smsText1' => 'required',
      'smsText2' => 'required',
      'calendarTitle' => 'required',
      'calendarDescription' => 'required',
    ]);

    $newRecord = [
      "show" => true,
      "time" => $this->time,
      "timeEnd" => $this->timeEnd,
      "value" => $this->value,
      "smsListId" => $this->smsListId,
      "smsText1" => $this->smsText1,
      "smsText2" => $this->smsText2,
      "calendarTitle" => $this->calendarTitle,
      "calendarDescription" => $this->calendarDescription
    ];

    $this->datesjson[] = $newRecord;

    $newJson = json_encode($this->datesjson, JSON_UNESCAPED_UNICODE);
    debug($this->datesjson);
    // dry juan
    $domain_id = Domain::where('name', 'HybridExpert.com')->pluck('id')->first();
    $filename = "dates-workshop-test.json";
    $this->myftp = new FtpServers();
    $data = $this->myftp->webinarFile($domain_id, $filename, 'put', $newJson);
    $this->myftp->close();


  } //store



  public function delete($itemSelected)
  {
    debug($itemSelected);
    foreach ($this->datesjson as $key => $date) {
      if ($date['time'] === $itemSelected) {
        unset($this->datesjson[$key]);
      }
    }
    $newJson = json_encode(array_values($this->datesjson), JSON_UNESCAPED_UNICODE);
    debug($newJson);
    $domain_id = Domain::where('name', 'HybridExpert.com')->pluck('id')->first();
    $filename = "dates-workshop-test.json";
    $this->myftp = new FtpServers();
    $data = $this->myftp->webinarFile($domain_id, $filename, 'put', $newJson);
    $this->myftp->close();
  } //delete




} //class
