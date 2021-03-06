<?php

$classes = [
    'ActionType',
    'CarruerType',
    'ClearanceMark',
    'DeviceType',
    'Donation',
    'EncryptType',
    'ExtraPaymentInfo',
    'InvoiceState',
    'InvType',
    'PaymentMethod',
    'PaymentMethodItem',
    'PeriodType',
    'PrintMark',
    'TaxType',
    'UseRedeem',
];

foreach ($classes as $class) {
    class_alias($class, 'PayumTW\Allpay\Bridge\Allpay\\'.$class);
}
