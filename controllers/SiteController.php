<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\Jobs;
use yii\data\Pagination;
class SiteController extends Controller
{

    
     public $searchvalc;
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        // $jobs = Jobs::find()->all();
        $query = Jobs::find();
        $model = new Jobs();
        $countQuery = clone $query;
        $totalItems = $countQuery->count();

        $pages = new Pagination([
            'totalCount' => $totalItems,
            'pageSize' => 10, 
            'forcePageParam' => false,
        ]);
        if(isset(Yii::$app->request->post()['clearbtn'])){
            $this->searchvalc = '';
         
        }
      
        if ((Yii::$app->request->post() && Yii::$app->request->post()['searchval'] != '' && !isset(Yii::$app->request->post()['clearbtn'])) || $this->searchvalc != '') {
           
            $term = Yii::$app->request->post()['searchval'];
            $this->searchvalc = $term ;
            $query->andFilterWhere([
                'or',
                ['like', 'name', '%'. $term .'%', false],
                ['like', 'email', '%'. $term .'%', false],
                ['like', 'phone_number', '%'. $term .'%', false],
                ['like', 'applied_position', '%'. $term .'%', false],
                
            ]);
        }else{
            $this->searchvalc = '';
        }
      
        $jobs = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'jobs' => $jobs,
            'pages' => $pages,
            'model' => $model,
            'oldval' => $this->searchvalc,
            'postr' => Yii::$app->request->post()
        ]);
        // return $this->render('index', [
        //     'jobs' => $jobs,
        // ]);
    }

    public function actionApplyJob()
    {
        $model = new Jobs();
        
        if ($model->load(Yii::$app->request->post()) ) {
            $model->uploadResume = UploadedFile::getInstance($model, 'uploadResume');
            $filename = time().'.'.$model->uploadResume->extension;
            $model->uploadResume->saveAs('uploads/resumes/'.$filename);
            $model->uploadResume= $filename;
            //profile image

            $model->profile_img = UploadedFile::getInstance($model, 'profile_img');
            $filename2 = time().'.'.$model->profile_img->extension;
            $model->profile_img->saveAs('uploads/profile/'.$filename2);
            $model->profile_img= $filename2;

            
            $model->created_at= date('Y-m-d h:i:s');
            $model->save();
            Yii::$app->session->setFlash('success','Application submitted');
            return $this->redirect(['/site/index']);
        }

        return $this->render('apply-job', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Jobs::findOne($id);
        
        if (!$model) {
            throw new NotFoundHttpException('Job Not Found');
        }
        $oldProfile = $model->profile_img;
        $oldresume = $model->uploadResume;
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->refresh();
        // }

        if ($model->load(Yii::$app->request->post()) ) {
            $fileres = UploadedFile::getInstance($model, 'uploadResume');
            if($fileres != ''){
                $model->uploadResume = UploadedFile::getInstance($model, 'uploadResume');
                $filename = time().'.'.$model->uploadResume->extension;
                $model->uploadResume->saveAs('uploads/resumes/'.$filename);
                $model->uploadResume= $filename;
            }else{
                $model->uploadResume= $oldresume;
            }
        
            //profile image
            $profimg= UploadedFile::getInstance($model, 'profile_img');
            
            if($profimg != ''){
                $model->profile_img = UploadedFile::getInstance($model, 'profile_img');
                $filename2 = time().'.'.$model->profile_img->extension;
                $model->profile_img->saveAs('uploads/profile/'.$filename2);
                $model->profile_img= $filename2;
            }else{
                $model->profile_img= $oldProfile;
            }
            $model->save();
            Yii::$app->session->setFlash('success','Application updated');
            return $this->redirect(['/site/index']);
            // return $this->refresh();
        }

        return $this->render('apply-job-edit', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Jobs::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('Job Not Found');
        }

        if (file_exists(\Yii::getAlias('@webroot') . '/uploads/profile/' . $model->profile_img)) {
            unlink(\Yii::getAlias('@webroot') . '/uploads/profile/' . $model->profile_img);
        }
        if (file_exists(\Yii::getAlias('@webroot') . '/uploads/resumes/' . $model->uploadResume)) {
            unlink(\Yii::getAlias('@webroot') . '/uploads/resumes/' . $model->uploadResume);
        }
        $model->delete();
        Yii::$app->session->setFlash('success','Application Deleted');
        return $this->redirect('index');
    }

    public function actionCandidateInfo($id)
    {
        $data = Jobs::findOne($id);
        if (!$data) {
            throw new NotFoundHttpException('Job Not Found');
        }
        return $this->render('job-details',[
            'data' => $data,
        ]);
    }

    public function actionSearch(){
        echo "hello";

    }
}
