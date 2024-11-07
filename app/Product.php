<?php
namespace App;

use Carbon\Carbon;
use Carbon\CarbonInterface;

class Product {

    /**
     * @var string id of Product
     */
  private string $id;

  private CarbonInterface $billingStartDate;
  private CarbonInterface $nextBillingDate;

  public function __construct(private string $name,  private int $price, private string $subscriptionType)
  {
    $this->id = uniqid();
    $this->renewSubscription();
  }

  public function getId(): string
  {
    return $this->id;
  }

  public function getAmount(): float
  {
      return strtolower($this->subscriptionType) === 'monthly' ? round($this->price / 12, 2) : $this->price;
  }

  public function getName(): string
  {
      return $this->name;
  }

  public function getNextBillingDate(): CarbonInterface
  {
      return $this->nextBillingDate;
  }

  public function calculateNextBillingDate(): Carbon|CarbonInterface
  {
      if ($this->billingStartDate->clone()->addYear() < Carbon::now()) {
          return $this->renewSubscription();
      }

    if (strtolower($this->subscriptionType) === 'monthly') {
      return $this->nextBillingDate->addMonth();
  }
      return $this->nextBillingDate = $this->billingStartDate->copy()->addYear();
  }

  public function renewSubscription(): void
  {
      $this->billingStartDate = Carbon::now();
      $this->nextBillingDate = $this->billingStartDate->copy();
      $this->calculateNextBillingDate();
  }
}

