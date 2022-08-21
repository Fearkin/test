<?php

namespace App\Models;

use DB;

class TimeModel extends \MainModel
{
   static public function getMysqlDatetime(): string
   {
      DB::run($sql);
   }
}

