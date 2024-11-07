<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonInterface;

class Billing
{
    public function generateBill(Customer $customer): array
    {
        $products = $customer->getProducts();

        $billingData = [];
        foreach ($products as $product) {
            $billingData[] = [
                'product' => $product->getName(),
                'amount' => $product->getAmount(),
                'billing_date' => $product->getNextBillingDate()->format('Y-m-d')
            ];
            $product->calculateNextBillingDate();
        }

        return $billingData;
    }

    public function renewSubscription(Customer $customer): void
    {
        $products = $customer->getProducts();
        foreach ($products as $product) {
            $product->renewSubscription();
        }
    }
}
