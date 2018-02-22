# Group E-Government

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bantenprov/group-egovernment/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/group-egovernment/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/bantenprov/group-egovernment/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/group-egovernment/build-status/master)
[![Latest Stable Version](https://poser.pugx.org/bantenprov/group-egovernment/v/stable)](https://packagist.org/packages/bantenprov/group-egovernment)
[![Total Downloads](https://poser.pugx.org/bantenprov/group-egovernment/downloads)](https://packagist.org/packages/bantenprov/group-egovernment)
[![Latest Unstable Version](https://poser.pugx.org/bantenprov/group-egovernment/v/unstable)](https://packagist.org/packages/bantenprov/group-egovernment)
[![License](https://poser.pugx.org/bantenprov/group-egovernment/license)](https://packagist.org/packages/bantenprov/group-egovernment)
[![Monthly Downloads](https://poser.pugx.org/bantenprov/group-egovernment/d/monthly)](https://packagist.org/packages/bantenprov/group-egovernment)
[![Daily Downloads](https://poser.pugx.org/bantenprov/group-egovernment/d/daily)](https://packagist.org/packages/bantenprov/group-egovernment)

4 Groups in Indonesian's E-Government
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

```bash
$ git clone https://github.com/bantenprov/group-egovernment.git
```

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

#### Lakukan auto dump :

```bash
$ composer dump-autoload
```

#### Lakukan seeding :

```bash
$ php artisan db:seed --class=BantenprovGroupEgovernmentSeeder
```

#### Lakukan publish component vue :

```bash
$ php artisan vendor:publish --tag=group-egovernment-assets
$ php artisan vendor:publish --tag=group-egovernment-public
```
#### Tambahkan route di dalam file : `resources/assets/js/routes.js` :

```javascript
{
    path: '/dashboard',
    redirect: '/dashboard/home',
    component: layout('Default'),
    children: [
        //== ...
        {
            path: '/dashboard/group-egovernment',
            components: {
                main: resolve => require(['./components/views/bantenprov/group-egovernment/DashboardGroupEgovernment.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Group Egovernment"
            }
        },
        //== ...
    ]
},
```

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
                main: resolve => require(['./components/bantenprov/group-egovernment/GroupEgovernment.index.vue'], resolve),
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
                main: resolve => require(['./components/bantenprov/group-egovernment/GroupEgovernment.add.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Add Group Government"
            }
        },
        {
            path: '/admin/group-egovernment/:id',
            components: {
                main: resolve => require(['./components/bantenprov/group-egovernment/GroupEgovernment.show.vue'], resolve),
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
                main: resolve => require(['./components/bantenprov/group-egovernment/GroupEgovernment.edit.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Edit Group Government"
            }
        },
        //== ...
    ]
},
```
#### Edit menu `resources/assets/js/menu.js`

```javascript
{
    name: 'Dashboard',
    icon: 'fa fa-dashboard',
    childType: 'collapse',
    childItem: [
        //== ...
        {
            name: 'Group Egovernment',
            link: '/dashboard/group-egovernment',
            icon: 'fa fa-angle-double-right'
        },
        //== ...
    ]
},
```

```javascript
{
    name: 'Admin',
    icon: 'fa fa-lock',
    childType: 'collapse',
    childItem: [
        //== ...
        {
            name: 'Group Egovernment',
            link: '/admin/group-egovernment',
            icon: 'fa fa-angle-double-right'
        },
        //== ...
    ]
},
```

#### Tambahkan components `resources/assets/js/components.js` :

```javascript
import GroupEgovernment from './components/bantenprov/group-egovernment/GroupEgovernment.chart.vue';
Vue.component('echarts-group-egovernment', GroupEgovernment);

import GroupEgovernmentKota from './components/bantenprov/group-egovernment/GroupEgovernmentKota.chart.vue';
Vue.component('echarts-group-egovernment-kota', GroupEgovernmentKota);

import GroupEgovernmentTahun from './components/bantenprov/group-egovernment/GroupEgovernmentTahun.chart.vue';
Vue.component('echarts-group-egovernment-tahun', GroupEgovernmentTahun);

import GroupEgovernmentAdminShow from './components/bantenprov/group-egovernment/GroupEgovernmentAdmin.show.vue';
Vue.component('admin-view-group-egovernment-tahun', GroupEgovernmentAdminShow);

//== Echarts Angka Partisipasi Kasar

import GroupEgovernmentBar01 from './components/views/bantenprov/group-egovernment/GroupEgovernmentBar01.vue';
Vue.component('group-egovernment-bar-01', GroupEgovernmentBar01);

import GroupEgovernmentBar02 from './components/views/bantenprov/group-egovernment/GroupEgovernmentBar02.vue';
Vue.component('group-egovernment-bar-02', GroupEgovernmentBar02);

//== mini bar charts
import GroupEgovernmentBar03 from './components/views/bantenprov/group-egovernment/GroupEgovernmentBar03.vue';
Vue.component('group-egovernment-bar-03', GroupEgovernmentBar03);

import GroupEgovernmentPie01 from './components/views/bantenprov/group-egovernment/GroupEgovernmentPie01.vue';
Vue.component('group-egovernment-pie-01', GroupEgovernmentPie01);

import GroupEgovernmentPie02 from './components/views/bantenprov/group-egovernment/GroupEgovernmentPie02.vue';
Vue.component('group-egovernment-pie-02', GroupEgovernmentPie02);

//== mini pie charts
import GroupEgovernmentPie03 from './components/views/bantenprov/group-egovernment/GroupEgovernmentPie03.vue';
Vue.component('group-egovernment-pie-03', GroupEgovernmentPie03);
```
