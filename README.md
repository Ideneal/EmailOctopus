# EmailOctopus

[![Packagist](https://img.shields.io/packagist/v/ideneal/emailoctopus.svg?style=flat-square)](https://packagist.org/packages/ideneal/emailoctopus)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://raw.githubusercontent.com/Ideneal/EmailOctopus/master/LICENSE)
[![Travis branch](https://img.shields.io/travis/Ideneal/EmailOctopus/master.svg?style=flat-square)](https://travis-ci.org/Ideneal/EmailOctopus)
[![Codacy branch](https://img.shields.io/codacy/grade/a5904d0ecbbf400691f4f3ac03e3649e/master.svg?style=flat-square)](https://www.codacy.com/app/ideneal-ztl/EmailOctopus)

A PHP wrapper for [EmailOctopus](https://emailoctopus.com/) email marketing service.

For more information on how to set up your account, read the [API docs](http://emailoctopus.com/api-documentation).

## Installation

To add the library in your project just type the following:

```shell script
composer require ideneal/emailoctopus
```

## Usage

First you need to retrieve the API key as explained in [API docs](http://emailoctopus.com/api-documentation).
After that you could initialize the wrapper by adding the following code:

```php
use Ideneal\EmailOctopus\EmailOctopus;

$emailOctopus = new EmailOctopus('YOUR-API-KEY');
```

Now you can perform the CRUD operations the API provides using the `$emailOctopus` instance.

### Create new list

```php
use Ideneal\EmailOctopus\Entity\MailingList;

$list = new MailingList();
$list->setName('My cool list');

$emailOctopus->createMailingList($list);
```

### Add a contact to the previous list

```php
use Ideneal\EmailOctopus\Entity\Contact;

$contact = new Contact();
$contact
    ->setEmail('john.doe@mail.com')
    ->setFirstName('John')
    ->setLastName('Doe')
;

$emailOctopus->createContact($contact, $list);
``` 

### Retrieve all contacts from the previous list

```php
$emailOctopus->getContactsByMailingList($list);
```

### Remove contact from the previous list

```php
$contact = $emailOctopus->getContactByMailingList('CONTACT-ID', $list);
$emailOctopus->deleteContact($contact, $list);
```

## License

The repository is available as open source under the terms of the [MIT License](./LICENSE).