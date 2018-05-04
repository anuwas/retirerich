<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
	/**
	 * @var UploadedFile
	 */
	public $imageFile;
    public $csv;
    public $doc;

	public function rules()
	{
		return [
				[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
 [['csv'], 'file', 'skipOnEmpty' => false, 'extensions'=>['xls', 'xlsx'],
     'checkExtensionByMimeType'=>false, 'maxSize'=>1024 * 1024 * 5],
        [['doc'], 'file', 'skipOnEmpty' => false, 'extensions'=>['doc', 'docx', 'pdf'], 'checkExtensionByMimeType'=>false, 'maxSize'=>1024 * 1024 * 5],
		];

	}



    public function productcategoryUpload(){
        $filename='';
        $rnd  = rand(0,9999);

        $filename=$rnd.'_'.$this->imageFile->baseName . '.' . $this->imageFile->extension;
        $filename = str_replace(' ', '', $filename);
        $this->imageFile->saveAs('uploads/product_category/' . $filename);
        chmod("uploads/product_category/".$filename, 0644);

        return $filename;
    }
	
	


    public function clientexcelUpload(){
        $filename='';
        $rnd  = rand(0,9999);

        $filename=$rnd.'_'.$this->csv->baseName . '.' . $this->csv->extension;
        $filename = str_replace(' ', '', $filename);
        $this->csv->saveAs('uploads/client_excel/' . $filename);
        chmod("uploads/client_excel/".$filename, 0644);

        return $filename;
    }

    public function hotelexcelUpload(){
        $filename='';
        $rnd  = rand(0,9999);

        $filename=$rnd.'_'.$this->csv->baseName . '.' . $this->csv->extension;
        $filename = str_replace(' ', '', $filename);
        $this->csv->saveAs('uploads/hotel_excel/' . $filename);
        chmod("uploads/hotel_excel/".$filename, 0644);

        return $filename;
    }

	public function userexcelUpload(){
		$filename='';
		$rnd  = rand(0,9999);

		$filename=$rnd.'_'.$this->csv->baseName . '.' . $this->csv->extension;
		$filename = str_replace(' ', '', $filename);
		$this->csv->saveAs('uploads/user_excel/' . $filename);
		chmod("uploads/user_excel/".$filename, 0644);

		return $filename;
	}


	public function bookingUpload(){
        $filename='';
        $rnd  = rand(0,9999);

        $filename=$rnd.'_'.$this->doc->baseName . '.' . $this->doc->extension;
        $filename = str_replace(' ', '', $filename);
        $this->doc->saveAs('uploads/booking/' . $filename);
        chmod("uploads/booking/".$filename, 0644);

        return $filename;
    }

    public function hotelbankUpload(){
        $filename='';
        $rnd  = rand(0,9999);

        $filename=$rnd.'_'.$this->doc->baseName . '.' . $this->doc->extension;
        $filename = str_replace(' ', '', $filename);
        $this->doc->saveAs('uploads/hotel_bank/' . $filename);
        chmod("uploads/hotel_bank/".$filename, 0644);

        return $filename;
    }

    public function invoiceUpload(){
        $filename='';
        $rnd  = rand(0,9999);

        $filename=$rnd.'_'.$this->doc->baseName . '.' . $this->doc->extension;
        $filename = str_replace(' ', '', $filename);
        $this->doc->saveAs('uploads/invoice/' . $filename);
        chmod("uploads/invoice/".$filename, 0644);

        return $filename;
    }

}