# disneyparks-laravel

Unofficial Disney Park Wait-time Package and API for Laravel 5.6+

## Installation 

### Step One

`composer require fyroc/disneyparks-laravel`

### Step Two

`php artisan vendor:publish --provider="fyroc\DisneyParks\DisneyParksProvider" --tag="config"`

### Step Three

Edit `config/disney-parks.php` to enable or disable the API routes

## Documentation

DisneyParks comes with an API or a Service Facade you can use,

* [API Documentation](https://github.com/fyroc/disneyparks-laravel/wiki/API-Documentation)
* [Service Examples](https://github.com/fyroc/disneyparks-laravel/wiki/Service-Examples)
