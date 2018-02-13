# Group E-Government

4 Groups Indonesian's E-Government
- G2G Goverment to Goverment
- G2E Goverment to Employee
- G2C Goverment to Citizen
- G2B Goverment to Business

### Install via composer

- Development snapshot
```bash
$ composer require bantenprov/group-egovernment:dev-master
```
- Latest release:

```bash
$ composer require bantenprov/group-egovernment
```

### Download via github
~~~
bash
$ git clone https://github.com/bantenprov/group-egovernment.git
~~~

#### Edit `config/app.php` :
```php

'providers' => [

    /*
    * Laravel Framework Service Providers...
    */
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    Illuminate\Bus\BusServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    Illuminate\Cookie\CookieServiceProvider::class,
    //....
    Bantenprov\GroupEgovernment\GroupEgovernmentServiceProvider::class,

```

#### Lakukan migrate :

```bash
$ php artisan migrate
```

#### Publish database seeder :

```bash
$ php artisan vendor:publish --tag=group-egovernment-seeds
```

#### Lakukan Auto Dump :

```bash
$ composer dump-autoload
```

#### Lakukan Seeding :

```bash
$ php artisan db:seed --class=BantenprovGroupEgovernmentSeeder
```

#### Lakukan publish component vue :

```bash
$ php artisan vendor:publish --tag=group-egovernment-assets
```
#### Tambahkan route di dalam file : `resources/assets/js/routes.js` :

```javascript
{
    path: '/admin',
    redirect: '/admin/dashboard/home',
    component: layout('Default'),
    children: [
        //== ...
        {
            path: '/admin/dashboard/group-egovernment',
            components: {
                main: resolve => require(['./components/bantenprov/group-egovernment/GroupEgovernment.index.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Group Government"
            }
        },
        //== ...
    ]
},

```
#### Edit menu `resources/assets/js/menu.js`

```javascript
{
    name: 'Admin',
    icon: 'fa fa-lock',
    childType: 'collapse',
    childItem: [
        //== ...
        {
            name: 'Group Government',
            link: '/admin/dashboard/group-egovernment',
            icon: 'fa fa-angle-double-right'
        },
        //== ...
    ]
},