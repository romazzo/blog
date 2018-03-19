<?php

namespace UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Form\Models\RegisterUserModel;

class UserAccountType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', new TextType(),['label' => 'First Name'])
                ->add('lastName', new TextType(),['label' => 'Last Name'])
                ->add('username', new TextType(),['label' => 'Username'])
                ->add('email', new RepeatedType(), [
                    'type' => new EmailType(),
                    'invalid_message' => 'The email add address invalid.',
                    'options' => ['attr' => ['class' => 'email-field' ]],
                    'required' => true,
                    'first_options' => ['label' => 'Email'],
                    'second_options' => ['label' => 'Repeat Email'],
                ])
                ->add('password', new RepeatedType(), [
                    'type' => new PasswordType(),
                    'invalid_message' => 'The password fields must match.',
                    'options' => ['attr' => [ 'class' => 'password-field']],
                    'required' => true,
                    'first_options' => ['label' => 'Password' ],
                    'second_options' => ['label' => 'Repeat Password'],
                ])
                ->add('birthday', new BirthdayType(), [
                    'label' => 'Birthday'
                ])
                ->add('gender', new CountryType(), [
                    'label' => 'Region'
                ])
                ->add('submit',new SubmitType(),[
                    'label' => 'Register'
                ]);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            //'data_class' => 'UserBundle\Form\Models\RegisterUserModel'
            //'data_class' => new RegisterUserModel(),
            'data_class' => RegisterUserModel::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_useraccount';
    }


}
