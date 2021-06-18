<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\File;
use Image;

class UploadController extends Controller
{
    public function upload($data = []){
    	if(in_array('new_name', $data)){
    		$new_name = $data['new_name'] === null?time():$data['new_name'];
    	}
    	if(request()->hasFile($data['file']) && $data['upload_type'] == 'single'){
            $file      = request()->file($data['file']);
            // $sourceProperties = getimagesize($file);
            // $imageType = $sourceProperties['mime'];
            // switch ($imageType) {
            //     case 'image/png':
            //         $imageSrc = imagecreatefrompng($file);
            //         $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
            //         imagepng($tmp,$dirPath. $newFileName. $ext);
            //         break; 
            //     case 'image/jpeg':
            //         $imageSrc = imagecreatefromjpeg($file);
            //         $tmp = $this->imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
            //         // return $tmp->store($data['path']);
            //         //return imagepng($tmp,$data['path']);
            //         //return $file->store($data['path']);
            //         return imagejpeg($tmp)->store($data['path']);
            //         break;
            // }
      //       return $imageType;
            $size = Image::make($file->getRealPath());              
            $size->resize(300, 300);
    		Storage::has($data['delete_file'])? Storage::delete($data['delete_file']): '';
    		// return request()->file($data['file'])->store($data['path']);    	
            return $file->store($data['path']);
    	}elseif(request()->hasFile($data['file']) && 'files' == $data['upload_type']){
    		$file      = request()->file($data['file']);
    		// $size      = $file->getSize();
            $size = Image::make($file->getRealPath());              
            $size->resize(300, 300);

    		$mime_type = $file->getMimeType();
    		$name      = $file->getClientOriginalName();
    		$hash_name = $file->hashName();

    		$file->store($data['path']);
    		$add = File::create([
    			'name'        => $name,
    			'size'        => $size,
    			'file'        => $hash_name,
    			'path'        => $data['path'],
    			'full_file'   => $data['path'] .'/'. $hash_name,
    			'mime_type'   => $mime_type,
    			'file_type'   => $data['file_type'],
    			'relation_id' => $data['relation_id'],
    		]);
    		return $add->id;
    	}
    }


    // function imageResize($imageSrc,$imageWidth,$imageHeight) {

    //     $newImageWidth =200;
    //     $newImageHeight =200;

    //     $newImageLayer=imagecreatetruecolor($newImageWidth,$newImageHeight);
    //     imagecopyresampled($newImageLayer,$imageSrc,0,0,0,0,$newImageWidth,$newImageHeight,$imageWidth,$imageHeight);

    //     return $newImageLayer;
    // }

    // // delete a specific file using its id
    // public function delete($id){
    //     $file = File::find($id);
    //     if(!empty($file)){ 
    //         Storage::delete($file->full_file);
    //         $file->delete();
    //     }   
    // }

    // delete multiple files using ids, then delete container directory
    public function delete_files($product_id){
        $files = File::where('file_type', 'product')->where('relation_id', $product_id)->get();
        if(count($files) > 0){
            foreach ($files as $file) {
                $this->delete($file->id);
                Storage::deleteDirectory($file->path);
            }
        }  
    }
}
