## How was this created

- Followed https://ddev.readthedocs.io/en/latest/users/quickstart/#laravel

- Installed breeze with livewire option, dark mode and pest:

```
ddev composer require laravel/breeze --dev
ddev artisan breeze:install
ddev artisan migrate
ddev npm install
```

Run:

```
ddev npm run dev
```


https://laravel-news.com/crud-operations-using-laravel-livewire
Beware: namespace for livewire changed to namespace App\Livewire; not \Http anymore
