==已知bugs==
Mediawiki1.20.5下

**在点开【摘要：仅供管理使用】后，输入的内容会被重复添加至文件描述页面两次，需要尽快修复。bug描述参见这里：[http://zh.moegirl.org/index.php?title=Special:WikiForum&thread=148]
**使用URL服务器对传图片的时候，写在人物名 作者 源地址 三个框内的内容不能被正常添加到文件描述页面。    


MoeUpload
=========
MediaWIKI插件，现在用于萌娘百科

适用版本为MediaWIKI1.20+ （1.21未测试，不保证可用）

使用方法:

LocalSettings.php 加入

require_once( "$IP/extensions/MoeUpload/MoeUpload.php" );

