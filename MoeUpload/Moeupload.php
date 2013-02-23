<?php   
//ugly but useful 
//在上传界面增加三个字段

if (!defined('MEDIAWIKI')) {
        echo <<<EOT
To install my extension, put the following line in LocalSettings.php:
require_once( "\$IP/extensions/EditImage/EditImage.php" );
EOT;
        exit( 1 );
}

$wgHooks['UploadFormInitDescriptor'][] = 'onUploadFormInitDescriptor';
$wgHooks['UploadForm:BeforeProcessing'][] = 'BeforeProcessing';

function BeforeProcessing( $uploadFormObj ) {
	if( $uploadFormObj->mRequest->getFileName( 'wpUploadFile' ) !== null ) {
		$uploadFormObj->mAuthor            = $uploadFormObj->mRequest->getText( 'wpAuthor' );
	  $uploadFormObj->mSrcUrl            = $uploadFormObj->mRequest->getText( 'wpSrcUrl' );
	  $uploadFormObj->mNickName          = $uploadFormObj->mRequest->getText( 'wpNickName' );
	  foreach (explode(" ", $uploadFormObj->mAuthor) as $author) {
	      if ($author != "") {
	          $uploadFormObj->mComment .= "[[分类:作者:$author]]";
	      }
	  }

	  foreach (explode(" ", $uploadFormObj->mNickName) as $catagory) {
	      if ($catagory != "") {
	          $uploadFormObj->mComment .= "[[分类:$catagory]]";
	      }
	  }
	  if ($uploadFormObj->mSrcUrl != "") {
	      $uploadFormObj->mComment .= "源地址:".$uploadFormObj->mSrcUrl;
	  }
	  if ($uploadFormObj->mRequest->getText( 'wpUploadDescription' ) != "") {
	      if ($uploadFormObj->mSrcUrl != "") {
	          $uploadFormObj->mComment .= " ";
	      }
	      $uploadFormObj->mComment .= $uploadFormObj->mRequest->getText( 'wpUploadDescription' );
	  }
	}

	return $uploadFormObj;
}

function onUploadFormInitDescriptor( $descriptor ) { 
	$descriptor += array(
		'NickName' => array(
			'type' => 'text',
			'section' => 'description',
			'id' => 'wpNickName',
			'label-message' => '人物名',
			'size' => 60,
			//'default' => $this->mNickName,
		),
		'Author' => array(
			'type' => 'text',
			'section' => 'description',
			'id' => 'wpAuthor',
			'label-message' => '作者',
			'size' => 60,
			//'default' => $this->mAuthor,
		),
		'SrcUrl' => array(
			'type' => 'text',
			'section' => 'description',
			'id' => 'wpSrcUrl',
			'label-message' => '源地址',
			'size' => 60,
			//'default' => $this->mSrcUrl,
		)
	);

	return $descriptor;
}

?>
