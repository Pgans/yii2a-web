<?php

namespace frontend\controllers;
use yii;

class ThaimedController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionOperation() {
        $data = Yii::$app->request->post();
        $date1 =isset($data['date1'])  ? $data['date1'] : '';
        $date2 =isset($data['date2'])  ? $data['date2'] : '';

      $sql = "SELECT  REGDATE,
COUNT(CASE WHEN(CODE ='99.92') THEN '1' END) AS 'Acupuncture',
COUNT(CASE WHEN(CODE BETWEEN '900-77-00' AND '900-77-49') THEN '1' END) AS 'บริบาล',
COUNT(CASE WHEN CODE IN ('875-78-11','900-78-11','590-78-11','724-78-11','874-78-11','590-78-11','9007811','400-78-20','400-78-11','9007818','721-78-11','9007810','876-78-10','876-78-11','873-78-11') THEN 'นวด'  END) AS 'การนวด',
COUNT(CASE WHEN CODE BETWEEN '900-78-00'AND '900-78-08' OR CODE IN('2287420') THEN 'อบ'  END) AS 'อบ',
COUNT(CASE WHEN CODE IN ('875-78-20','900-78-20','9007820','590-78-20','724-78-20','721-78-20','721-78-21','590-78-20','876-78-20','874-78-20','873-78-21') THEN 'ประคบ' END) AS 'ประคบ',
COUNT(CASE WHEN CODE BETWEEN '900-79-00'AND '900-79-99'  THEN 'xx' END) AS 'ส่งเสริม',
COUNT(`CODE`) AS Total
FROM mb_thaimedoper 
WHERE REGDATE BETWEEN '$date1' AND '$date2' AND INOUTS = 1
GROUP BY REGDATE ORDER BY REGDATE";

     $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

        //print_r($rawData);
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db2\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        Yii::$app->session['date1'] =$date1;
        Yii::$app->session['date2'] =$date2;
        return $this->render('operation', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1' => $date1,
                    'date2' => $date2,

        ]);
    }
    public function actionOperation_out() {
        $data = Yii::$app->request->post();
        $date1 =isset($data['date1'])  ? $data['date1'] : '';
        $date2 =isset($data['date2'])  ? $data['date2'] : '';

      $sql = "SELECT  REGDATE,
COUNT(CASE WHEN(CODE ='99.92') THEN '1' END) AS 'Acupuncture',
COUNT(CASE WHEN(CODE BETWEEN '900-77-00' AND '900-77-49') THEN '1' END) AS 'บริบาล',
COUNT(CASE WHEN CODE IN ('875-78-11','900-78-11','590-78-11','724-78-11','874-78-11','590-78-11','9007811','400-78-20','400-78-11','9007818','721-78-11','9007810','876-78-10','876-78-11','873-78-11') THEN 'นวด'  END) AS 'การนวด',
COUNT(CASE WHEN CODE BETWEEN '900-78-00'AND '900-78-08' OR CODE IN('2287420') THEN 'อบ'  END) AS 'อบ',
COUNT(CASE WHEN CODE IN ('875-78-20','900-78-20','9007820','590-78-20','724-78-20','721-78-20','721-78-21','590-78-20','876-78-20','874-78-20','873-78-21') THEN 'ประคบ' END) AS 'ประคบ',
COUNT(CASE WHEN CODE BETWEEN '900-79-00'AND '900-79-99'  THEN 'xx' END) AS 'ส่งเสริม',
COUNT(`CODE`) AS Total
FROM mb_thaimedoper 
WHERE REGDATE BETWEEN '$date1' AND '$date2' AND INOUTS = '2'
GROUP BY REGDATE ORDER BY REGDATE";

     $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

        //print_r($rawData);
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db2\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        Yii::$app->session['date1'] =$date1;
        Yii::$app->session['date2'] =$date2;
        return $this->render('operation_out', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1' => $date1,
                    'date2' => $date2,

        ]);
    }
    public function actionOutstan(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT UNIT_ID,UNIT_NAME, COUNT(UNIT_ID) AS amount
FROM mb_outstan  WHERE mu_date BETWEEN '$date1' AND '$date2'
GROUP BY UNIT_NAME ORDER BY amount";
       $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       Yii::$app->session['date1']=$date1;
       Yii::$app->session['date2']=$date2;
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('outstan', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
        public function actionOutstan_list($mudate){
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
            $sql = "SELECT * FROM mb_outstan
            WHERE mu_date = $mudate AND mu_date BETWEEN '$date1' AND '$date2' GROUP BY VISIT_ID";
        $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

        // print_r($rawData);
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db2\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('outstan_list', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionIntructure(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT DISTINCT  a.STAFF_ID , c.FNAME , c.LNAME ,COUNT(a.STAFF_ID) AS AMOUNT
                FROM  mb_thaimedoper a, staff b
                INNER JOIN population c ON b.CID = c.CID
                WHERE  a.REGDATE BETWEEN '$date1' AND '$date2'
                AND a.STAFF_ID = b.STAFF_ID AND a.INOUTS = 1
                GROUP BY a.STAFF_ID  ORDER BY AMOUNT DESC";
       $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       Yii::$app->session['date1']=$date1;
       Yii::$app->session['date2']=$date2;
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('intructure', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
        public function actionIntructure_list($staffid) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
            $sql = "SELECT * FROM mb_thaimedoper
            WHERE STAFF_ID = $staffid AND REGDATE BETWEEN '$date1' AND '$date2'AND INOUTS = 1 ";
        $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

        // print_r($rawData);
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db2\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('intructure_list', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
     public function actionCormore(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT * FROM mb_common_cold WHERE REG_DATETIME BETWEEN '$date1' AND '$date2'";

       $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       //Yii::$app->session['date1']=$date1;
       //Yii::$app->session['date2']=$date2;
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       Yii::$app->session['date1'] =$date1;
       Yii::$app->session['date2'] =$date2;
       return $this->render('cormore', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
     }
}

