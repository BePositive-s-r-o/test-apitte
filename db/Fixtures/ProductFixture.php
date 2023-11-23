<?php

declare(strict_types=1);

namespace Database\Fixtures;

use App\Domain\Product\Product;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends AbstractFixture implements OrderedFixtureInterface
{

	public function getOrder(): int
	{
		return 2;
	}

	public function load(ObjectManager $manager): void
	{

		for ($i = 0; $i < 10; $i++) {
			$product = new Product();
			$product->setName(sprintf('Product %s', $this->faker->word()));
			$product->setPrice($this->faker->numberBetween(100, 10000));
			$product->setEan($this->faker->ean13());

			$manager->persist($product);

		}

		$manager->flush();

		$this->addReference('product', $product);
	}
}
