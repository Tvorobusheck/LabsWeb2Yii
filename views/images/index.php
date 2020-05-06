<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Images', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
            'attribute'=>'caption',
            'label'=>'Caption',
            'contentOptions' =>function ($model, $key, $index, $column){
                return ['class' => 'name'];
            },
            'content'=>function($data){
                $caption = explode(';', $data['caption'])[1];
		return $caption;
            }
        ],
	    
        [
            'attribute'=>'filename',
            'label'=>'Picture',
            'contentOptions' =>function ($model, $key, $index, $column){
                return ['class' => 'name'];
            },
            'content'=>function($data){
                $gv_image_path = explode(';', $data['caption'])[0];
//		var_dump($gv_image_path);
		return Html::img($gv_image_path,

                    ['height' => '200px']);
            }
        ],
/*	 [ 
         'label'=>"File",
          
         'attribute'=>'filename',
         'headerOptions' => ['style' => 'width:20%; right=40px;'],


         'format'=> 'image',
	 ],*/


            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}{create}',
	    ]
        ],
    ]); ?>


</div>
