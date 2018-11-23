# MailboxValidator CakePHP Email Validation Package

MailboxValidator CakePHP Email Validation Package provides an easy way to call the MailboxValidator API which validates if an email address is valid.



## Installation

Open the terminal, locate to your project root and run the following command :

`composer require MailboxValidatorCakePHP`



If you want to manually install this plugin, firstly clone the plugin folder to the plugins folder under your website project. After that, include the following line in config/bootstrap.php:

```php
Plugin::load('MailboxValidatorCakePHP', ['bootstrap' => false, 'routes' => true, 'autoload' => true]);
```



## Dependencies

An API key is required for this module to function.

Go to https://www.mailboxvalidator.com/plans#api to sign up for FREE API plan and you'll be given an API key.

After you get your API key, open your config/bootstrap.php and add the following line:
```php
Configure::write('MBV_API_KEY','PASTE_YOUR_API_KEY_HERE');
```




## Usage

Include this line in any form controller that handle validation:

```php
use MailboxValidatorCakePHP\Controller\MailboxValidatorController;
```

In any form validation method, before the $validator declare this line:

```php
$MBV = new MailboxValidatorController();
```

Add the below line right after the $validator:

```php
->provider('mbv', $MBV)
```

After that, add a new rule to your form field. For example, if you want to validate the disposable email, your rule will be like this:

```php
->add('email', 'disposable', [
        'rule' => 'disposable',
		'provider' => 'mbv',
        'message' => 'Invalid email address. Please enter a non-disposable email address.',
])
```

The validators available to validate the email are: single, free and disposable. Each validator validate the email by using MailboxValidator API. For more information, you can visit [Single Validation API](https://www.mailboxvalidator.com/api-single-validation), [Disposable Email API](https://www.mailboxvalidator.com/api-email-disposable) and [Free Email API](https://www.mailboxvalidator.com/api-email-free). 



## Errors

| error_code | error_message         |
| ---------- | --------------------- |
| 100        | Missing parameter.    |
| 101        | API key not found.    |
| 102        | API key disabled.     |
| 103        | API key expired.      |
| 104        | Insufficient credits. |
| 105        | Unknown error.        |



## Copyright

Copyright (C) 2018 by MailboxValidator.com, support@mailboxvalidator.com