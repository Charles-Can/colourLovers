<?php namespace colourLovers;

use colourLovers\model as Model;

class ColourLovers{
    
    public function get_palette(){
        return new Model\Palette();
    }
    
    public function get_request_params(array $params=array()){
        return new colourLovers\net\RequestParams($params);
    }
    
}