<?php

/* @var $this \yii\web\View */
/* @var $content string */

\app\assets\BlankAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php echo $content; ?>

<?php $this->endBody() ?>

<?php $this->endPage() ?>
