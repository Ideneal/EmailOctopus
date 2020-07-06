# EmailOctopus
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