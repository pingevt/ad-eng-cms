<?php

namespace Drupal\ae_character\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the character entity edit forms.
 */
class CharacterForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New character %label has been created.', $message_arguments));
      $this->logger('ae_character')->notice('Created new character %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The character %label has been updated.', $message_arguments));
      $this->logger('ae_character')->notice('Updated new character %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.character.canonical', ['character' => $entity->id()]);
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    // Use the ae_character edit form template.
    $form['#theme'][] = 'ae_character_edit_form';

    // Use the ae_character form layout library.
    $form['#attached']['library'] = ['ae_character/drupal.ae_character'];

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
        'class' => ['ae-character-form-author'],
      ],
      '#attached' => [
        'library' => ['ae_character/drupal.ae_character'],
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
