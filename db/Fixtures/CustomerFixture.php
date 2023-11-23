<?php

declare(strict_types=1);

namespace Database\Fixtures;

use App\Domain\Customer\Customer;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CustomerFixture extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder(): int
	{
		return 1;
	}


	public function load(ObjectManager $manager): void
	{

		for ($i = 0; $i < 10; $i++){
			$customer = new Customer();
			$customer->setName($this->faker->firstName);
			$customer->setSurname($this->faker->lastName);
			$customer->setEmail($this->faker->email);
			$customer->setPhone($this->faker->phoneNumber);
			$manager->persist($customer);

		}

		$manager->flush();

		$this->addReference('customer', $customer);
	}
}
