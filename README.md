# WP Nonce OOP - an OOP wrapper for WordPress Nonces
--------

WP Nonce OOP is a Composer package wrapping the functionality of WordPress Nonces the OOP way


## Usage
--------

After downloading the source code run _composer install_

Add the following code to your theme's functions.php or to your plugin's main file

```php

require __DIR__ . '/vendor/autoload.php';

```


### Init OOPNonce:

```php
$nonce = new OOPNonce();
```


#### Adding a nonce to a URL

```php
$complete_url = $nonce->url( $bare_url, 'trash-post_'.$post->ID );
```


#### Adding a nonce to a form

By default this generates two hidden fields, one whose value is the nonce and one whose value is
the current URL (the referrer), and it echoes the result

```php
$nonce->field( 'delete-comment_' . $comment_id );
```


#### Creating a nonce for use in some other way

This simply returns the nonce itself. For example: 295a686963

```php
$nonce->create( 'my-action_'.$post->ID );
```


#### Verifying a nonce passed from an admin screen

This call checks the nonce and the referrer, and if the check fails it takes the normal
action (terminating script execution with a "403 Forbidden" response and an error message).

```php
$nonce->check_admin_referer( 'delete-comment_' . $comment_id );
```


#### Verifying a nonce passed using AJAX

Similar to admin screen nonce

```php
$nonce->check_ajax_referer( 'delete-comment_' . $comment_id );
```


#### Verifying a nonce passed in some other context

To verify a nonce passed in some other context, call verify() function specifying the nonce and the string representing the action.

```php
$nonce->verify( $_REQUEST['my_nonce'], 'process-comment'.$comment_id );
```


#### Modifying the nonce lifetime

By default, a nonce has a lifetime of one day. After that, the nonce is no longer valid even if it matches the action string.
To change the lifetime, call the set_life($seconds) function specifying the lifetime in seconds.
For example, to change the lifetime to four hours:

```php
$nonce->set_life( 4 * HOUR_IN_SECONDS );
```


#### Display 'Are you sure you want to do this?' message

```php
$nonce->ays();
```


--------


## Tests

**Install and run PHPUnit**



## License
--------
MIT


## Credits
-------

* Author: **Sergey Pozhilov** - http://pozhilov.com
