<?php
require __DIR__ . '/vendor/autoload.php';

use Eskrano\FormBuilder\Builder;

$form = (new Builder(
    new Eskrano\FormBuilder\Presenters\BootstrapThree()
))->setAction('/index.php')
    ->setMethod('POST')->block('row', function (Builder $builder) {
        $field_1 = $builder->presenter->multiCol([
            'sm' => 6,
            'md' => 6,

        ], function () use ($builder) {
            return $builder->copy()->text()->textArea()->getHtml();
        });

        $field_2 = $builder->presenter->multiCol([
            'sm' => 6,
            'md' => 6,
        ], function () use ($builder) {
            return $builder->copy()->text()->text()->getHtml();
        });

        return $field_1 . $field_2;
    })->separator()->select([

    ],[
        'select_1',
        'select_2',
        'select_3'
    ]); ?>

<html>
<head>
    <title>Eskrano Form Builder Example</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Some Form
        </div>
        <div class="panel-body">
            <?php echo $form->render(); ?>
        </div>
    </div>
</div>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>

