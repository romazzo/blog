<?php


namespace UserBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\Role;
use UserBundle\Entity\User;
use UserBundle\Entity\UserAccount;


class UserLoad implements FixtureInterface, ContainerAwareInterface{

    private $container;

    public function load(ObjectManager $manager) {

        $roleRepo = $manager->getRepository('UserBundle:Role');

        $role = $roleRepo->findOneByRole('USER_ROLE');

        $user = new User();
        $encoder = $this->container->get('security.password_encoder');
        $password =  $encoder->encodePassword($user, '1');

        $user->setPassword($password);

        //$user->addRole($role);
        //var_dump($role);die();
        $user->setEmail('rs@i.ua');
        $user->setUsername('admin');
        //var_dump($user);die();

        $manager->persist($user);
        $manager->flush();

        $userAccount = new UserAccount();
        $userAccount->setFirstName('John')->setLastName('Doe');
        $userAccount->setBirthday( new \DateTime() );
        $userAccount->setGender('m');
        $userAccount->setUser($user);

        $manager->persist($userAccount);
        $manager->flush();

    }

    public function getOrder(){
        return 2;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


}