<?php
  // Copyright 2009 Google Inc. All Rights Reserved.
  $GA_PIXEL = "analytics/ga.php";

  function googleAnalyticsGetImageUrl() {
    global $GA_ACCOUNT, $GA_PIXEL;
    $url = "";
    $url .= $GA_PIXEL . "?";
    $url .= "utmac=" . $GA_ACCOUNT;
    $url .= "&utmn=" . rand(0, 0x7fffffff);

    $referer = $_SERVER["HTTP_REFERER"];
    $query = $_SERVER["QUERY_STRING"];
    $path = $_SERVER["REQUEST_URI"];

    if (empty($referer)) {
      $referer = "-";
    }
    $url .= "&utmr=" . urlencode($referer);

    if (!empty($path)) {
      $url .= "&utmp=" . urlencode($path);
    }

    $url .= "&guid=ON";

    return str_replace("&", "&amp;", $url);
  }

	class mobilePage{

		var $headers;
		var $userName;
		var $_block;
		var $_file;
		var $remoteServer = '200.58.115.134';
		var $cacheDirectory = '../cache';
		var $visitorUA = '';
		var $content;
		var $deviceInfo;
		var $noCachethisFiles;
		var $remoteContentType = 'text/html';
		function mobilePage(){
			$this->noCachethisFiles = array('tellFriend','sendMessage','rss');
			$this->_file = $_GET['file']?$_GET['file']:'index';
			$this->_block = $_GET['blockID']?$_GET['blockID']:'';
			$this->userName = get_current_user();
			$this->headers = array();
			$this->visitorUA = $_SERVER['HTTP_USER_AGENT'];
			if(isset($_GET['forcedUA']) && !empty($_GET['forcedUA'])){
				$this->visitorUA = $_GET['forcedUA'];
			}
			if(!is_dir("{$this->cacheDirectory}/{$this->userName}/img")){
				mkdir("{$this->cacheDirectory}/{$this->userName}/img");
			}
			if($_GET['op']== 'clearCache'){
				$this->clearCache();
			}
			if($_GET['op']== 'clearCacheFull'){
				$this->clearCache(true);
			}
		}

		function _colectHeaders($ch, $header){
			$arrayHeader = split(':',$header);
			$arrayHeader[0] = trim(strtolower($arrayHeader[0]));
			if(
					$arrayHeader[0]	!= 'date' &&
					$arrayHeader[0] != 'server' &&
					$arrayHeader[0] != 'http/1.1 200 ok'&&
					$arrayHeader[0] != 'x-powered-by' &&
					$arrayHeader[0] != 'transfer-encoding'&&
					$arrayHeader[0] != 'content-length'&&
					$arrayHeader[0] != 'location'&&
					$arrayHeader[0] != ''&&
					$arrayHeader[0] != 'set-cookie'){
					$this->headers[] = $header;
				}
				if(trim($arrayHeader[0]) == 'location-move' ){
					header('Location: '.trim($arrayHeader[1]),true,302);die();
				}
				if(trim($arrayHeader[0]) == 'content-type'){
					$this->remoteContentType = trim($arrayHeader[1]);
				}
				return strlen($header);
		}

		function _getRemotePage(){
			$url = "http://{$this->remoteServer}/{$this->userName}/{$this->_file}";
			$gets = array();
			foreach($_GET as $key => $value){
				$gets[$key] = "$key=$value";
			}
			foreach($_POST as $key => $value){
				$gets[$key] = "$key=".rawurlencode($value);
			}
			$gets['domainName'] = "domainName=".rawurlencode($_SERVER['HTTP_HOST']);
			if(count($gets) > 0 ){
				$url.= "?".implode ('&',$gets);
			}
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_HEADERFUNCTION, array($this, '_colectHeaders'));
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, $this->visitorUA );
			curl_setopt($ch, CURLOPT_URL, $url);
			$this->content = curl_exec($ch);
			$this->savePageCache();
			return true;
		}

		function savePageCache(){
			if(in_array($this->_file,$this->noCachethisFiles) ) return;
			if($this->remoteContentType == 'image/jpeg'){
				$fileName = "/img/{$this->_file}_{$this->_block}_{$_REQUEST['parantExt_1']}.jpg";
			}elseif($this->remoteContentType == 'image/png'){
				$fileName = "/img/{$this->_file}_{$this->_block}_{$_REQUEST['parantExt_1']}.png";
			}else{
				$fileName = md5("{$this->_file}{$this->_block}{$_REQUEST['parantExt_1']}{$_REQUEST['parantExt_2']}");
			}
			$this->_saveCache($fileName,$this->content);

		}
		
		function _saveCache($fileName,$content){
			$rs = fopen("{$this->cacheDirectory}/{$this->userName}/".$fileName,'w');
			fwrite($rs,$content);
			fclose($rs);
			//error_log($content,3, "{$this->cacheDirectory}/{$this->userName}/".$fileName);
			return true;
		}

		function _getPageCache(){
			$cacheFileName = md5("{$this->_file}{$this->_block}{$_REQUEST['parantExt_1']}{$_REQUEST['parantExt_2']}");
			$cache = $this->_getCache($cacheFileName);
			if(!$cache){
				 $this->content = '';
				 return true;
			}
			$this->content = $cache;
			return true;
		}

		function _getCache($fileName){
			if (!file_exists("{$this->cacheDirectory}/{$this->userName}/".$fileName)){
				 return false;
			}
			$rs = fopen("{$this->cacheDirectory}/{$this->userName}/".$fileName,'rb');
			return fread($rs, filesize("{$this->cacheDirectory}/{$this->userName}/".$fileName));

		}
		
		function getContent(){
			$this->_loadVisitoDeviceInfo();
			$resutl = $this->_getPageCache();
			if(!$resutl){
				$this->content = 'Opps!!! Contenido local no encontrado (Cod:30101)';
			}
			if(empty($this->content)){
				$resutl = $this->_getRemotePage();
				if(!$resutl){
					$this->content = 'Opps!!! Contenido remoto no encontrado (Cod:30102)';
				}
			}
			if(strpos($this->remoteContentType,'text')!== false){
				$this->headers[] = 'Content-Type: text/html; charset=UTF-8';
				$this->personalizeContent();
			}
			foreach($this->headers as $header){
				header($header,true);
			}
			echo $this->content;
		}

		function personalizeContent(){
			global $GA_ACCOUNT;
			$search = array();
			$replace = array();
			$match = array();
			if(preg_match('/src="[^%]*(%googleAnalytics:([^%]+)%)"/', $this->content,$match)){
				$GA_ACCOUNT = $match[2];
				$googleAnalyticsImageUrl  = googleAnalyticsGetImageUrl();
				$search[]=$match[1];
				$replace[]=$googleAnalyticsImageUrl;
				
			}
			$match = array();
			if(preg_match('/(href="(tel:([^"]+))")/', $this->content,$match)){
				if($this->deviceInfo['xhtml_make_phone_call_string']){
					$search[]=$match[2];
					$replace[]=$this->deviceInfo['xhtml_make_phone_call_string'].$match[3];
				}else{
					$search[]=$match[1];
					$replace[]="onClick=\"alert('Llamanos al {$match[3]}');return false;\"";
				}
				
			}
			$match = array();
			if(preg_match('%src="http://'.$this->remoteServer.'/logos/(([^-]+)-[0-9]{3}.png)"%', $this->content,$match)){
				if($this->deviceInfo['resolution_width'] > 500 ){
					$search[]=$match[1];
					$replace[]=$match[2]."-400.png";
				}elseif($this->deviceInfo['resolution_width'] >= 300 ){
					$search[]=$match[1];
					$replace[]=$match[2]."-300.png";
				}else{
					$search[]=$match[1];
					$replace[]=$match[2]."-200.png";
				}
			}

			$now = time();
			$expire = date("D, d M Y H:i:s",$now + 120);
			header("Expires:$expire GMT");
			header("Cache-Control:max-age=3600");
			$search[]= '%EXPIRES%';
			$replace[]= $expire;
			$this->content = str_replace($search,$replace, $this->content);

		}

		function _loadVisitoDeviceInfo(){
			$deviceDBFileName = md5('deviceDB');
			$strDeviceDB = $this->_getCache($deviceDBFileName);
			if(!$strDeviceDB){
				$arrDebiceInfo = $this->_getRemoteDeviceInfo($this->visitorUA);
				if(!$arrDebiceInfo){
					$this->deviceInfo = array();
					return false;
				}
				$this->deviceInfo = $arrDebiceInfo;
				//Create
				$deviceDB = array();
				$deviceDB[md5($this->visitorUA)] = $arrDebiceInfo;
				$strDeviceDB = serialize($deviceDB);
				$save = true;
				$this->_saveCache($deviceDBFileName, $strDeviceDB);
				return;
			}

			$deviceDB = unserialize($strDeviceDB);
			if($deviceDB){
				if(isset($deviceDB[md5($this->visitorUA)])){
					$this->deviceInfo = $deviceDB[md5($this->visitorUA)];
					return true;
				}else{
					$arrDebiceInfo = $this->_getRemoteDeviceInfo($this->visitorUA);
					if(!$arrDebiceInfo){
						$this->deviceInfo = array();
						return false;
					}
					$this->deviceInfo = $arrDebiceInfo;
					//UPDATE
					$deviceDB[md5($this->visitorUA)] = $arrDebiceInfo;
					$strDeviceDB = serialize($deviceDB);
					$this->_saveCache($deviceDBFileName, $strDeviceDB);
				}
			}else{
				$arrDebiceInfo = $this->_getRemoteDeviceInfo($this->visitorUA);
				if(!$arrDebiceInfo){
					$this->deviceInfo = array();
					return false;
				}
				$this->deviceInfo = $arrDebiceInfo;
				//OverWrite
				$deviceDB = array();
				$deviceDB[md5($this->visitorUA)] = $arrDebiceInfo;
				$strDeviceDB = serialize($deviceDB);
				$this->_saveCache($deviceDBFileName, $strDeviceDB);
			}
		}

		function _getRemoteDeviceInfo(){
			$ua = rawurlencode($this->visitorUA);
			$url = "http://{$this->remoteServer}/{$this->userName}/mobiledeviceInfo/?userAgent=$ua";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, $this->visitorUA );
			curl_setopt($ch, CURLOPT_URL, $url);
			$strResponse= curl_exec($ch);
			return unserialize($strResponse);
		}

		function clearCache($full=false){
			$MyDirectory = @opendir("{$this->cacheDirectory}/{$this->userName}");
			while($Entry = @readdir($MyDirectory)) {
				if(is_file("{$this->cacheDirectory}/{$this->userName}/{$Entry}")){
					unlink("{$this->cacheDirectory}/{$this->userName}/{$Entry}");
				}
			}
			@closedir($MyDirectory);
			if($full){
				$MyDirectory = @opendir("{$this->cacheDirectory}/{$this->userName}/img");
				while($Entry = @readdir($MyDirectory)) {
					if(is_file("{$this->cacheDirectory}/{$this->userName}/img/{$Entry}")){
						unlink("{$this->cacheDirectory}/{$this->userName}/img/{$Entry}");
					}
				}
				@closedir($MyDirectory);
			}
			return true;
		}
	}
	
?>