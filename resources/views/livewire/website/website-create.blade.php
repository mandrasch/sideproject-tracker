<div class="card">
    <div class="card-body">
        <form class="grid grid-cols-1 gap-6">
            <div class="form-group flex flex-col mb-3">
                <label for="title">Title:</label>
                <input type="text" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('title') is-invalid @enderror" id="title" placeholder="Enter Title" wire:model="title">
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col mb-3">
                <label for="title">URL:</label>
                <input type="text" class="form-control form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('url') is-invalid @enderror" id="url" placeholder="Enter URL" wire:model="url">
                @error('url')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="description">Description:</label>
                <textarea class="form-control form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('description') is-invalid @enderror" id="description" wire:model="description" placeholder="Enter Description (optional)"></textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="d-grid gap-2">
                <button wire:click.prevent="storeWebsite()" class="btn btn-primary btn-block">Save</button>
                <button wire:click.prevent="cancelWebsite()" class="btn btn-secondary btn-block">Cancel</button>
            </div>
        </form>
    </div>
</div>
