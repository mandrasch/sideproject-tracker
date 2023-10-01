<div>
    <div class="col-md-8 mb-2">
        @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif
        <!-- TODO: Use same view, just edit the action? -->
        @if($addWebsiteView)
            @include('livewire.website.website-create')
        @endif
        @if($updateWebsiteView)
            @include('livewire.website.website-create')
        @endif
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @if (count($websites) > 0)
                @if(!$addWebsiteView)
                    <button wire:click="addWebsite()" class="btn btn-primary btn-sm float-right">Add New Website</button>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Tracking Script Key</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($websites as $website)
                                <tr>
                                    <td>
                                        {{$website->title}}
                                    </td>
                                    <td>
                                        {{$website->url}}
                                    </td>
                                    <td>
                                        {{$website->tracking_script_key}}
                                    </td>
                                    <td>
                                        {{$website->description}}
                                    </td>
                                    <td>
                                        <button wire:click="editWebsite({{$website->id}})" class="btn btn-primary btn-sm">Edit</button>
                                        <button onclick="deleteWebsite({{$website->id}})" class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        @if(!$addWebsiteView)
                        <div class="py-6 flex flex-col justify-center grow-0">
                            <p class="py-6 text-center">No websites found yet, add the first one!</p>
                            <button wire:click="addWebsite()" class="btn btn-primary btn-sm w-auto mx-auto">Add New Website</button>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
