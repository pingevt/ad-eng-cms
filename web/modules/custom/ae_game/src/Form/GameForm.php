<?php

namespace Drupal\ae_game\Form;

use Drupal\ae_core\Form\AeContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the game entity edit forms.
 */
class GameForm extends AeContentEntityForm {

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
      $this->messenger()->addStatus($this->t('New game %label has been created.', $message_arguments));
      $this->logger('ae_game')->notice('Created new game %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The game %label has been updated.', $message_arguments));
      $this->logger('ae_game')->notice('Updated new game %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.game.canonical', ['game' => $entity->id()]);
  }

}
