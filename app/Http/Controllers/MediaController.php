<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Medias;
use Validator;
use Image;

class MediaController extends Controller
{
    //

    public function remmove(){
    	
    }

	public function uploadFile(Request $request){

		$file = $request->file('formData');
		$fileValid = array('file' => $file);
		// setting up rules
		if ($request->input('type') == 'pdf'){
			$rules = array('file' => 'required|max:50000|mimes:pdf'); //mimes:jpeg,bmp,png and for max size max:10000
		}else{
			$rules = array('file' => 'required|max:20000|mimes:jpeg,jpg,png'); //mimes:jpeg,bmp,png and for max size max:10000
		}

		// doing the validation, passing post data, rules and the messages
		$validator = Validator::make($fileValid, $rules);
		if ($validator->fails()) {
			// send back to the page with the input data and errors
			return response()->json(array('success' => false,'msg' => 'Wrong format image file or filesize'));
		}
		else {
			// checking file is valid.
			$fileExtension = $file->getClientMimeType();
			$destinationPath = 'uploads/'; // upload path
			$fileName = time().$file->getClientOriginalName(); // getting image extension
			$file->move($destinationPath, $fileName); // uploading file to given path
			// sending back with message

			if( $fileExtension != 'pdf'){
				//$image_resize = Image::make($destinationPath.$fileName);
				//$image_resize->resize(150, 150)->save();
			}

			// Store database
			$media = new Medias();
			$media->file_name = $fileName;
			$media->file_type = $request->input('type');
			$media->file_url = url($destinationPath.$fileName);
			$media->file_size = $file->getClientSize();
			$media->save();

			// Save to product

			$product = Products::find($request->input('pid'));
			if( $request->input('type') == 'pdf' ){
				$product->download_file = $media->id;
			}else{
				$product->product_thumbnail = $media->id;
			}
			$product->save();

			return response()->json(array(
				'success' => true,
				'file' => $media->file_url,
				'mid' => $media->id,
				'ext' => $media->file_type
			));
		}

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
				[
					'success' => true,
					'msg' => array('alert'=>$msg),
					'file' => $arr_fileupload_msg,

				]);
		   
		} else {
		    return response()->json(false, 200);
		}
    }
}
