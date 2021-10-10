<?php

namespace Drupal\ae_character\Form;

use Drupal\ae_core\Form\AeContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the character entity edit forms.
 */
class CharacterForm extends AeContentEntityForm {

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

}
