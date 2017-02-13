<?php
/**
 * @Describe : simulation http request
 * @Date: 2017/02/13
 * @Student: GongBiao
 */

// defined interface
interface Proto {
    // connect
    function conn($url);

    // send get query
    function get();

    // send post query
    function post();

    // close connect
    function close();

}


class Http implements Proto {

    const CRLF          = "\r\n";
    private $url        = array();
    private $version    ='HTTP/1.1';

    private $fh         = null;
    private $errno      = -1;
    private $errstr     = '';
    private $response   = '';

    private $line       = array();
    private $header     = array();
    private $body       = array();

    function __construct($url){
        $this->conn($url);
        $this->setHeader('Host: ' . $this->url['host']);
        $this->setHeader('User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.12; rv:51.0) Gecko/20100101 Firefox/51.0');
        $this->setHeader('Connection: Close');
    }

    // set line
    protected function setLine($method){
        $this->line[] = $method . ' ' . $this->url['path'] . ' ' .$this->version;
    }
    // set header
    protected function setHeader($header_line){
       $this->header[] = $header_line;
    }


    // connect
    function conn($url){
       $this->url = parse_url($url);
        if(!isset($this->url['port'])){
            $this->url['port'] = 80;
        }

        $this->fh = fsockopen($this->url['host'], $this->url['port'], $this->errno, $this->errstr, 30);
    }

    // request
    function request(){
       // merge line, header, body
        $req = array_merge($this->line, $this->header, array(''), $this->body, array(''));
        $req = implode(self::CRLF, $req);
        echo $req;
        fwrite($this->fh, $req);
        while(!feof($this->fh)){
            $this->response .= fread($this->fh, 1024);
        }

        $this->close();
        return $this->response;
    }

    // send get query
    function get(){
        $this->setLine('GET');
        $this->request();
        return $this->response;

    }

    // send post query
    function post(){

    }

    // close connect
    function close(){
        fclose($this->fh);
    }
}

