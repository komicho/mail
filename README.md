# Komicho Mail
You can send electronic mail or more using the templates

### Install via composer

Add orm to composer.json configuration file.
```
$ composer require komicho/mail
```

And update the composer
```
$ composer update
```
    
## code
```php
require 'vendor/autoload.php';

use komicho\mail;

$mail = new mail;

$mail -> from('from@mail.com');
$mail -> to('to@mail.com');
$mail -> subject('subject');
$mail -> tem('tems/default');
$mail -> data([
    'name' => 'karim',
    'pass' => '132456',
    'loop' => ['users','admin']
]);
$mail -> demo();
```

## tem
Choose the template file
```php
$mail -> tem('tems/default');
```
    
## demo
Certain before transmission
```php
$mail -> demo();
```
    
## send
To Send Email use
```php
$mail -> send();
```

## out
Output the result as a array
```php
$res = $mail -> out();
echo '<pre>';
print_r($res);
```
    
## example
We establish the code to send mail and file template

file template : tems/default.php
```html
<html>
<body>
    <section style="width: auto; background: #f5f5f5;border-top: 5px solid #09c; padding: 25px;">
        <h1>username : <?=$name?></h1>
        <h2>password : <?=$pass?></h2>
        <ul>
            <?php foreach($loop as $v): ?>
            <li><?=$v?></li>
            <?php endforeach; ?>
        </ul>
    </section>
</body>
</html>
```

## some examples
```php
require 'vendor/autoload.php';

use komicho\mail;

$mail = new mail;

$mail -> from('from@mail.com');
$mail -> to('to@mail.com');
$mail -> subject('subject');
$mail -> tem('tems/default');
$mail -> data([
    'name' => 'karim',
    'pass' => '132456',
    'loop' => ['users','admin']
]);
$mail -> send();
$res = $mail->out();
echo '<pre>';
print_r($res);
```
### Another example
```php
require 'vendor/autoload.php';

use komicho\mail;

$mail = new mail;

$res = $mail
    -> from('from@mail.com')
    -> to('to@mail.com')
    -> subject('subject')
    -> tem('tems/default')
    -> data([
        'name' => 'karim',
        'pass' => '132456',
        'loop' => ['users','admin']
    ])
    -> demo()
    -> out();
echo '<pre>';
print_r($res);
```