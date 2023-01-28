<h1 align="center">Adminer</h1>

This package provides drivers, helpers, repositories, endpoints starterpack implementation of basic features for facilitate developing admin menagement modules in your codebase, built by applying (concepts) like `Test Driven Development` `Event-Listener Driven Development` `Async-like (Queue)` `Cached`, (design principle) `RESTful API` `Tight Cohesion & Loose Coupling` `SOLID`, (design pattern) `Gangs of Four (GoF) Repository Pattern`. <br />
Click one of packages and follow the instruction to get started.

### 📃 Packages

<table style="width: 100%; border: none;">
  <tr>
    <th>No</th>
    <th>Repository</th>
    <th>Description</th>
  </tr>
  <tr>
    <td>1</td>
    <td>
      <a href="https://github.com/tripteki/laravelphp-user">laravelphp-user</a><br />
    </td>
    <td>User Management</td>
  </tr>
  <tr>
    <td>2</td>
    <td>
      <a href="https://github.com/tripteki/laravelphp-setting">laravelphp-setting</a><br />
    </td>
    <td>Setting Management</td>
  </tr>
  <tr>
    <td>3</td>
    <td>
      <a href="https://github.com/tripteki/laravelphp-setting-profile">laravelphp-setting-profile</a><br />
    </td>
    <td>Setting per-User Variable Environment Management</td>
  </tr>
  <tr>
    <td>4</td>
    <td>
      <a href="https://github.com/tripteki/laravelphp-setting-locale">laravelphp-setting-locale</a><br />
    </td>
    <td>Setting per-User i18n Management</td>
  </tr>
  <tr>
    <td>5</td>
    <td>
      <a href="https://github.com/tripteki/laravelphp-setting-menu">laravelphp-setting-menu</a><br />
    </td>
    <td>Setting per-User Menu Management</td>
  </tr>
  <tr>
    <td>6</td>
    <td>
      <a href="https://github.com/tripteki/laravelphp-acl">laravelphp-acl</a><br />
    </td>
    <td>Access Control List (granted or denied) Management</td>
  </tr>
  <tr>
    <td>7</td>
    <td>
      <a href="https://github.com/tripteki/laravelphp-log">laravelphp-log</a><br />
    </td>
    <td>Logging Management</td>
  </tr>
    <td>8</td>
    <td>
      <a href="https://github.com/tripteki/laravelphp-notification">laravelphp-notification</a><br />
    </td>
    <td>Notification Management</td>
  </tr>
</table>

Getting Started
---

Installation :

```
$ composer require tripteki/laravelphp-adminer
```

How to use it :

- Put `Tripteki\Adminer\Providers\AdminerServiceProvider` to service provider configuration list.

- Put `Tripteki\Adminer\Providers\AdminerServiceProvider::ignoreConfig()` into `register` provider, then publish config file into your project's directory with running (optionally) :

```
php artisan vendor:publish --tag=tripteki-laravelphp-adminer-configs
```

Author
---

- Trip Teknologi ([@tripteki](https://linkedin.com/company/tripteki))
- Hasby Maulana ([@hsbmaulana](https://linkedin.com/in/hsbmaulana))
