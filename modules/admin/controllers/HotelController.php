<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Hotel;
use app\models\HotelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\StatesMaster;
use app\models\States;
use app\models\Countries;
/**
 * HotelController implements the CRUD actions for Hotel model.
 */
class HotelController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Hotel models.
     * @return mixed
     */
    public function actionIndex1()
    {
        $searchModel = new HotelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hotel model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Hotel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hotel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->hotel_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Hotel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->hotel_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Hotel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Hotel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Hotel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hotel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionIndex()
    {
        $this->view->title = 'CRM - Hotels';
        $this->layout = 'admin';

        $model=Hotel::find()->orderBy('hotel_id DESC')->all();
        return $this->render('hotel_list',['model'=>$model]);
    }


    public function actionNewhotel()
    {

        $this->view->title = 'CRM - Add Hotel';
        $this->layout = 'admin';
        $model = new Hotel();
        $imgmodel = new UploadForm();

        $countries = Countries::find()->All();

        //$states=StatesMaster::find()->orderBy('id ASC')->all();

        if($model->load(Yii::$app->request->post())){
            $uploadedfile = UploadedFile::getInstance($imgmodel, 'resource');
            if($uploadedfile){

                $imgmodel->doc=$uploadedfile;
                $filename=$imgmodel->hotelUpload();
                $model->filename=$filename;
            }

            $model->from_day = json_encode($model->from_day);
            $model->to_day = json_encode($model->to_day);
            $model->price = json_encode($model->price);
            //var_dump($model->from_day);die;

             //var_dump($model);die;


            if($model->save()) {
                $session = new Session();
                $session->open();
                $session['Add'] = 'Add';
                return $this->redirect(Yii::$app->request->baseUrl . '/admin/hotel');
            }
            else{
                $session = new Session();
                $session->open();
                $session['False'] = 'False';
                return $this->redirect(Yii::$app->request->baseUrl . '/admin/hotel');
            }
        }else{
            return $this->render('new_hotel',['model' => $model, 'countries' => $countries]);
        }

    }

    public function actionUpdatehotel($id)
    {

        $this->view->title = 'CRM - Update Hotel';
        $this->layout = 'admin';
        $imgmodel = new UploadForm();
        $model = $this->findModel($id);
        $countries = Countries::find()->All();
        $id_corp = $id;
       //var_dump($model['from_day')];die;
        $model->from_day = json_decode($model->from_day);
        $model->to_day = json_decode($model->to_day);
        $model->price = json_decode($model->price);

       //var_dump($model->from_day);die;
        $array  = $model->from_day;



        $count = count($array);
        $count1 = count($array);

        //$states=StatesMaster::find()->orderBy('id ASC')->all();

        if($model->load(Yii::$app->request->post()))
        {
            $uploadedfile = UploadedFile::getInstance($imgmodel, 'resource');
            if($uploadedfile){

                $imgmodel->doc=$uploadedfile;
                $filename=$imgmodel->hotelUpload();
                $model->filename=$filename;
            }
            $model->from_day = json_encode($model->from_day);
            $model->to_day = json_encode($model->to_day);
            $model->price = json_encode($model->price);
            //var_dump($model->from_day);die();
            $model->save();

            $session = new Session();
            $session->open();
            $session['Update']='Update';
            return $this->redirect(Yii::$app->request->baseUrl.'/admin/hotel');
        }

        else {
            return $this->render('update_hotel', ['model' => $model, 'countries' => $countries,'count' =>$count,'from_day'=>$model->from_day,'to_day'=>$model->to_day,'price'=>$model->price,'id_corp'=>$id_corp,'count1'=>$count1]);

        }
    }

    public function actionDeletehotel($id)
    {

        $model = Hotel::findOne(['hotel_id' => $id]);
        $model->active = 0;
        $model->save();

        $session = new Session();
        $session->open();
        $session['Update']='Update';
        return $this->redirect(Yii::$app->request->baseUrl . '/admin/hotel');
    }

    public function actionBulkdelete()
    {
	    $data = Yii::$app->request->post();
        $idArr = $data['checked_id'];
	        foreach($idArr as $id){
	            $model = Hotel::findOne(['hotel_id' => $id]);
	            $model->delete();
	        }
        $session = new Session();
        $session->open();
        $session['Update']='Update';
        return $this->redirect(Yii::$app->request->baseUrl . '/admin/hotel');
    }

    //Import
    public function actionImporthotel()
    {
        $this->view->title = 'CRM - Import Hotel';
        $this->layout = 'admin';

        $model = new Hotel();
        $imgmodel = new UploadForm();

        if($model->load(Yii::$app->request->post())){

            $uploadedfile = UploadedFile::getInstance($imgmodel, 'resource');
            if($uploadedfile){

                $imgmodel->csv=$uploadedfile;
                $filename=$imgmodel->hotelexcelUpload();
               // $model->filename=$filename;
            }

            $objPHPExcel = new \PHPExcel();
            $fileName = Yii::getAlias('@webroot').'/uploads/hotel_excel/' . $filename;
            try {
                $inputFileType = \PHPExcel_IOFactory::identify($fileName);
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($fileName);
            } catch (Exception $ex) {
                die('Error');
            }

            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            //$row is start 2 because first row assigned for heading.
            for ($row = 1; $row <= $highestRow; ++$row) {

                $model = new Hotel();

                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
               // var_dump($rowData);die;

                //echo json_encode($rowData);
                 //var_dump($rowData);
                if($row==1)
                {
                    continue;
                }


                $model->hotel_name = $rowData[0][0];
                $model->address = $rowData[0][1].'';
                $model->address_other = $rowData[0][2].'';
                $model->contact_number = $rowData[0][3].'';
                $model->gst_number = $rowData[0][4] .'';
                $model->state = $rowData[0][5].'';
                $model->state_code = $rowData[0][6] .'';
                $model->pan_number = $rowData[0][7].'';
                $model->group_name = $rowData[0][8].'';
                $model->star_category = $rowData[0][9].'';
                $model->city = $rowData[0][10].'';
                $model->countries = $rowData[0][11].'';
                $model->zipcode = $rowData[0][12].'';
                $model->hotel_email = $rowData[0][13].'';
                $model->corporate_rate = $rowData[0][14].'';
                $model->from_day = $rowData[0][15].'';
                $model->to_day = $rowData[0][16].'';
                $model->price = $rowData[0][17].'';
                $model->amenities = $rowData[0][18].'';
                $model->remark = $rowData[0][19].'';
                $model->tax = $rowData[0][20].'';
                $model->tax_remark = $rowData[0][21].'';
                $model->payment_method=$rowData[0][22].'';
                $model->contact_person=$rowData[0][23].'';
                $model->contact_email=$rowData[0][24].'';
                $model->cancellation_policy=$rowData[0][25].'';

                $model->save();
	           // print_r($model->getErrors());

            }
	        //var_dump($model);die;
            // die('okay');
            return $this->redirect(Yii::$app->request->baseUrl.'/admin/hotel');
        }else{
            return $this->render('importhotel',['model' => $model,]);
        }
    }


    public function actionFindstatecode(){

        $data = Yii::$app->request->post();

        $stateNAME=$data['stateNAME'];
        $code = StatesMaster::findOne(['name' => $stateNAME]);

        $statecode= $code->code;
        $variable = array('statecode' => "$statecode",);

        // One JSON for both variables
        echo json_encode($variable);
    }
    public function actionReport(){

        $this->view->title = 'CRM - Hotel Report';
        $this->layout = 'admin';
        $model=Hotel::findAll(['active' =>1]);

        $states = StatesMaster::find()->all();
        if (Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post();

            $hotelname=$data['hotelname'];
            $amenities=$data['amenities'];
            $state=$data['state'];
            $city=$data['city'];

            //var_dump($data);die;


            $queryParams = array();
            $whereQuery = '';
            if (!empty($hotelname)) {
                $whereQuery .= ' and H.hotel_name = :hotelname';
                $queryParams['hotelname'] = $hotelname;
            }
            if (!empty($amenities)) {
                $whereQuery .= ' and H.amenities = :amenities';
                $queryParams['amenities'] = $amenities;
            }
            if (!empty($state)) {
                $whereQuery .= ' and H.state_code = :state';
                $queryParams['state'] = $state;
            }
            if (!empty($city)) {
                $whereQuery .= ' and H.city  = :city';
                $queryParams['city'] = $city;
            }


            $connection = \Yii::$app->db;
            $qb = $connection
                ->createCommand('select *,S.name  from  hotel as H,states_master as S WHERE H.state_code = S.id' . $whereQuery);

            foreach ($queryParams as $param => $value) {
                $qb->bindValue($param, $value);
            }

            $list = $qb->queryAll();
            $inti = 1;
            return $this->render( 'hotel_report', [ 'model' => $list, 'inti' =>$inti ,'states'=> $states ] );
        }
        else {
            $inti = 0;
            return $this->render( 'hotel_report' , [ 'model' => $model, 'inti' =>$inti, 'states'=> $states ]);

        }

    }
    public function actionFind()
    {
        if (Yii::$app->request->isPost) {

            $data = Yii::$app->request->post();

            $hotelName = $data['hotelName'];
            $address = Hotel::findOne(['hotel_id' => $hotelName]);

            $address_hotel = $address->address;
            $variable = array('address_hotel' => "$address_hotel",);

            // One JSON for both variables
            echo json_encode($variable);
        }
    }
    public function actionStates()
    {
        if (Yii::$app->request->isPost) {

            $data = Yii::$app->request->post();

            $countryId = $data['countryId'];

            $states=States::findAll(['country_id'=>$countryId]);
            //var_dump($states);die;
            $states_name=null;
            $states_id=null;
            $variable=[];
            foreach ($states as $list) {

                /* $states_name = $list->name;
                 $states_id = $list->id;*/
                $variable[] = array('states_name'=> $list->name,'states_id'=>$list->id);

            }
            echo json_encode($variable);



            // One JSON for both variables


        }
    }

    //Export Booking
    public function actionExport(){

        $connection = \Yii::$app->db;

        $objPHPExcel = new \PHPExcel();

        $sheet=0;

        //$model=Booking::findAll(['active'=>1]);





        //$qb = $connection->createCommand("select * from hotel where active = 1");
        $qb = $connection->createCommand("select *, C.name from countries as C, hotel as H where H.countries = C.id  and H.active = 1");
        $list = $qb->queryAll();


        $objPHPExcel->setActiveSheetIndex($sheet);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);



        $objPHPExcel->getActiveSheet()->setTitle('Hotel Listing')
            ->setCellValue('A1', 'Hotel Name')
            ->setCellValue('B1', 'Address')
            ->setCellValue('C1', 'Address Other')
            ->setCellValue('D1', 'Contact Number')
            ->setCellValue('E1', 'GST')
            ->setCellValue('F1', 'State')
            ->setCellValue('G1', 'State Code')
            ->setCellValue('H1', 'PAN')
            ->setCellValue('I1', 'Group Name')
            ->setCellValue('J1', 'Star Category')
            ->setCellValue('K1', 'City')
            ->setCellValue('L1', 'Country')
            ->setCellValue('M1', 'ZIPCODE')
            ->setCellValue('N1', 'Hotel Email')
            ->setCellValue('O1', 'Corporate Rate')
            ->setCellValue('P1', 'From Day')
            ->setCellValue('Q1', 'To Day')
            ->setCellValue('R1', 'Price')
            ->setCellValue('S1', 'Amenetities')
            ->setCellValue('T1', 'Remarks')
            ->setCellValue('U1', 'Tax')
            ->setCellValue('V1', 'Tax Remarkss')
            ->setCellValue('W1', 'Cancellation Policy');



        $row=2;

        foreach ($list as $foo) {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$foo['hotel_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$foo['address']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$foo['address_other']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$foo['contact_number']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$foo['gst_number']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$foo['state']);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$foo['state_code']);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$foo['pan_number']);
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$foo['group_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$row,$foo['star_category']);
            $objPHPExcel->getActiveSheet()->setCellValue('K'.$row,$foo['city']);
            $objPHPExcel->getActiveSheet()->setCellValue('L'.$row,$foo['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('M'.$row,$foo['zipcode']);
            $objPHPExcel->getActiveSheet()->setCellValue('N'.$row,$foo['hotel_email']);
            $objPHPExcel->getActiveSheet()->setCellValue('O'.$row,$foo['corporate_rate']);
            $objPHPExcel->getActiveSheet()->setCellValue('P'.$row,$foo['from_day']);
            $objPHPExcel->getActiveSheet()->setCellValue('Q'.$row,$foo['to_day']);
            $objPHPExcel->getActiveSheet()->setCellValue('R'.$row,$foo['price']);
            $objPHPExcel->getActiveSheet()->setCellValue('S'.$row,$foo['amenities']);
            $objPHPExcel->getActiveSheet()->setCellValue('T'.$row,$foo['remark']);
            $objPHPExcel->getActiveSheet()->setCellValue('U'.$row,$foo['tax']);
            $objPHPExcel->getActiveSheet()->setCellValue('V'.$row,$foo['tax_remark']);
            $objPHPExcel->getActiveSheet()->setCellValue('W'.$row,$foo['cancellation_policy']);

            $row++ ;
        }

        $filename = "Hotel_List".date("d-m-Y-His").".xlsx";
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $objWriter->save('php://output');


    }
}
