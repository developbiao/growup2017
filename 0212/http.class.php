<?php

/*
PHP+socket编程 发送HTTP请求
要求能 模拟下载，注册，登陆，批量发帖
*/

// http请求类的接口
interface Proto{
	// 连接类的接口
	function conn($url);

	// 发送get查询
	function get();

	// 发送post查询
	function post();	

	// 关闭连接
	function close();
}

class Http implements Proto {

	const CRLF = "\r\n";	

	protected $errno 	= -1;
	protected $errstr 	= '';
	protected $response = '';

	protected $url  	= array();
	protected $version	= 'HTTP/1.1';
	protected $fh		= null;

	protected $line 	= array();
	protected $header 	= array();
	protected $body 	= array();

	public function __construct($url){
		$this->conn($url);
		$this->setHeader('Host: ' . $this->url['host']);
		$this->setHeader('User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.12; rv:51.0) Gecko/20100101 Firefox/51.0');
		$this->setHeader('Connection: Close');

	}

	// 此方法负责写请求行
	protected function setLine($method){
		$this->line[0] = $method . ' ' . $this->url['path'] . ' ' . $this->version;

	}

	// 此主法负责写主头信息
	protected function setHeader($header_line){
		$this->header[] = $header_line;

	}

	// 此方法负责写主体信息
	protected function setBody(){

	}

	// 连接url的接口
	public function conn($url){
		$this->url = parse_url($url);
		// 判断端口
		if(!isset($this->url['port'])){
			$this->url['port'] = 80;
		}


		$this->fh = fsockopen($this->url['host'], $this->url['port'], $this->errno, $this->errstr, 3);

	}

	// 构造get查询
	public function get(){
		$this->setLine('GET');
		$this->request();
		return $this->response;

	}

	// 构造post查询
	public function post(){

	}

	// 真正的请求
	public function request(){
		// 把请求行， 头信息，实体信息，放在一个数组里，便于拼接
		$req = array_merge($this->line, $this->header, array(''), $this->body, array(''));
		$req = implode(self::CRLF, $req);
		echo $req;

		fwrite($this->fh, $req);
		while(!feof($this->fh)){
			$this->response .= fread($this->fh, 1024);
		}

		$this->close(); // 关闭连接
		return $this->response;

	}

	// 关闭连接
	public function close(){

	}


}


// ###############  测试单元 ###################

$url = 'http://huaban.com/purple';

$http = new Http($url);
$data = $http->get();
echo $data;





