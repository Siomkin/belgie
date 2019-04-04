<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\EquipmentType;
use App\Entity\Organization;
use App\Entity\Region;
use App\Entity\Street;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        //$this->loadUsers($manager);
        $this->loadEquipmentTypes($manager);
        $this->loadRegions($manager);
        $this->loadCities($manager);
        $this->loadStreets($manager);
        $this->loadOrganization($manager);
    }

    private function loadUsers(ObjectManager $manager): void
    {
        foreach ($this->getUserData() as [$username, $password, $roles]) {
            $user = new User();
            $user->setUsername($username);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            $user->setRoles($roles);

            $manager->persist($user);
            $this->addReference($username, $user);
        }

        $manager->flush();
    }

    private function loadEquipmentTypes(ObjectManager $manager): void
    {
        foreach ($this->getEquipmentTypesData() as $index => $name) {
            $equipmentType = new EquipmentType();
            $equipmentType->setName($name);

            $manager->persist($equipmentType);
            $this->addReference('equipmentType-'.$name, $equipmentType);
        }

        $manager->flush();
    }

    private function loadRegions(ObjectManager $manager): void
    {
        foreach ($this->getRegionsData() as $index => $name) {
            $region = new Region();
            $region->setName($name);

            $manager->persist($region);
            $this->addReference('region-'.$name, $region);
        }

        $manager->flush();
    }

    private function loadCities(ObjectManager $manager): void
    {
        foreach ($this->getCitiesData() as $index => $name) {
            $city = new City();
            $city->setName($name);

            $manager->persist($city);
            $this->addReference('city-'.$name, $city);
        }

        $manager->flush();
    }

    private function loadStreets(ObjectManager $manager): void
    {
        foreach ($this->getStreets() as $index => $name) {
            $street = new Street();
            $street->setName($name);

            $manager->persist($street);
            $this->addReference('street-'.$name, $street);
        }

        $manager->flush();
    }

    private function loadOrganization(ObjectManager $manager): void
    {
        $organization = new Organization();
        $organization->setName('Test organization');

        $manager->persist($organization);
        $this->addReference('organization-1', $organization);

        $organization2 = new Organization();
        $organization2->setName('Test organization2');

        $manager->persist($organization2);
        $this->addReference('organization-2', $organization2);

        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            // $userData = [$username, $password, $roles];
            ['belgie', 'password', ['ROLE_ADMIN']],
            //     ['belgie_user', 'password', ['ROLE_USER']]
        ];
    }

    private function getEquipmentTypesData(): array
    {
        return [
            'коммутатор',
            'маршрутизатор',
            'модем',
            'мультиплексор',
            'оптический приёмник',
            'оптический передатчик',
            'оптический усилитель',
            'модуль удаленного тестирования',
            'оптический транспортный терминал',
            'оптический ретранслятор в линию',
            'блок соединения каналов',
            'сервер',
            'репитер',
            'концентратор',
        ];
    }

    private function getRegionsData(): array
    {
        return [
            'Брестская, Бресткский',
            'Витебская, Витебский',
            'Гомельская, Гомельский',
            'Гродненская, Гродненский',
            'Могилевская, Могилевский',
            'Минская, Минский',
        ];
    }

    private function getCitiesData(): array
    {
        return [
            'Брест',
            'Витебск',
            'Гомель',
            'Гродно',
            'Могилев',
            'Минск',
        ];
    }

    private function getStreets(): array
    {
        return [
            '1-й Южный пер.',
            '1-я Коллективная',
            '2-й Крутой',
            '3-й Октябрьский',
            '4-й Октябрьский',
            'Автомобильная',
            'Болдина ',
            'Большая Машековская ',
            'Бонч-Бруевича',
            'Буденного',
            'Буянова',
            'Бялыницкого-Бирули',
            'Вишневецкого',
            'Воровского',
            'Габровская',
            'Гагарина',
            'Гастелло',
            'Грюндвальская ',
            'Дзержинского',
            'Димитрова пр-т',
            'Днепровский',
            'Добролюбова',
            'Залуцкого',
            'Заслонова',
            'Златоустовского',
            'Ивана Франко',
            'Индустриальная',
            'Карабановская',
            'Карла Маркса',
            'Кедровая',
            'Кобринская',
            'Комиссариатский ',
            'Комсомольская',
            'Королева',
            'Космонавтов',
            'Крыленко',
            'Кулешова',
            'Курако',
            'Ленина',
            'Ленинская',
            'Лепешинского',
            'Мельникова',
            'Менжинского',
            'Мещанские полосы',
            'Миколуцкого',
            'Мира',
            'Миронова',
            'Народного ополчения',
            'Непокоренных',
            'Новицкого',
            'Островского',
            'Первомайская',
            'Пионерская',
            'Пржевальского',
            'Промышленная',
            'Пушкинский',
            'Пысина',
            'Рогачевская',
            'Романова',
            'Свердлова',
            'Симонова',
            'Советская пл.',
            'Строителей',
            'Тани Карпинской',
            'Терехина',
            'Тимирязевская',
            'Тишки Гартного',
            'Урицкого',
            'Урожайный пер.',
            'Успенского',
            'Челюскинцев',
            'Черняховского',
            'Чехова',
            'Чигринова',
            'Шмидта',
            'Шуберта пер.',
            'Юбилейный',
            'Южная',
            'Якубовского',
            'Ямницкая',
        ];
    }
}
