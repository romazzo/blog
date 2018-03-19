<?php


namespace UserBundle\Form\Models;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use UserBundle\Entity\User;
use UserBundle\Entity\UserAccount;


/**
 * @property mixed getUserHand
 */
class RegisterUserModel{

    //если есть гетеры и сеттеры то свойства положено делать приватными
    private $username;

    public $firstName;

    public $lastName;

    public $email;

    public $password;

    public $birthday;

    public $gender;

    public $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }


    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function getUserHandler(){
        $user = new User();
        $account = new UserAccount();
        $account->setFirstName($this->firstName);
        $account->setLastName($this->lastName);
        $account->setBirthday($this->birthday);
        $account->setGender($this->gender);
        $user->setEmail($this->email);
        $user->setAccount($account);
        $user->setUsername($this->username);

        //$encoder = $this->container->get('security.password_encoder');
        $password =  $this->encoder->encodePassword($user, $this->password);

        $user->setPassword($password);
        return $user;
    }



} 