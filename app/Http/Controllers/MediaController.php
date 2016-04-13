<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MediaController extends Controller
{
    //

    public function remmove(){
    	
    }

    public function upload(){
		if( Input::hasFile('file') ) {
			$files = Input::file('file');
			$msg = array();
			$arr_fileupload_msg = array();
			$destinationPath = Config::get('site.upload_path');

			if( count($files)  > 6 ){
				$arr = ['success' => false, 
						'msg' => array('alert'=>'Maximum uploaded file 3!'),
						'file'=>''];
				return response()->json($arr);
			}

			$rules = array(	'image' => 'image');
			$str_images = '';

			foreach ($files as $fileupload) {

				//Validate images type
				$validate_img = array('image' => $fileupload);
				$validator = Validator::make($validate_img, $rules);
				if ( $validator->fails() ){
					$msg[$fileupload->getClientOriginalName()] = 'Wrong format file.';
					continue;
				}
				else {
					// Validate file max upload size
					$file_size = $fileupload->getSize();
					if($file_size >= 3000000){
						$msg[$fileupload->getClientOriginalName()] = 'Allow file size : 3Mb';
						continue;
					}

					
					$filename = time().'-'.$fileupload->getClientOriginalName();
					$file_url = asset($destinationPath.$filename);
					$file_path = $destinationPath.$filename;
					// Save file to server	
					$fileupload->move($destinationPath, $filename);

					//Crop Image upload
					$demention = getimagesize($file_path);
					$image_resize = Image::make($file_path);
					if($demention[0] >= $demention[1]){
						$image_resize->crop($demention[1], $demention[1]);
						$image_resize->resize(600, 600);
					}else{
						$image_resize->crop($demention[0], $demention[0]);
						$image_resize->resize(600, 600);
					}

					$image_resize->save();
					$data_file_insert = array(
						'file_name' => $filename,
						'file_path' => $destinationPath,
						'file_url' 	=> $file_url,
						'file_size' => $file_size
					);
					// Save to media and get media_id
					$media_id = DB::table('media')->insertGetId($data_file_insert);
					$data_file_insert['file_id'] = $media_id;
					array_push($arr_fileupload_msg, $data_file_insert);
					$msg[$fileupload->getClientOriginalName()] = 'Upload successful!';
					$str_images .=  $media_id.',';
					
				}
			}//end foreach
			
			// Update media to ads
			$current_ads->ads_images = $current_ads->ads_images.$str_images;
			// Save ads images
			$current_ads->save();
			return response()->json(
				['success' => true, 
				'msg' => array('alert'=>$msg),
				'file' => $arr_fileupload_msg
				]);
		   
		} else {
		    return response()->json(false, 200);
		}
    }
}
