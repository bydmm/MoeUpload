<?php   
//ugly but useful 
//在上传界面增加三个字段

if (!defined('MEDIAWIKI')) {
	exit;
}

$wgExtensionCredits['specialpage'][] = array(
	'path'           => __FILE__,
	'name'           => 'MoeUpload',
	'descriptionmsg' => 'moemoeQdec',
	'author'         => array('zoglun','March'),
	'url'            => 'http://wiki.moegirl.org/Mainpage',
	'version'        => '1.0',
);

$wgExtensionMessagesFiles['moemoeQ'] = dirname(__FILE__).'/'. 'MoeUpload.i18n.php';

$wgHooks['UploadFormInitDescriptor'][] = 'onUploadFormInitDescriptor';
$wgHooks['UploadForm:BeforeProcessing'][] = 'BeforeProcessing';

function onUploadFormInitDescriptor( $descriptor ) { 
	var_dump($descriptor);
	$descriptor += array(
		'NickName' => array(
			'type' => 'text',
			'section' => 'description',
			'id' => 'wpNickName',
			'label-message' => 'moemoeQNickName',
			'size' => 60,
			//'default' => $this->mNickName,
		),
		'Author' => array(
			'type' => 'text',
			'section' => 'description',
			'id' => 'wpAuthor',
			'label-message' => 'moemoeQAuthor',
			'size' => 60,
			//'default' => $this->mAuthor,
		),
		'SrcUrl' => array(
			'type' => 'text',
			'section' => 'description',
			'id' => 'wpSrcUrl',
			'label-message' => 'moemoeQSrcUrl',
			'size' => 60,
			//'default' => $this->mSrcUrl,
		)
	);
	return $descriptor;
}

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

?>
