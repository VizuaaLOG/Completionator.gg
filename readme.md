# Completionator (name TBD)

**This is super early development, is unusable, and may not ever be completed. However, ideas are welcome!**

Completionator is aimed at, once complete (or at least ready), being a self-hostable game collection and tracking platform.

This project is super early but some features that would be good include:
* Game management (including DLC)
* Platform management with games being able to be linked with multiple platforms (platform is a console or PC)
* Storefront management with games being able to be linked with multiple storefronts (physical, steam etc.)
* IGDB integration - details and media can be automatically pulled, manual entry will always be supported though
* Collections - to organise your games as you wish
* Purchase/sold/value tracking
* Release alerts - for games on your wishlist
* Release alerts - for new content for games you own
* Calendar that shows game releases etc. based on your wishlist
* Price alerts for wishlisted games
* Import from platforms (steam, EA, Ubisoft, How Long To Beat) - etc. Ideally so that games can be automatically synced

## Docker
Note that this process will likely be, hopefully, much more streamlined in future!

### Development
If you wish to spin up a developer version, this just doesn't include the code in the build since it'll be mounted ensure you use docker-compose with the .dev file
```
docker-compose --file ./docker-compose.dev.yml up -d

# Install compose deps, cp env, setup env
docker exec -it completionatorgg-fpm-1 composer install --no-cache
docker exec -it completionatorgg-fpm-1 cp .env.example .env
docker exec -it completionatorgg-fpm-1 php artisan key:generate
```
At this point update the .env file with the relevant settings. Then we can run migrations:
```
docker exec -it completionatorgg-fpm-1 php artisan migrate --force
```
It's now time to create your admin user:
```
docker exec -it completionatorgg-fpm-1 php artisan app:create-admin
```

### Production (ish)
If you would like to spin-up a more production (ish) environment, essentially where the build is mostly done, use the example docker-compose file instead.
In future docker env files will hopefully be used here so that the manual editing of the .env is not needed.

```
docker-compose --file ./docker-compose.example.yml up -d

# Install compose deps, cp env, setup env
docker exec -it completionatorgg-fpm-1 cp .env.example .env
docker exec -it completionatorgg-fpm-1 php artisan key:generate
```
At this point update the .env file with the relevant settings. Then we can run migrations:
```
docker exec -it completionatorgg-fpm-1 php artisan migrate --force
```
It's now time to create your admin user:
```
docker exec -it completionatorgg-fpm-1 php artisan app:create-admin
```

## Screenshots
![dashboard](/screenshots/dashboard.jpg?raw=true "Dashboard")
![dashboard](/screenshots/game view.jpg?raw=true "Dashboard")
![dashboard](/screenshots/game edit.jpg?raw=true "Dashboard")