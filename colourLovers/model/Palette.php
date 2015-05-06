<?php namespace colourLovers\model;

use colourLovers\net\PaletteConnections;

class Palette extends PaletteConnections{
    private $_raw;
    
    protected $palette_id;
    protected $title;
    protected $username;
    protected $views;
    protected $votes;
    protected $hearts;
    protected $rank;
    protected $colors;
    protected $created;
    protected $description;
    protected $url;
    
    function __construct($colorData=[]){
        
        if( !count($colorData) ) return;
        
        $palette=$colorData;
        
        $this->_raw=$colorData;
        
        if( array_key_exists( 'id', $palette ) )            $this->palette_id=$palette->id;
        if( array_key_exists( 'title', $palette ) )         $this->title= (string) $palette->title; 
        if( array_key_exists( 'userName', $palette ) )      $this->username= (string) $palette->userName;
        if( array_key_exists( 'numViews', $palette ) )      $this->views=$palette->numViews;
        if( array_key_exists( 'numVotes', $palette ) )      $this->votes=$palette->numVotes;
        if( array_key_exists( 'numHears', $palette ) )      $this->hearts=$palette->numHearts;
        if( array_key_exists( 'rank', $palette ) )          $this->rank=$palette->rank;
        if( array_key_exists( 'dateCreated', $palette ) )   $this->created=$palette->dateCreated;
        if( array_key_exists( 'description', $palette ) )   $this->description= (string) $palette->description;
        if( array_key_exists( 'url', $palette ) )           $this->url= (string ) $palette->url;
        if( array_key_exists( 'colors', $palette ) )        $this->colors= (array) $palette->colors->hex; 
    
    }
    
    public function getPaletteRaw(){
        return $this->_raw;
    }
    
    public function getPalette_id(){
        return $this->palette_id;
    }
    
    public function getTitle(){
        return $this->title;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function getViews(){
        return $this->views;
    }
    
    public function getVotes(){
        return $this->votes;
    }
    
    public function getHearts(){
        return $this->hearts;
    }
    
    public function getRank(){
        return $this->rank;
    }
    
    public function getCreated(){
        return $this->created;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function getUrl(){
        return $this->url;
    }
    
    public function getColors(){
        return $this->colors;
    }
    
    public function getColorsSorted(){
        return (count($this->colors)) ? $this->cf_sort_hex_colors( $this->colors ) : array();
    }
    
    private function cf_sort_hex_colors($colors) {
        $map = array(
            '0' => 0,
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9,
            'a' => 10,
            'b' => 11,
            'c' => 12,
            'd' => 13,
            'e' => 14,
            'f' => 15,
        );
        $c = 0;
        $sorted = array();
        foreach ($colors as $color) {
            $color = strtolower(str_replace('#', '', $color));
            if (strlen($color) == 6) {
                $condensed = '';
                $i = 0;
                foreach (preg_split('//', $color, -1, PREG_SPLIT_NO_EMPTY) as $char) {
                    if ($i % 2 == 0) {
                        $condensed .= $char;
                    }
                    $i++;
                }
                $color_str = $condensed;
            }
            $value = 0;
            foreach (preg_split('//', $color_str, -1, PREG_SPLIT_NO_EMPTY) as $char) {
                $value += intval($map[$char]);
            }
            $value = str_pad($value, 5, '0', STR_PAD_LEFT);
            $sorted['_'.$value.$c] = $color;
            $c++;
        }
        ksort($sorted);
        return $sorted;
    }    
}