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
$ php artisan db:seed --class=Bantenprov_GroupEgovernmentSeeder
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
            path: '/admin/group-egovernment',
            components: {
                main: resolve => require(['./components/bantenprov/group-egovernment/index.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Group Government"
            }
        },
        {
            path: '/admin/group-egovernment/create',
            components: {
                main: resolve => require(['./components/bantenprov/group-egovernment/create.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Create Group Government"
        },
        {
            path: '/admin/group-egovernment/:id',
            components: {
                main: resolve => require(['./components/bantenprov/group-egovernment/view.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "View Group Government"
            }
        },
        {
            path: '/admin/group-egovernment/:id/edit',
            components: {
                main: resolve => require(['./components/bantenprov/group-egovernment/edit.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Edit Group Government"
            }
        }
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
            link: '/admin/group-egovernment',
            icon: 'fa fa-angle-double-right'
        },
        //== ...
    ]
},