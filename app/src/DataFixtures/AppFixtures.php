<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Partner;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function loadPartners(ObjectManager $manager): void
    {
        for ($i = 0; $i <= 3; ++$i) {
            $partner = new Partner();
            $faker = Factory::create('fr_FR');
            $slugger = new AsciiSlugger();

            $partnerFirstname = $faker->firstname();
            $partnerLastname = $faker->lastname();
            $partnerCompany = $faker->company();

            /* For the sake of consistency */
            $partner->setName($partnerCompany);
            $partner->setEmail(
                strtolower($slugger->slug($partnerFirstname)).'.'.
                strtolower($slugger->slug($partnerLastname)).'@'.
                trim(strtolower($slugger->slug($partnerCompany)), ' ').'.'.
                $faker->tld()
            );

            $hashedPassword = $this->passwordHasher->hashPassword(
                $partner,
                'partnerPassword'
            );

            $partner->setPassword($hashedPassword);
            $partner->setPostalAddress(
                $faker->address());
            $partner->setPhoneNumber($faker->mobileNumber());

            $partner->setVatNumber($faker->vat());
            $partner->setSiret($faker->siret());

            $this->addReference('partner'.$i, $partner);

            $manager->persist($partner);
        }

        $manager->flush();
    }

    public function loadCustomers(ObjectManager $manager)
    {
        for ($i = 0; $i <= 20; ++$i) {
            $customer = new Customer();
            $faker = Factory::create('fr_FR');
            $slugger = new AsciiSlugger();

            $customerFirstname = $faker->firstname();
            $customerLastname = $faker->lastname();

            $designatedPartner = rand(0, 2);
            $partner = $this->getReference('partner'.$designatedPartner);

            $customer->setName($customerFirstname.' '.$customerLastname);
            $customer->setEmail(
                strtolower($slugger->slug($customerFirstname)).'.'.
                strtolower($slugger->slug($customerLastname)).'@'.
                $faker->freeEmailDomain());

            $hashedPassword = $this->passwordHasher->hashPassword(
                $customer,
                'customerPassword'
            );

            $customer->setPassword($hashedPassword);
            $customer->setPostalAddress(
                $faker->address()
            );
            $customer->setPhoneNumber($faker->mobileNumber());
            $customer->setReseller($partner);

            $this->addReference('customer'.$i, $customer);

            $manager->persist($customer);
        }

        $manager->flush();
    }

    public function loadProducts(ObjectManager $manager)
    {
        for ($i = 0; $i <= 20; ++$i) {
            $product = new Product();
            $faker = Factory::create('fr_FR');

            $designatedPartner = rand(0, 2);
            $partner = $this->getReference('partner'.$designatedPartner);

            $product->setModelName($faker->words(2, 6, true));
            $product->setBrand($faker->word());
            $product->setOperatingSystem($faker->word());
            $product->setCpu('Octo-Core 2.5Ghz');
            $product->setStorage('64');
            $product->setScreenSize((string) $faker->randomFloat(2, 5, 7));
            $product->setScreenType('Mini LED');
            $product->setPrice((string) $faker->randomFloat(2, 300, 1200));
            $product->setYear($faker->year('-4 years'));
            $product->setReseller($partner);

            $manager->persist($product);
        }

        $manager->flush();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadPartners($manager);
        $this->loadCustomers($manager);
        $this->loadProducts($manager);
    }
}
