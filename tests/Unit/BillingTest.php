<?php

use App\Billing;
use App\Customer;
use App\Product;
use Carbon\Carbon;

test('it can generate billing', function () {

    $now = Carbon::now();
    $product1 = new Product('a', 100, 'monthly');
    $product2 = new Product('b', 100, 'annually');

    $customer = new Customer('Jack');

    $customer->subscribe($product1);

    $billing = new Billing();

    Carbon::setTestNow($now->clone()->addMonth()->addDay());

    $data = $billing->generateBill($customer);
    expect($data)->toBe([
        [
            'product' => 'a',
            'amount' => 8.33,
            'billing_date' => $now->clone()->addMonth()->format('Y-m-d'),
        ]
    ]);
});

test('it can generate billing 2', function () {

    $now = Carbon::now();
    $product1 = new Product('b', 100, 'annually');

    $customer = new Customer('Jack');

    $customer->subscribe($product1);

    $billing = new Billing();

    Carbon::setTestNow($now->clone()->addMonth()->addDay());

    $data = $billing->generateBill($customer);
    expect($data)->toBe([
        [
            'product' => 'b',
            'amount' => 100.0,
            'billing_date' => $now->clone()->addYear()->format('Y-m-d'),
        ]
    ]);
});
