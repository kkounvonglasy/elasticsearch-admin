<?php

namespace App\Form;

use App\Model\ElasticsearchSlmPolicyModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreateSlmPolicyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fields = [];

        if (false == $options['update']) {
            $fields[] = 'name';
        }
        $fields[] = 'snapshot_name';
        $fields[] = 'repository';
        $fields[] = 'indices';
        $fields[] = 'schedule';
        $fields[] = 'expire_after';
        $fields[] = 'min_count';
        $fields[] = 'max_count';
        $fields[] = 'ignore_unavailable';
        $fields[] = 'partial';
        $fields[] = 'include_global_state';

        foreach ($fields as $field) {
            switch ($field) {
                case 'name':
                    $builder->add('name', TextType::class, [
                        'label' => 'name',
                        'required' => true,
                        'constraints' => [
                            new NotBlank(),
                        ],
                        'help' => 'help_form.slm_policy.name',
                        'help_html' => true,
                    ]);
                    break;
                case 'snapshot_name':
                    $builder->add('snapshot_name', TextType::class, [
                        'label' => 'snapshot_name',
                        'required' => true,
                        'constraints' => [
                            new NotBlank(),
                        ],
                        'help' => 'help_form.slm_policy.snapshot_name',
                        'help_html' => true,
                    ]);
                    break;
                case 'repository':
                    $builder->add('repository', ChoiceType::class, [
                        'placeholder' => '-',
                        'choices' => $options['repositories'],
                        'choice_label' => function ($choice, $key, $value) use ($options) {
                            return $options['repositories'][$key];
                        },
                        'choice_translation_domain' => false,
                        'label' => 'repository',
                        'required' => true,
                        'constraints' => [
                            new NotBlank(),
                        ],
                        'attr' => [
                            'data-break-after' => 'yes',
                        ],
                        'help' => 'help_form.slm_policy.repository',
                        'help_html' => true,
                    ]);
                    break;
                case 'indices':
                    $builder->add('indices', ChoiceType::class, [
                        'multiple' => true,
                        'choices' => $options['indices'],
                        'choice_label' => function ($choice, $key, $value) use ($options) {
                            return $options['indices'][$key];
                        },
                        'choice_translation_domain' => false,
                        'label' => 'indices',
                        'required' => false,
                        'attr' => [
                            'size' => 10
                        ],
                        'help' => 'help_form.slm_policy.indices',
                        'help_html' => true,
                    ]);
                    break;
                case 'schedule':
                    $builder->add('schedule', TextType::class, [
                        'label' => 'schedule',
                        'required' => true,
                        'constraints' => [
                            new NotBlank(),
                        ],
                        'help' => 'help_form.slm_policy.schedule',
                        'help_html' => true,
                    ]);
                    break;
                case 'expire_after':
                    $builder->add('expire_after', TextType::class, [
                        'label' => 'expire_after',
                        'required' => false,
                        'help' => 'help_form.slm_policy.expire_after',
                        'help_html' => true,
                    ]);
                    break;
                case 'min_count':
                    $builder->add('min_count', IntegerType::class, [
                        'label' => 'min_count',
                        'required' => false,
                        'help' => 'help_form.slm_policy.min_count',
                        'help_html' => true,
                    ]);
                    break;
                case 'max_count':
                    $builder->add('max_count', IntegerType::class, [
                        'label' => 'max_count',
                        'required' => false,
                        'help' => 'help_form.slm_policy.max_count',
                        'help_html' => true,
                    ]);
                    break;
                case 'ignore_unavailable':
                    $builder->add('ignore_unavailable', CheckboxType::class, [
                        'label' => 'ignore_unavailable',
                        'required' => false,
                        'help' => 'help_form.slm_policy.ignore_unavailable',
                        'help_html' => true,
                    ]);
                    break;
                case 'partial':
                    $builder->add('partial', CheckboxType::class, [
                        'label' => 'partial',
                        'required' => false,
                        'help' => 'help_form.slm_policy.partial',
                        'help_html' => true,
                    ]);
                    break;
                case 'include_global_state':
                    $builder->add('include_global_state', CheckboxType::class, [
                        'label' => 'include_global_state',
                        'required' => false,
                        'help' => 'help_form.slm_policy.include_global_state',
                        'help_html' => true,
                    ]);
                    break;
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ElasticsearchSlmPolicyModel::class,
            'repositories' => [],
            'indices' => [],
            'update' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'data';
    }
}
