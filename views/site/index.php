<?php

/** @var yii\web\View $this */
//use yii\helpers\Html;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

use yii\helpers\Url;  
$this->title = 'Application Form';
$imagePathProfile = '/uploads/profile/'; 
$imagePathResume = '/uploads/resumeS/'; 
?>

<div class="site-index">

    <!-- <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="">Get started with Yii</a></p>
    </div> -->

    <div class="body-content">
           <div class="row mt-3">
              <div class="col-md-12 d-flex justify-content-end">
                  <?= Html::a('Application Form', ['/site/apply-job'], ['class'=>'btn btn-primary btn-cus']) ?>
              </div>
           </div>
          

           <div class="row flex-row justify-content-end mt-2">
              <div class="col-md-4 d-flex flex-row justify-content-end align-items-end">
                <?php $form = ActiveForm::begin(['method' => 'post']) ?>
                  <input type="text" name="searchval" id="search" value="<?= $oldval ?>" style="border-radius: 5px;border:1px solid lightgray;    padding-top: 0px;"/>
                  <button type="submit" class="btn btn-sm btn-primary" name="searchbtn" value="search">Search</button>
                  <button type="submit" class="btn btn-sm btn-danger" name="clearbtn" value="clear">clear</button>
                <?php ActiveForm::end() ?>
              </div>
              <div class="col-md-12" id="tbl-cust">
                <table class="table table-hover mt-2">
                    <thead>
                        <tr class="table-active">
                        <th scope="row">Profile</th>
                        <th scope="row">Name</th>
                        <th scope="row">Email</th>
                        <th scope="row">Job Title</th>
                        <th scope="row">Gender</th>
                        <th scope="row" align="center">Created Date</th>
                        <th scope="row">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($jobs as $job): ?>
                            <tr>
                                <td><?=  Html::img($imagePathProfile.$job->profile_img, ['alt' => 'Image Description','class' => 'rounded-circle w-c-50']) ?></td>
                                <td><?= $job->name ?></td>
                                <td><?= $job->email ?></td>
                                <td><?= $job->applied_position ?></td>
                                <td><?= $job->gender ?></td>
                                <td scope="row" align="center"><?= ($job->created_at != '') ? date('d-m-y h:i:s',strtotime($job->created_at)) : '-' ?> </td>
                                <td >
                                <?= Html::a('<i class="fas fa-edit"></i>', ['/site/update','id' => $job->id], ['class'=>'']) ?>
                                <?= Html::a('<i class="fas fa-eye"></i>', ['/site/candidate-info','id' => $job->id], ['class'=>'']) ?>
                                    
                                      <?=
                                          Html::beginForm(['/site/delete/', 'id' => $job->id],'post', ['class'=>'inline-blockc'])
                                         ?>
                                           <a type="submit" class="text-danger" data-confirm="Are you sure you want to delete this item?">
                                              <i class="fas fa-trash" ></i>
                                          </a>
                                          <?= Html::endForm()

                                      ?>
                                      <?php
                                        $this->registerJs('confirmationAlert', <<<JS
                                            $('button[data-confirm]').on('click', function(e) {
                                                var message = $(this).data('confirm');
                                                if (!confirm(message)) {
                                                    e.preventDefault();
                                                }
                                            });
                                        JS
                                        );
                                      ?>
                                </td>
                               
                                </tr>
                        <?php endforeach; ?>
                        <?php if(count($jobs) < 1){ ?>
                            <tr>
                                <td colspan="8" align="center">Data not found</td>
                            </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>   
                <?= yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
              </div>
           </div>
            
        

    </div>
</div>
