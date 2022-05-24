<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */

if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-info alert-dismissible" onclick="this.classList.add('hidden');" style="margin-top: 10px;"><button type="button" class="close" data-dismiss="alert">&times;</button><?= $message ?></div>
