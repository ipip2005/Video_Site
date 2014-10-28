<?php
use Illuminate\Support\Facades\Redirect;
class VideoController extends \Controller {
	public function __construct() {
		// updated: prevents re-login.
		$this->beforeFilter ( 'auth' );
	}
	
	/**
	 * Video Table:
	 * id: 视频id，系统分配
	 * path: 视频路径
	 * user_id: 视频创建者id ---users表和videos表的一对多关系实现
	 * Name: 视频名
	 * Introduction: 视频简介
	 * view_count 点击量
	 * comment_count 评论数量
	 * score: 视频评分（总评分)
	 * score_count: 评分次数
	 * publishTime: 发布时间
	 * status: 上传成功，未上传成功，上传成功未发布/0,1,2
	 */
	/**
	 * layout to use
	 *
	 * @var View
	 */
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	public function postChangeName() {
		$name = Input::get ( "name" );
		$id = Input::get ( "id" );
		if (Video::find ( $id )->user_id == Auth::id ()) { // 请求更改的视频是自己的视频才更改，防止篡改
			$video = Video::find ( $id );
			$video->name = $name;
			$video->save ();
			return Response::json ( array (
					"success" => "ok" 
			) );
		} else {
			return Response::json ( array (
					"error" => "wrong request" 
			) );
		}
	}
	public function postChangeIntr() {
		$intr = Input::get ( "intr" );
		$id = Input::get ( "id" );
		if (Video::find ( $id )->user_id == Auth::id ()) { // 请求更改的视频是自己的视频才更改，防止篡改
			$video = Video::find ( $id );
			$video->introduction = $intr;
			$video->save ();
			return Response::json ( array (
					"success" => "ok" 
			) );
		} else {
			return Response::json ( array (
					"error" => "wrong request" 
			) );
		}
	}
	public function deldir($dir) {
		// 先删除目录下的文件：
		$dh = opendir ( $dir );
		while ( $file = readdir ( $dh ) ) {
			if ($file != "." && $file != "..") {
				$fullpath = $dir . "/" . $file;
				if (! is_dir ( $fullpath )) {
					unlink ( $fullpath );
				} else {
					$this->deldir ( $fullpath );
				}
			}
		}
		
		closedir ( $dh );
		// 删除当前文件夹：
		if (rmdir ( $dir )) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * 删除一个视频项，包括分组关系和文件
	 */
	public function postDelete() {
		$id = Input::get ( "id" );
		if (Video::find ( $id )->user_id == Auth::id ()) {
			$video = Video::find ( $id );
			$this->deldir ( "video/" . $video->id );
			$DB::table ( 'videorelation' )->where ( 'video_id', '=', $video->id )->delete ();
			$video->delete ();
			return Response::json ( array (
					"success" => "ok" 
			) );
		} else {
			return Response::json ( array (
					"error" => "wrong request" 
			) );
		}
	}
	/**
	 * 清除未上传成功的视频
	 */
	public function getClear() {
		$user = User::find ( Input::get ( 'id' ) );
		$user->videos ()->where ( 'status', '<>', '0' )->delete ();
		$this->delDir ( 'temp' );
	}
	/**
	 * 建立一个status=1的视频项
	 */
	public function getCreate() {
		$type = Input::get ( 'file_type' );
		if ($type != 'flv' && $type != 'ogg' && $type != 'mp4' && $type != 'mov' && $type != 'wmv' && $type != 'mpeg')
			return Response::json ( array (
					'error' => 'not supported type' 
			) );
		$user = Auth::user ();
		if (Video::where ( 'user_id', '=', $user->id )->where ( 'status', '<>', '0' )->where ( 'name', '=', Input::get ( 'file_name' ) )->count () > 0)
			return Response::json ( array (
					'success' => 'continue' 
			) );
		if (Video::where ( 'user_id', '=', $user->id )->where ( 'status', '<>', '0' )->count () > 0)
			return Response::json ( array (
					'error' => 'have unuploaded video' 
			) );
		$video = new Video ();
		$video->status = 1;
		$video->user_id = $user->id;
		$video->name = Input::get ( 'file_name' );
		$video->save ();
		return Response::json ( array (
				'success' => 'new' 
		) );
	}
	/**
	 * 发布status=2的视频
	 */
	public function postPublish() {
		$video = Video::where ( 'user_id', '=', Auth::id () )->where ( 'status', '=', '2' )->firstOrFail ();
		$name = Input::get ( 'name' );
		$introduction = Input::get ( 'introduction' );
		$video->name = $name;
		$video->introduction = $introduction;
		$video->status = 0;
		$video->publishTime = date ( "Y-m-d H:i:s", time () );
		$video->save ();
		return Response::json ( array (
				'success' => 'published' 
		) );
	}
	/**
	 * 获得视频的分组情况
	 */
	public function postGroups() {
		$vid = Input::get ( 'vid' );
		$groups = DB::table ( 'videorelation' )->where ( 'video_id', '=', $vid )->get ();
		$ret = [ ];
		foreach ( $groups as $group ) {
			$ret [$group->group_id] = '1';
		}
		return Response::json($ret);
	}
	/**
	 * 更新视频的分组情况
	 */
	public function postUpdateGroup() {
		$json = json_decode ( Input::get ( 'data' ), true );
		$vid = Input::get ( 'vid' );
		foreach ( $json as $gid => $data ) {
			$relation = [ 
					'video_id' => $vid,
					'group_id' => $gid 
			];
			$count = count ( DB::table ( 'videorelation' )->where ( $relation )->get () );
			if ($data == '0')
				DB::table ( 'videorelation' )->where ( $relation )->delete();
			else
			if ($count == 0)
				DB::table ( 'videorelation' )->insert ( $relation );
		}
		return Response::json(array('success'=>'1'));
	}
	public function getUpload() {
		return $this->Upload ();
	}
	public function postUpload() {
		return $this->Upload ();
	}
	
	/**
	 * 业务逻辑：
	 * 用户开始上传->建立新的视频项目，标记为上传中，一个用户只允许一个未上传完毕的视频
	 * 上传成功->将该标记改完上传成功，也就是可以发布该视频了
	 * 继续上传->用户选择继续上传一个未上传完毕的视频，检查文件信息是否匹配
	 */
	public function Upload() {
		// //////////////////////////////////////////////////////////////////
		// THE SCRIPT
		// //////////////////////////////////////////////////////////////////
		
		// check if request is GET and the requested chunk exists or not. this makes testChunks work
		if ($_SERVER ['REQUEST_METHOD'] === 'GET') {
			$temp_dir = 'temp/' . $_GET ['resumableIdentifier'];
			$chunk_file = $temp_dir . '/' . $_GET ['resumableFilename'] . '.part' . $_GET ['resumableChunkNumber'];
			
			if (file_exists ( $chunk_file )) {
				header ( "HTTP/1.0 200 Ok" );
			} else {
				App::abort ( 404 ); // header("HTTP/1.0 404 Not Found");
			}
		}
		// loop through files and move the chunks to a temporarily created directory
		if (! empty ( $_FILES ))
			foreach ( $_FILES as $file ) {
				
				// check the error status
				if ($file ['error'] != 0) {
					$this->_log ( 'error ' . $file ['error'] . ' in file ' . $_POST ['resumableFilename'] );
					continue;
				}
				
				// init the destination file (format <filename.ext>.part<#chunk>
				// the file is stored in a temporary directory
				$temp_dir = 'temp/' . $_POST ['resumableIdentifier'];
				$dest_file = $temp_dir . '/' . $_POST ['resumableFilename'] . '.part' . $_POST ['resumableChunkNumber'];
				// create the temporary directory
				if (! is_dir ( $temp_dir )) {
					mkdir ( $temp_dir, 0777, true );
				}
				// move the temporary file
				$tmp_name = $file ['tmp_name'];
				if (! move_uploaded_file ( $file ['tmp_name'], iconv ( "UTF-8", "gb2312", $dest_file ) )) {
					$this->_log ( 'Error saving (move_uploaded_file) chunk ' . $_POST ['resumableChunkNumber'] . ' for file ' . $_POST ['resumableFilename'] );
				} else {
					
					// check if all the parts present, and create the final destination file
					$this->createFileFromChunks ( $temp_dir, iconv ( "UTF-8", "gb2312", $_POST ['resumableFilename'] ), $_POST ['resumableChunkSize'], $_POST ['resumableTotalSize'] );
				}
			}
		header ( "HTTP/1.0 200 Ok" );
	}
	function _log($str) {
		
		// log to the output
		$log_str = date ( 'd.m.Y' ) . ": {$str}\r\n";
		echo $log_str;
		
		// log to file
		if (($fp = fopen ( 'upload_log.txt', 'a+' )) !== false) {
			fputs ( $fp, $log_str );
			fclose ( $fp );
		}
	}
	
	/**
	 *
	 *
	 *
	 *
	 * Delete a directory RECURSIVELY
	 *
	 * @param string $dir
	 *        	- directory path
	 * @link http://php.net/manual/en/function.rmdir.php
	 */
	function rrmdir($dir) {
		if (is_dir ( $dir )) {
			$objects = scandir ( $dir );
			foreach ( $objects as $object ) {
				if ($object != "." && $object != "..") {
					if (filetype ( $dir . "/" . $object ) == "dir") {
						$this->rrmdir ( $dir . "/" . $object );
					} else {
						unlink ( $dir . "/" . $object );
					}
				}
			}
			reset ( $objects );
			rmdir ( $dir );
		}
	}
	
	/**
	 *
	 *
	 *
	 *
	 * Check if all the parts exist, and
	 * gather all the parts of the file together
	 *
	 * @param string $dir
	 *        	- the temporary directory holding all the parts of the file
	 * @param string $fileName
	 *        	- the original file name
	 * @param string $chunkSize
	 *        	- each chunk size (in bytes)
	 * @param string $totalSize
	 *        	- original file size (in bytes)
	 */
	function createFileFromChunks($temp_dir, $fileName, $chunkSize, $totalSize) {
		
		// count all the parts of this file
		$total_files = 0;
		foreach ( scandir ( $temp_dir ) as $file ) {
			if (stripos ( $file, $fileName ) !== false) {
				$total_files ++;
			}
		}
		
		// check that all the parts are present
		// the size of the last part is between chunkSize and 2*$chunkSize
		if ($total_files * $chunkSize >= ($totalSize - $chunkSize + 1)) {
			$vid = 'temp';
			foreach ( Video::where ( 'user_id', '=', Auth::id () )->where ( 'status', '<>', '0' )->get () as $video ) {
				$vid = $video->id;
			}
			if (!file_exists('video'))mkdir ( 'video' );
			mkdir ( 'video/' . $vid );
			$route = 'video/' . $vid;
			// create the final destination file
			if (($fp = fopen ( $route . '/' . $fileName, 'w' )) !== false) {
				for($i = 1; $i <= $total_files; $i ++) {
					fwrite ( $fp, file_get_contents ( $temp_dir . '/' . $fileName . '.part' . $i ) );
					$this->_log ( 'writing chunk ' . $i );
				}
				fclose ( $fp );
				Video::where ( 'user_id', '=', Auth::id () )->where ( 'status', '=', '1' )->update ( array (
						'status' => '2',
						'path' => $route . '/video.flv' 
				) );
				$this->createThumbnail ( $route, $fileName );
				$this->translate ( $route, $fileName );
			} else {
				$this->_log ( 'cannot create the destination file' );
				return false;
			}
			
			// rename the temporary directory (to avoid access from other
			// concurrent chunks uploads) and than delete it
			if (rename ( $temp_dir, $temp_dir . '_UNUSED' )) {
				$this->rrmdir ( $temp_dir . '_UNUSED' );
			} else {
				$this->rrmdir ( $temp_dir );
			}
		}
	}
	public function translate($route, $filename) {
		$file = $route . '/' . $filename;
		$ffmpeg_cmd = "ffmpeg -i \"" . $file . "\" -y -ab 32 -ar 22050 -b 800000 " . $route . '/video.flv';
		$this->_log ( $ffmpeg_cmd );
		$handle = popen ( $ffmpeg_cmd, "r" );
		$this->_log ( "'$handle'; " . gettype ( $handle ) . "\n" );
		$read = fread ( $handle, 2096 );
		$this->_log ( $read );
		pclose ( $handle );
	}
	public function createThumbnail($route, $fileName) {
		$file = $route . '/' . $fileName;
		$time = 0.001;
		$thumbName = $route . '/' . "_thumb.jpg";
		$ffmpeg_cmd = "ffmpeg -i \"" . $file . "\" -y -f image2 -ss 1.01 -t " . $time . " -s 320*240 " . $thumbName;
		$this->_log ( $ffmpeg_cmd );
		$handle = popen ( $ffmpeg_cmd, "r" );
		$this->_log ( "'$handle'; " . gettype ( $handle ) . "\n" );
		$read = fread ( $handle, 2096 );
		$this->_log ( $read );
		pclose ( $handle );
	}
}
