<?php
namespace App\Http\Traits;

use \Illuminate\Support\Facades\DB;

trait dropDownListTraits
{


    private function sideDefectsList()
    {

        return DB::table('side_defects')->get()->pluck('side_defect_name','id');
    }

   private function sauseOfDefectsList()
   {

       return DB::table('sause_of_defects')->get()->pluck('sause_of_defect_name','id');
   }

    private function CitiesList()
    {

      return DB::table('cities')->get()->pluck('city_name','id');
    }


}