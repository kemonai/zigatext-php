#Sample calls

Assumes that you already installed and configured Kemonai\Zigatext-php. And that you have created and
configured the $zigatext object as you want. Check [README](README.md) for details.

``` php
// balance
$zigatext->balance->check();

// month
$zigatext->month->list();

// timezone
$zigatext->timezone->list();

// message
$zigatext->message->fetch(1);
$zigatext->message->getExtras(1);

// newsletter
$zigatext->newsletter->list();

// birthday
$zigatext->birthday->getGroupList();

```
