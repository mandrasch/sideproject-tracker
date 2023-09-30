Run it

```
ddev start
ddev composer install
ddev artisan key:generate
ddev artisan migrate
ddev npm install

ddev npm run dev
```

## How was this created

1. Followed https://ddev.readthedocs.io/en/latest/users/quickstart/#laravel

2. 2.Installed breeze with livewire option, dark mode and pest:

```
ddev composer require laravel/breeze --dev
ddev artisan breeze:install
ddev artisan migrate
ddev npm install
```

3. Followed this tutorial: https://laravel-news.com/crud-operations-using-laravel-livewire
Beware: namespace for livewire changed to namespace App\Livewire; not \Http anymore + you can't use addPost and addPost in the same component anymore
