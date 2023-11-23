<?php

declare(strict_types=1);

namespace Database\Fixtures;

use App\Domain\Customer\Customer;
use App\Domain\Order\Order;
use App\Domain\Product\Product;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderFixture extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder(): int
	{
		return 3;
	}

	public function load(ObjectManager $manager): void
	{
		/** @var Customer $customer */
		$customer = $this->getReference('customer');

		/** @var Product $product */
		$product = $this->getReference('product');


		$order = new Order();
		$order->setCustomer($customer);
		$order->setProduct($product);
		$order->setPrice($product->getPrice());
		$order->setCreatedAt();

		$manager->persist($order);
		$manager->flush();
	}
}
