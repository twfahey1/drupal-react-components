<?php

namespace Drupal\react_components\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityManagerInterface;

/**
 * Provides a 'HelloWorldReactBlock' block.
 *
 * @Block(
 *  id = "hello_world_react_block",
 *  admin_label = @Translation("Hello world react block"),
 * )
 */
class HelloWorldReactBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Entity\EntityManagerInterface definition.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityManager;

  /**
   * Constructs a new HelloWorldReactBlock object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    EntityManagerInterface $entity_manager
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityManager = $entity_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['what_is_your_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('What is your name?'),
      '#description' => $this->t('Hello, what is your name?'),
      '#default_value' => $this->configuration['what_is_your_name'],
      '#maxlength' => 64,
      '#size' => 32,
      '#weight' => '0',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['what_is_your_name'] = $form_state->getValue('what_is_your_name');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#attached']['drupalSettings']['hello_world_react_block']['test'] = $this->configuration['what_is_your_name'];
    $build['#attached']['library'][] = 'react_components/hello-world-block';
    $build['hello_world_react_block_what_is_your_name']['#markup'] = '<div id="hello-world-react-block"></div>';

    return $build;
  }

}
