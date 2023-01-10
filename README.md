# Election Violence Tracker

The Election Violence Tracker (EVT) is an open source reporting tool that enables citizens to document and report violent incidents during Nigeria's Election.

This is the source code for the API that powers the [website][webRepo]

## Setting up locally

Setting up locally is same as setting up any Laravel Application.

```
git clone 

composer install # please don't update the dependencies on your own !!

cp .env.example .env

php artisan key:generate

php artisan migrate

# if you are not using a service like valet
php artisan serve

```

## Contributing

## Security Vulnerability

[webRepo]: https://github.com/Policy-Lab-Africa/violenceTrackerWeb