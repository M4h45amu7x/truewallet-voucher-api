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
use M4h45amu7x\Voucher;

require('src/Voucher.php');

$voucher = new Voucher('0123456789', 'https://gift.truemoney.com/campaign/?v=yGIDVpsqsbFV1LQSMH');

if ($_GET['action'] == 'verify')
    die($voucher->verify());
else if ($_GET['action'] == 'redeem')
    die($voucher->redeem());
```
