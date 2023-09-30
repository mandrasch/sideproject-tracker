<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Website as Websites;

class Website extends Component
{

    public $websites, $title, $description, $websiteId, $updateWebsite = false, $addWebsite = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteWebsiteListener'=>'deleteWebsite'
    ];

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'title' => 'required',
        'url' => 'required'
    ];

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->title = '';
        // TODO: add url
        $this->description = '';
    }

    /**
     * render the Website data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $this->websites = Websites::select('id', 'title', 'description')->get();
        return view('livewire.website.website-list');
    }

    /**
     * Open Add Website form
     * @return void
     */
    public function addNewWebsite()
    {
        $this->resetFields();
        $this->addWebsite = true;
        $this->updateWebsite = false;
    }
    /**
     * store the user inputted Website data in the Websites table
     * @return void
     */
    public function storeWebsite()
    {
        $this->validate();
        try {
            Websites::create([
                'title' => $this->title,
                'description' => $this->description
            ]);
            session()->flash('success','Website Created Successfully!!');
            $this->resetFields();
            $this->addWebsite = false;
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
    }

    /**
     * show existing Website data in edit Website form
     * @param mixed $id
     * @return void
     */
    public function editWebsite($id){
        try {
            $website = Websites::findOrFail($id);
            if( !$website) {
                session()->flash('error','Website not found');
            } else {
                $this->title = $website->title;
                $this->description = $website->description;
                $this->websiteId = $website->id;
                $this->updateWebsite = true;
                $this->addWebsite = false;
            }
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }

    }

    /**
     * update the Website data
     * @return void
     */
    public function updateWebsite()
    {
        $this->validate();
        try {
            Websites::whereId($this->websiteId)->update([
                'title' => $this->title,
                'description' => $this->description
            ]);
            session()->flash('success','Website Updated Successfully!!');
            $this->resetFields();
            $this->updateWebsite = false;
        } catch (\Exception $ex) {
            session()->flash('success','Something goes wrong!!');
        }
    }

    /**
     * Cancel Add/Edit form and redirect to Website listing page
     * @return void
     */
    public function cancelWebsite()
    {
        $this->addWebsite = false;
        $this->updateWebsite = false;
        $this->resetFields();
    }

    /**
     * delete specific Website data from the Websites table
     * @param mixed $id
     * @return void
     */
    public function deleteWebsite($id)
    {
        try{
            Websites::find($id)->delete();
            session()->flash('success',"Website Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }
}
