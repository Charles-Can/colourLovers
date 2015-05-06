<?php namespace colourLovers\net;
    
class RequestParams{
    
    protected $_params=array();
    const API_PARAMS=array('lover',
                             'hueOption',
                             'hex',
                             'hex_logic',
                             'keywords',
                             'keywordExact',
                             'orderCol',
                             'sortBy',
                             'numResults',
                             'resultOffset',
                             'showPaletteWidths');
    
    function __construct(array $params=array() ){
        if( count($params) ){
            foreach( $params as $key => $val ){
                $this->addParam( (string) $key,$val);
            }
        }
    }
    
    public function addParam( $key, $value ){
        if( !is_string( $key ) ) return;
        
        $validated=$this->validateParam($key);
        
        if( $validated != 'not found' ){
            $this->_params[$validated]=$value;
        }
    }
    
    public function getRequestParams(){
        return $this->_params;
    }
    
    protected function validateParam($key){
        foreach( SELF::API_PARAMS AS $p ){
            if( strtolower( $p ) === strtolower($key) ){
                return $p;
            }
        }
        return 'not found';
    }
    
}