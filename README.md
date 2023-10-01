# sideproject tracker

🚧 Hobby project, proof of concept & work in progress 🚧

A very simple, privacy-compliant view tracker for your small side projects, written in PHP.

- no cookies
- no personal data 
- no IPs stored

What is tracked?

- Date of the visit
- URL which is visited
- Referrer URL (base domain only)

Developed with Laravel Breeze and Laravel Livewire v3, local tooling: [DDEV](https://ddev.com/).

## Why?

This project is heavily inspired by [Statify (WordPress)](https://github.com/pluginkollektiv/statify), [Plausible](https://plausible.io/), [Koko (WordPress)](https://github.com/ibericode/koko-analytics), [Fathom](https://usefathom.com/) and others.

These tools provide privacy- and GDPR-compliant tracking without the need of cookie banner. Simply, because they do not track any personal data of visitors, they just count anonymized page views.

The software projects mentioned above are all awesome, but there is currently no way to selfhost them as standalone PHP software on shared (cheap) PHP webhosting. Shared PHP webhosting is quite common in Europe, e.g. Strato, Hetzner, All-Inkl, Hosteurope, World4You, Mittwald etc. This project follows the idea of the open source software WordPress: The software should run on every webhosting provider.

Of course there is the great open source solution [matomo](https://github.com/matomo-org/matomo) which runs on PHP, but at least I found it hard to configure it be cookieless and avoid all personal data.

## Tracking script (WIP)

```js
<script>
    // Replace with actucal values
    const trackingEndpoint = 'https://your-laravel-app-url/track-page-view';
    const trackingScriptKey = 'ABCDEFGH';
    
    // Get referrer and target information
    const referrer = document.referrer;
    const target = window.location.href;

    // Send a POST request to the tracking endpoint
    fetch(trackingEndpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ trackingScriptKey, referrer, target }),
    })
    .then(response => {
        if (response.ok) {
            console.log('Page view tracked successfully');
        } else {
            console.error('Failed to track page view');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
</script>
```

## Local development

Install dependencies:

```
ddev start
ddev composer install
ddev artisan key:generate
ddev artisan migrate
ddev npm install
```

Open site in browser, start vite via:

```
ddev lauch && ddev npm run dev
```

## How was this created

1. Followed https://github.com/mandrasch/ddev-laravel-breeze-livewire#how-was-this-created
2. `ddev npm install -D sass`, switch to app.scss file
3. `ddev npm install -D @tailwindcss/forms` (https://github.com/tailwindlabs/tailwindcss-forms)
4. Added migrations via `ddev artisan make:migration create_website_table`, etc.
5. Added livewire components, models and other controllers with `ddev artisan make:...`

## TODOs

For all the tasks it should be considered that there is no composer and no SSH support on many webspaces.

- [ ] Check for CORS, implement proof of concept v.0.1
- [ ] Switch to sqLite db?
- [ ] disable registration, only create admin user
- [ ] Installation strategy? ([Build composer in GH action?](https://social.tchncs.de/@Crell@phpc.social/111148882960396763))
- [ ] Update strategy? (How to run db migrations without SSH?)
- [ ] Add [testing](https://livewire.laravel.com/docs/testing)
- [ ] Only allow calling the endpoint from the actual website?
- [ ] Clean up and long term data storage (future problem ;-))

## Security

Please be advised - this is a hobby project, which is still work in progress. It is not meant to be used in production (yet).

The whole authentication process was set up with the [Laravel Breeze StarterKit](https://laravel.com/docs/10.x/starter-kits). This project is provided under [MIT license](https://choosealicense.com/licenses/mit/), which excludes liability or warranty of any kind.

## When not to use

This project was built to track small static site projects, which usually have no user or admin dashboards.

It is not intended for high traffic websites.

There is no exclusion list, so you need to take care of not tracking sensitive backend URLs. Only inject the tracking script in the frontend.

If you use WordPress, I would suggest rather using [Statify](https://github.com/pluginkollektiv/statify), [Koko](https://github.com/ibericode/koko-analytics), [Plausible](https://plausible.io/), [Fathom](https://usefathom.com/), etc. They offer a tighter integration into the WordPress system and enable exclusions for the backend interface.

## License

MIT
