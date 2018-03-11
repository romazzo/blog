<?php


namespace UserBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\Role;
use Doctrine\Common\DataFixtures\FixtureInterface;


class RoleLoad implements FixtureInterface{

    public function load(ObjectManager $manager)
    {
        $roleRepo = $manager->getRepository(Role::class);
        $role = $roleRepo->findByRole('ROLE_USER');
        //var_dump($role);die();
        if(!$role){
            $role = new Role();

            $role->setName('ROLE_USER');
            $role->setRole('ROLE_USER');

            $manager->persist($role);
            $manager->flush();
        }
    }

    public function getOrder(){
        return 1;
    }
} 