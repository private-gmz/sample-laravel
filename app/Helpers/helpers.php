<?php
  namespace App\Helpers;
  use App\Models\RoleModel;

  class Helpers
  {
    # display product rating as stars
    static function get_rating($avarage)
    {
        $avarage = round($avarage);
        if($avarage == 0 || $avarage == NULL) 
        echo "Not Rated";
        else {
        for($i=1;$i<=$avarage;$i++){
           echo "<span class='fa fa-star checked'></span>";
        }
    }
        
    }

    # get all admin roles
    static function get_roles(){
      $allRoles = RoleModel::all();
      return $allRoles;
    }
  }
  
  ?>