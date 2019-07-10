<?php 

namespace Braspag\Request;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;

class Request {
    
    private function send($url, $method, $body, $headers = [], $options = [], $auth = [], $form_params = [])
    {
        $client = new GuzzleClient($options);
        $request_params = [
            'http_errors' => false,
            'headers' => $headers,
            'json' => $this->removeEmptyKeys($body),
            'auth' => $auth,
            'form_params' => $form_params
        ];
        $request_params = array_filter($request_params); // Remove null and empty array fields

        try {
            $callback = $client->request($method, $url, $request_params);
        } catch (ConnectException $ex) {
            $timeout = true;
            $exception_message = $ex->getMessage();
        }

        $response['timeout'] = isset($timeout);
        $response['exception_message'] = isset($exception_message) ? $exception_message : null;
        $response['decoded_json'] = isset($callback) ? json_decode($callback->getBody()) : null;
        $response['decoded_array'] = isset($callback) ? json_decode($callback->getBody(), true) : null;
        $response['json'] = isset($callback) ? json_encode($response['decoded_json']) : null;
        $response['html_status'] = isset($callback) ? $callback->getStatusCode() : null;
        
        return $response;
    }
        
    public function get($url, $headers = [], $options = [], $auth = [])
    {
        return $this->send($url, 'GET', [], $headers, $options, $auth, []);
    }
    
    public function post($url, $body, $headers = [], $options = [], $auth = [], $form_params = [])
    {
        return $this->send($url, 'POST', $body, $headers, $options, $auth, $form_params);
    }
    
    public function put($url, $body, $headers = [], $options = [], $auth = [], $form_params = [])
    {
        return $this->send($url, 'PUT', $body, $headers, $options, $auth, $form_params);
    }
    
    public function delete($url, $body, $headers = [], $options = [], $auth = [], $form_params = [])
    {
        return $this->send($url, 'DELETE', $body, $headers, $options, $auth, $form_params);
    }

    private function removeEmptyKeys($data)
    {
        if (!$data) return [];
        foreach ($data as $key => $value) {
            if (gettype($data[$key]) == 'array') {
                $data[$key] = $this->removeEmptyKeys($data[$key]);
            } else if ($value == null) {
                unset($data[$key]);
            }
        }
        return $data;
    }
}