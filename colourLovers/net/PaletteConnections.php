<?php namespace colourLovers\net;

use colourLovers\net\CLConnector;
use colourLovers\model\Palette;

abstract class PaletteConnections extends CLConnector{
    
    function __construct(){
    }
    
    public function getRandomPalette(){
        $url='palettes/random';
        $params=array();//this api call doesn't support params
        $response=self::makeApiRequest($url);
        //return $response->palette;
        return new Palette( $response->palette );
    }
    
    public function getPaletteById($palette_id=0){
        $url="palette/" . $palette_id;
        if(!is_int($palette_id)) return new Palette;
        $response=self::makeApiRequest($url);
        return new Palette( $response->palette );        
    }
    
    public function getTopPalettes(RequestParams $p=NULL){
        $url="palettes/top";

        return $this->requestMultiplePalettes( $url, $p );
    }
    
    public function getNewPalettes(RequestParams $p=NULL){
        $url="palettes/new";
        return $this->requestMultiplePalettes( $url, $p );
    }
    
    protected function requestMultiplePalettes($url, RequestParams $p=NULL){
        $params=array();
        $palettes=array();
        
        if($p){
            $params=$p->getRequestParams();
        }
        $response=self::MakeApiRequest( $url,$params );
        
        //parse response for each palette
        foreach( $response->palette as $p ){
            $palettes[]= new Palette( $p );
        }
        
        return $palettes;    
    }

}