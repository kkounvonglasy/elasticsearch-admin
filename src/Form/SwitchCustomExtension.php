<?php

namespace App\Form;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class SwitchCustomExtension extends AbstractTypeExtension
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['label_attr'] = ['class' => 'switch-custom'];
    }

    public static function getExtendedTypes(): iterable
    {
        return [CheckboxType::class];
    }
}
