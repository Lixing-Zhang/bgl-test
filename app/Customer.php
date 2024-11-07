<?php
namespace App;
class Customer
{
    public function __construct(private string $name)
    {

    }

    public function getName(): string
    {
        return $this->name;
    }

    /***
     * @var array $prouducts
     */
    private array $prouducts = [];

    public function subscribe(Product $product): void
    {
        $this->prouducts[] = $product;
    }

    public function unsubscribe(Product $product): void
    {
        $this->prouducts = array_filter($this->prouducts, function (Product $p) use ($product) {
            return $p->getId() !== $product->getId();
        });
    }

    /**
     * @return array<Product>
     */
    public function getProducts(): array
    {
        return $this->prouducts;
    }
}
