<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EmailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('recipientAddress', TextType::class)
            ->add('replyTo', TextType::class, array('required' => false))
            ->add('cc', TextType::class, array('required' => false))
            ->add('bcc', TextType::class, array('required' => false))
            ->add('attachment', FileType::class, array('required' => false))
            ->add('subject', TextType::class)
            ->add('body', TextType::class)
            ->add('altBody', TextType::class, array('required' => false))
            ->add('send', SubmitType::class, array('label' => 'Send'))
        ;
    }
}
?>
