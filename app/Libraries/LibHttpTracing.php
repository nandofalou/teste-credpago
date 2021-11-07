<?php

namespace App\Libraries;

/**
 * Library to track website
 *
 * @author fernando<nando.falou@gmail.com>
 */
class LibHttpTracing {

    protected $version = '1.0.0';
    protected $client;
    protected $statusCode;
    protected $body;
    protected $headers;
    protected $error;
    protected $debug = false;

    public function __construct() {
        $this->client = \Config\Services::curlrequest([
                    'timeout' => 30
        ]);

        $this->setHeader('Accept', '*/*');
        $this->setHeader('Cache-Control', 'no-cache');
        $this->setHeader('Accept-Encoding', 'gzip, deflate, br');
        $this->setHeader('Connection', 'keep-alive');
        $this->setHeader('user-agent', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36');
    }

    /**
     * Set debug as active
     * @param type $is
     */
    public function setDebug($is = true) {
        $this->debug = (bool) $is;
        return $this;
    }

    /**
     * Set Header
     * @param string $key Accept-Encoding
     * @param string $value gzip, deflate, br
     */
    public function setHeader($key, $value) {
        $this->headers[$key] = $value;
    }

    /**
     * Cleare Header
     */
    public function clearHeader() {
        $this->headers = array();
    }

    public function trackSite($url) {
        $this->statusCode = null;
        $this->body = null;
        $this->error = null;

        $options['http_errors'] = false;
        $options['verify'] = false;
        $options['connect_timeout'] = 0;
        //$options['baseURI'] = trim($url);
        if ($this->debug) {
            $options['debug'] = true; //
        }

        try {
            $response = $this->client->request('get', $url, $options);
            $this->statusCode = $response->getStatusCode();
            $this->body = $this->content($response);
            return true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * get Request Status Code (200, 401 ...)
     * @return integer
     */
    public function getStatusCode() {
        return (int) $this->statusCode;
    }

    /**
     * get response content
     * @return String
     */
    public function getContent() {
        return $this->body;
    }

    /**
     * clean content
     * @param response $request
     * @return mixed
     */
    protected function content($request) {
        $body = '';
        $Encoding = trim($request->getHeaderLine('Content-Encoding'));
        if ($Encoding === 'gzip') {
            $body = gzdecode($request->getBody());
        } else {
            $body = $request->getBody();
        }

        $type = trim($request->getHeaderLine('Content-Type'));
        if (strpos($type, 'json')) {
            $body = json_decode($body);
        }

        return (string) $body;
    }

}
