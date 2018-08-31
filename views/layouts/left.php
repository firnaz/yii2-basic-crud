<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <!-- <i class="fa fa-user-circle"></i> -->

            </div>
            <div class="pull-left info">
                <!-- <i class="fa fa-user-circle" /> -->
                <p>
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Navigation', 'options' => ['class' => 'header']],

                    [
                        'label' => 'Database',
                        'icon' => 'database',
                        'url' => '#',
                        'visible' => true,
                        'items' => [
                            ['label' => 'Site', 'icon' => 'indent', 'url' => ['/site'], 'active' => Yii::$app->controller->id=='site']
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>
    <div class="footer-info hide">
    </div>
</aside>
