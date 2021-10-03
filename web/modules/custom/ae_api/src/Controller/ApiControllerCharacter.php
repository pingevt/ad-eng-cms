<?php

namespace Drupal\ae_api\Controller;

use Drupal\bc_api_base\Controller\ApiControllerBase;

/**
 * Example API Controller Class.
 *
 * @ApiDoc(
 *   params = {
 *     @ApiParam(
 *       name = "status",
 *       type = "bool",
 *       description = "Filter on node status.",
 *       default = "TRUE",
 *     ),
 *   }
 * )
 */
class ApiControllerCharacter extends ApiControllerBase {

  /**
   * {@inheritdoc}
   */
  public function getApiCacheTime($id = NULL) {
    // Parent method looks at settings form and takes into account list or
    // detail.
    return 0;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheId() {
    $cid = "ae_characters";

    if (!empty($this->params)) {
      $cid .= ":" . implode(":", $this->params);
    }

    $cid .= ":page-" . $this->page;
    $cid .= ":limit-" . $this->limit;

    return $cid;
  }

  /**
   * {@inheritdoc}
   */
  public function initCacheTags() {
    $this->cacheTags = [
      // 'myAwesomeCoolCacheTag',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setParams() {
    // It would be good to always run this.
    parent::setParams();

    $this->privateParams['status'] = 1;

    // Here we also want to handle any bad param errors...
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultPlatform() {
    return "default";
  }

  /**
   * {@inheritdoc}
   */
  public function getResourceQueryResult() {
    // Just having this here as an example.
    // Most times no need to override this method.
    parent::getResourceQueryResult();
  }

  /**
   * {@inheritdoc}
   */
  public function getResourceListQueryResult() {
    // This method should be overridden for any endpoint.
    $query = $this->entityTypeManager->getStorage('character')->getQuery();
    $query->condition('status', $this->privateParams['status']);

    $count_query = clone $query;

    $query->range(($this->page * $this->limit), $this->limit);
    $entity_ids = $query->execute();

    // Must set total result count so we can properly page.
    $this->resultTotal = (int) $count_query->count()->execute();

    // Process Items.
    $entities = $this->entityTypeManager->getStorage('character')->loadMultiple($entity_ids);

    $this->rawData = $entities;
  }

  /**
   * {@inheritdoc}
   */
  public function buildAllResourceData() {
    $data = [];

    foreach ($this->rawData as $charcter) {
      $this->cacheTags = array_merge($this->cacheTags, $charcter->getCacheTags());
      $created_changed = $this->transformer->createdChangedFieldVals($charcter);

      $item = [
        'id' => (int) $charcter->id(),
        'name' => $charcter->label(),
        'type' => $charcter->bundle(),
        'base_stats' => $charcter->getBaseStats(),
        'created' => $created_changed[0],
        'updated' => $created_changed[1],
      ];
      $data[] = $item;
    }

    $this->data = $data;
  }

  /**
   * {@inheritdoc}
   */
  public function buildLinks() {
    // This method should be overridden for any endpoint.
    $base_url = $this->request->getSchemeAndHttpHost() . $this->request->getPathInfo();
    $tmp_query_params = $this->params;
    $tmp_query_params['platform'] = $this->platform;
    $tmp_query_params['limit'] = $this->limit;

    if ($this->page == 0) {
      $this->prev = "";
    }
    else {
      $tmp_query_params['page'] = $this->page - 1;
      $this->prev = $base_url . "?" . http_build_query($tmp_query_params);
    }

    if ($this->resultTotal > (($this->page + 1) * $this->limit)) {
      $tmp_query_params['page'] = $this->page + 1;
      $this->next = $base_url . "?" . http_build_query($tmp_query_params);
    }
    else {

      $this->next = "";
    }

  }

}
