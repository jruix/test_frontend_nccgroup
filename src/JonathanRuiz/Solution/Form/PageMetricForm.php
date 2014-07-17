<?php

namespace JonathanRuiz\Solution\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

/**
 * Creates a form for the PageMetricForm model
 */
class PageMetricForm {
    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @param FormFactory $formFactory
     */
    public function __construct(FormFactory $formFactory) {
        $this->formFactory = $formFactory;
    }

    /**
     * @return Form
     */
    public function create() {
        return $this->formFactory->createBuilder()
            ->add('url', 'text', [
                'constraints' => [
                    new NotBlank(),
                    new Url()
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('date', 'text', [
                'constraints' => [
                    new NotBlank(),
                    new Date()
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('responseTime', 'text', [
                'constraints' => [
                    new NotBlank()
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('save', 'submit', [
                'attr' => ['class' => 'btn btn-default'],
            ])
            ->getForm();
    }
}
