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
