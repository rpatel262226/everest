<?php

/** @var yii\web\View $this */
//use yii\helpers\Html;
use yii\bootstrap5\Html;
use yii\helpers\Url;  
$this->title = 'Application Form';
?>
<style>
   .pagination {
  display: flex;
  list-style: none;
  border-radius: 0.25rem;
  justify-content: center;
  margin: 20px 0;
}

.page-item {
  padding: 5px 10px;
  border: 1px solid #ddd;
}

.page-item.active .page-link {
  background-color: #ddd;
  border-color: #ddd;
}

.page-link {
  position: relative;
  display: block;
  padding: 0.5rem 0.75rem;
  margin-left: -1px;
  line-height: 1.75;
  color: #333;
  background-color: #fff;
  border: 1px solid #ddd;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
}

.page-link:hover {
  z-index: 2;
  color: #007bff;
  background-color: #e9ecef;
  border-color: #ddd;
}

.page-link:not(:first-child) {
  margin-left: 5px;
}

.disabled .page-link {
  color: #6c757d;
  pointer-events: none;
  background-color: #fff;
  border-color: #ddd;
}

.active .page-link {
  z-index: 2;
  color: #fff;
  background-color: #007bff;
  border-color: #007bff;
}
.inline-blockc {
  display: inline-block;
}


</style>
<div class="site-index">

    <!-- <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="">Get started with Yii</a></p>
    </div> -->

    <div class="body-content">
           <div class="row mt-5">
              <div class="col-md-12 d-flex justify-content-end">
                  <?= Html::a('Apply Job', ['/site/apply-job'], ['class'=>'btn btn-primary']) ?>
              </div>
           </div>
           <div class="row">
              <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Job Title</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Applied Date</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($jobs as $job): ?>
                            <tr class="table-active">
                                <td><?= $job->id ?></td>
                                <td><?= $job->name ?></td>
                                <td><?= $job->gender ?></td>
                                <td scope="row"><?= $job->created_at ?></td>
                                <td><?= $job->email ?></td>
                                <td >
                                <?= Html::a('<i class="fas fa-edit"></i>', ['/site/candidate-info'], ['class'=>'']) ?>
                                <?= Html::a('<i class="fas fa-eye"></i>', ['/site/candidate-info'], ['class'=>'']) ?>
                                    
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
                                <td>
                            </td>
                                </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>   
                <?= yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
              </div>
           </div>
            
        

    </div>
</div>
