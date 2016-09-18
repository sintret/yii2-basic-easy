<?php

use app\assets\PrintAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

PrintAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?php echo Yii::$app->name;?> - <?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <?php $this->beginBody() ?>
    <body>
        <?php echo $content;?>
          <script>
            window.print();
        </script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
