<?php

namespace App\Commands;

use App\Billing;
use App\Customer;
use App\Product;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

use function Termwind\render;

class BillingCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'billing';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $customerName = $this->ask('What is the customer name?');
            $productName = $this->ask('What is the product name?');
            $productPrice = $this->ask('What is the product price?');
            $subscriptionType = $this->choice('What is the product subscription Type?', [
                'Monthly' => 'Monthly',
                'Annually' => 'Annually',
            ]);

            $customer = new Customer($customerName);
            $product = new Product($productName, $productPrice, $subscriptionType);
            $customer->subscribe($product);
            $billing = new Billing();

            $data = $billing->generateBill($customer);

            $this->line("Generating next bill for {$customer->getName()}...");
            foreach ($data as $item) {
                $this->line("Product Name: {$item['product']}");
                $this->line("Amount: {$item['amount']}");
                $this->line("Next Billing Date: {$item['billing_date']}");
            }
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }


        return;
    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
