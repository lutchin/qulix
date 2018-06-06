<?php
namespace Qulix\RecyclingBundle\Form;


use Qulix\RecyclingBundle\Entity\Crude;
use Symfony\Component\OptionsResolver\OptionsResolver;
// forms type
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CrudeType extends AbstractType
{
	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder

			->add(
				'population',
				ChoiceType::class,
				[
					'choices'  => [
						'{{ type.population }}' => null

					],
					'choices_as_values' => true,'multiple'=>false,'expanded'=>true,
					'attr' =>
						[
							'data-ng-repeat' => "type in population",
							'data-ng-click' => 'myFunc(type)',


						],
					'label' => false
				]
			)
			->add(
				'name',
				ChoiceType::class,
				[
					'choices'  => [
					'{{ type.crude }}' => null

				],
					'choices_as_values' => true,'multiple'=>false,'expanded'=>true,
					'attr' =>
						[
							'data-ng-repeat' => "type in crude",

						],
					'label' => false
				]
			)
			->add(
				'save',
				SubmitType::class,
				[
					'label' => 'Сдать вторсырье',
					'attr' => [
						'data-ng-click' => 'save(value)',
						'class' => 'btn btn-secondary'
					]
				]


			);
	}

	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Qulix\RecyclingBundle\Entity\Crude'
		));
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix()
	{
		return 'Crude';
	}


}
