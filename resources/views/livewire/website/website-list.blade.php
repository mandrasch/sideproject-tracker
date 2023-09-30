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
        @if($addWebsite)
            @include('livewire.website.website-create')
        @endif
        @if($updateWebsite)
            @include('livewire.website.website-update')
        @endif
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @if(!$addWebsite)
                    <a wire:click="addNewWebsite()" class="btn btn-primary btn-sm float-right">Add New Website</a>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($websites) > 0)
                            @foreach ($websites as $website)
                                <tr>
                                    <td>
                                        {{$website->title}}
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
                        @else
                            <tr>
                                <td colspan="3" align="center">
                                    No Websites Found.
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
