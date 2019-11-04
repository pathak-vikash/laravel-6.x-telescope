# laravel-6.x-telescope

This is the complete laravel setup that focused on adding examples &amp; usages of Laravel Telescope Package.


## Quick Info
Official Documentation: https://laravel.com/docs/6.x/telescope

Package Github Repository: https://github.com/laravel/telescope

Tested with Laravel Version: 6.4.0


## Requirements
Must review the laravel installation guide.

https://laravel.com/docs/6.x/installation


## Installation Guide

Clone the repository and just run these commands.

```
composer install
npm install                   // install npm dependencies
npm run --dev                 // publish package assets
```

Now change the database settings inside `.env` and run migration.

```
php artisan migrate
```

Note: Right now Laravel Telescope support the database driver.

## Run Application

```
php artisan serve
```

Now visit to Laravel Telescope Dashboard by opening this URL in browser `<base_url>/telescope`

Note: If you are using `redis` as Cache driver or Queue connection. Make sure it's configured properly. If not follow the documentation.

https://laravel.com/docs/6.x/redis


## Examples & Usages

You can find the different routes has been setup for each watchers. You can find this inside `routes/web.php`

## Watchers
Before digging into examples, make sure you have enabled respective `Watcher` settings in `config/telescope` & If there is any authorization has set, just ensure you are getting fulfilled the conditions.

You can check the authorization settings in `app/Providers/TelescopeServiceProvider.php > gate()`

### Telescope Dashboard
`<base_url>/telescope`

### Requests

Visit to `<base_url>/telescope/requests` to see the Requests watchers at UI. It'll capture all the requests made by application.

### Commands
Visit to `<base_url>/commands` to run the command and see the entries in Telescope dashboard.

You can see a new entry for `php artisan inspire`

### Schedule
Visit to `<base_url>/schedulers` to run the scheduler command and see the entries in Telescope dashboard.

You can see a new entry for `php artisan schedule:run`

### Jobs
Visit to `<base_url>/jobs/{count}` to create no of jobs <count> and see the entries in Telescope dashboard.

### Exceptions
Visit to `<base_url>/exceptions` to create new exception.

### Logs
Browse `<base_url>/logs` to to see the logs. 

If you have followed the #jobs watcher example, just run the `php queue:work` to process the queue as it's already contains the log statement inside job > handle.

### Dumps
Browse to `<base_url>/dumps` and then open Telescope Dashboard here.

### Queries
Browse to `<base_url>/create-user`

### Models
Browse to `<base_url>/create-user`

### Events
Browse to `<base_url>/events`

### Mail
Follow the `#Events` section ans Event Listener for event `\App\Events\NewUserRegistration` is responsible to send the mail

### Notifications
Browse to `<base_url>/notifications`

### Cache
Browse to `<base_url>/cache`

### Redis
Browse to `<base_url>/redis`

Make sure you have configured `redis` correctly. See the `#Run Application` section for the details.


For details, you have the complete source code with commits referenced :) 


## Thanks & Have fun!!!
