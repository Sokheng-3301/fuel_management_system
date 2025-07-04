<?php

const CASH = 1;
const CREDIT_DEBIT_CARDS = 2;
const MOBILE_PAYMENTS = 3;
const BANK_TRANSFERS = 4;

const PAYMENT_METHODS = [
    self::CASH => ['name' => 'Cash', 'icon' => 'bi-cash-coin'], // Replace with your icon
    self::CREDIT_DEBIT_CARDS => ['name' => 'Credit/Debit Cards', 'icon' => 'bi-cash-coin'], // Replace with your icon
    self::MOBILE_PAYMENTS => ['name' => 'Mobile Payments', 'icon' => 'bi-cash-coin'], // Replace with your icon
    self::BANK_TRANSFERS => ['name' => 'Bank Transfers', 'icon' => 'bi-cash-coin'], // Replace with your icon
];

function getAllPaymentMethods() {
    $methods = [];
    foreach (PAYMENT_METHODS as $id => $data) {
        $methods[] = [
            'id' => $id,
            'name' => $data['name'],
            'icon' => $data['icon'],
        ];
    }
    return $methods; // Return the methods array directly
}
