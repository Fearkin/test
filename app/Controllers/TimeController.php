<?php

namespace App\Controllers;

use DateTime;
use Hleb\Constructor\Handlers\Request;

class TimeController extends \MainController
{
   private function getTime($format)
   {
      if ($format === "unix"){
         $mt = explode(' ', microtime());
         return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
      } else if ($format === "mysql"){
         $date = new DateTime();
         return $date->format('Y-m-d H:i:s');
      }
   }

   public function handleRequest()
   {
      $json = self::parseRequest(Request::getJsonBodyList());
      

      if (!array_key_exists('error', $json)){
         $time = self::getTime($json['params']['format']);
         $json = [
            "json-rpc" => "2.0",
            "result" => $time,
            "id" => $json['id']
         ];
      }
      
      return view('default', ['data' => json_encode($json)]);
   }

   private function parseRequest($json)
   {
      define("METHOD_NOT_FOUND", -32601);
      define("INVALID_METHOD_PARAMETERS", -32602);

      $error = [
         "jsonrpc" => "2.0",
         "error" => [
            "code" => 0,
            "message" => ""
         ],
         "id" => $json['id']
      ];
      
      if ($json['method'] !== "gettime"){

         $error['error']['code'] = METHOD_NOT_FOUND;
         $error['error']['message'] = "Method not found";

         return $error; 
      }

      $params = $json['params'];


      if ((!array_key_exists("format", $params))
         or ($params['format'] !== "unix"
         and $params['format'] !== "mysql")){

         $error['error']['code'] = INVALID_METHOD_PARAMETERS;
         $error['error']['message'] = "Invalid method parameter(s)";

         return $error;
      }
      
      return $json;
   }
}

