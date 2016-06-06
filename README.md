# clienttimezone
Gets the clients timezone difference from UTC in minutes using Javascript.

## How it works
If the client timezone is not stored in the session, the javascript will fire a POST ajax 
request, sending the clients current time offset in minutes from the UTC time. This offset
is then stored in session and the users browser reloads the current page. Javascript will 
then only have to do this once, or until a new session is started.

## Installation

1. Add ClientTimezone to your composer.json file under `require`:

  `"kevinorriss\clienttimezone": "1.0.*"`

2. Add a PSR-4 entry to your composer.json file under `autoload/psr-4`:

  `"KevinOrriss\\ClientTimezone\\": "vendor/kevinorriss/clienttimezone/src/"`

3. Add the ClientTimezoneServiceProvider to your app.php file:

  `KevinOrriss\ClientTimezone\ClientTimezoneServiceProvider::class,`
  
4. Add the ClientTimezone alias to your app.php file:

  `'ClientTimezone' => KevinOrriss\ClientTimezone\ClientTimezone::class,`

5. Run `composer update`

## Usage

In order to use this package, you need to setup your application so that Ajax calls send the 
CSRF token.

1. Add the following meta tag to your main blade layout file

  `<meta name="csrf-token" content="{{ csrf_token() }}" />`

2. Add the javascript ajax setup code using jquery, you could create `public/js/main.js` and add this script to you main layout

  ```
  $(document).ready(function()
  {
    $.ajaxSetup(
    {
      headers:
      {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  });
  ```
3. In your main layout add the following line AFTER your jQuery script tag

  `@include('clienttimezone::javascript')`
  
## Example

ClientTimezone is best used with Carbon to display the users current time.

```
$carbon = Carbon::now();
$carbon->addMinutes(ClientTimezone::getOffset());
```

## Authors

* **Kevin Orriss** - [Website](http://kevinorriss.com)

See also the list of [contributors](https://github.com/kevinorriss/clienttimezone/graphs/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](src/LICENSE) file for details
