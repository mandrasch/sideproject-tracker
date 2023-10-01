<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Website as Websites;

class Website extends Component
{
    // TODO: addWebsite and updateWebsite came from tutorial, is there a simpler way?
    public $websites, $title, $url, $description, $websiteId, $updateWebsiteView = false, $addWebsiteView = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteWebsiteListener'=>'deleteWebsite'
    ];

    // TODO: We could add rules via new php attributes https://livewire.laravel.com/docs/validation
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
        $this->url = '';
        $this->description = '';
    }

    /**
     * render the Website data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        // TODO: add pagination?
        $this->websites = Websites::get();
        return view('livewire.website.website-list');
    }

    /**
     * Open Add Website form
     * @return void
     */
    public function addWebsite()
    {
        $this->resetFields();
        $this->addWebsiteView = true;
        $this->updateWebsiteView = false;
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
                'url'=> $this->url,
                'description' => $this->description
            ]);
            session()->flash('success','Website Created Successfully!!');
            $this->resetFields();
            $this->addWebsiteView = false;
        } catch (\Exception $ex) {
            dd($ex);
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
                $this->url = $website->url;
                $this->description = $website->description;
                $this->websiteId = $website->id;
                $this->updateWebsiteView = true;
                $this->addWebsiteView = false;
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
                'url' => $this->url,
                'description' => $this->description
            ]);
            session()->flash('success','Website Updated Successfully!!');
            $this->resetFields();
            $this->updateWebsiteView = false;
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
        $this->addWebsiteView = false;
        $this->updateWebsiteView = false;
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
