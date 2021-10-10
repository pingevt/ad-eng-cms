<?php

namespace Drupal\ae_core\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the race entity edit forms.
 */
class AeContentEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    // Use the ae_core edit form template.
    $form['#theme'][] = 'ae_content_edit_form';

    // Use the ae_core form layout library.
    $form['#attached']['library'] = ['ae_core/drupal.ae_core'];

    // Create the advanced element if it doesn't exist.
    if (!isset($form['advanced'])) {
      $form['advanced'] = [
        '#type' => 'container',
        '#weight' => 99,
      ];
    }
    else {
      // Make 'advanced' a container instead of vertical_tabs.
      $form['advanced']['#type'] = 'container';
    }

    $form['status']['#group'] = 'footer';

    // Add the style class to tell the admin theme how to style it.
    $form['advanced']['#attributes']['class'][] = 'entity-meta';

    $form['author'] = [
      '#type' => 'details',
      '#title' => $this->t('Authoring information'),
      '#group' => 'advanced',
      '#attributes' => [
        'class' => ['ae-core-form-author'],
      ],
      '#attached' => [
        'library' => ['ae_core/drupal.ae_core'],
      ],
      '#weight' => 90,
      '#optional' => TRUE,
    ];

    if (isset($form['uid'])) {
      $form['uid']['#group'] = 'author';
    }

    if (isset($form['created'])) {
      $form['created']['#group'] = 'author';
    }

    return $form;
  }

}
