## Description:

API อั่งเปา True Wallet (Rework)

## Features:

<ul>
  <li>ตรวจสอบอั่งเปา</li>
  <li>ใช้อั่งเปา</li>
  <li>แสดงผลออกมาเป็น Json</li>
</ul>

## Example:

```php
<?php

/**
 * @author M4h45amu7x
 */

error_reporting(0);

require('./src/Voucher.php');

use M4h45amu7x\Voucher;

$voucher = new Voucher('0123456789', 'https://gift.truemoney.com/campaign/?v=yGIDVpsqsbFV1LQSMH');

var_dump($voucher->verify());
var_dump($voucher->redeem());

```
