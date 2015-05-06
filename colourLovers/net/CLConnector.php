<?php namespace colourLovers\net;

abstract class CLConnector {   
    
    const BASE_URL="http://www.colourlovers.com/api/";
    
    protected static function makeApiRequest($restPath, $params=array()){
        try{
            return simplexml_load_file( self::BASE_URL . $restPath . self::_buildRequestUrl($params) );
        }catch(Exception $e){
            echo 'Colour Lovers API connection Failed exception: ',  $e->getMessage(), "\n";
        }       
    }
    
    private static function _buildRequestUrl($params){
        $queryString='';
        
        if( is_array($params) ){
            foreach($params as $param => $val ){
                $queryString .= $param . '=' . $val; 
            }
        }
        return (count($queryString)) ? '?' . $queryString : $queryString;
    }       
}