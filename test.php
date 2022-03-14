<?php

/**
 * @author M4h45amu7x
 */

error_reporting(0);

use M4h45amu7x\Voucher;

require('src/Voucher.php');

$voucher = new Voucher('0123456789', 'https://gift.truemoney.com/campaign/?v=yGIDVpsqsbFV1LQSMH');

if ($_GET['action'] == 'verify')
    die($voucher->verify());
else if ($_GET['action'] == 'redeem')
    die($voucher->redeem());
