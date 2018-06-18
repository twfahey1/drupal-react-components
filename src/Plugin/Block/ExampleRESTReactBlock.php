<?php

namespace Drupal\react_components\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ExampleRESTReactBlock' block.
 *
 * @Block(
 *  id = "example_rest_react_block",
 *  admin_label = @Translation("Example REST + React block"),
 * )
 */
class ExampleRESTReactBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#attached']['library'][] = 'react_components/example-rest-react-block';
    $build['example_rest_react_block']['#markup'] = '<div id="example-rest-react-block"></div>';

    return $build;
  }

}
