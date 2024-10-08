# MailboxValidator CakePHP Email Validation Package

MailboxValidator CakePHP Email Validation Package  enables user to easily validate if an email address is valid, a type of disposable email or free email.

This package can be useful in many types of projects, for example

 - to validate an user's email during sign up
 - to clean your mailing list prior to email sending
 - to perform fraud check
 - and so on



## Installation

Open the terminal, locate to your project root and run the following command :

`composer require mailboxvalidator/mailboxvalidator-cakephp`


If you want to manually install this plugin, firstly clone the plugin folder to the plugins folder under your website project. After that, add the following line into your project's composer.json file like this:

```json
{
    ....
    "autoload": {
        "psr-4": {
            ....
            "MailboxValidatorCakePHP\\": "plugins/mailboxvalidator-cakephp/src/"
        }
    },
}
```

Remember to run this command to autoload our plugin:

```bash
composer dumpautoload
```



## Dependencies

An API key is required for this module to function.

Go to https://www.mailboxvalidator.com/plans#api to sign up for FREE API plan and you'll be given an API key.

After you get your API key, open your config/bootstrap.php and add the following line:
```php
Configure::write('MBV_API_KEY','PASTE_YOUR_API_KEY_HERE');
```



Functions
---------

### single (email_address)

Performs email validation on the supplied email address.

### disposable (email_address)

Check if the supplied email address is from a disposable email provider.

### free (email_address)

Check if the supplied email address is from a free email provider.



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
->setProvider('mbv', $MBV)
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
| 10000        | Missing parameter.    |
| 10001        | API key not found.    |
| 10002        | API key disabled.     |
| 10003        | API key expired.      |
| 10004        | Insufficient credits. |
| 10005        | Unknown error.        |



## Copyright

Copyright (C) 2018-2024 by MailboxValidator.com, support@mailboxvalidator.com