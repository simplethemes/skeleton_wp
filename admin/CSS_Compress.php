<?php
/*
Created By: Jeffrey Way
URL: http://net.tutsplus.com
Date: 7/23/2011
License: DoWhatevaYaWantWithIt
*/

class CSS_Compress {
    public $compressed_css;
    protected $path;
    
    function __construct($stylesheets, $path = '')
    {
        $this->path = $path;
        $this->compress($stylesheets );
    }
    
    protected function compress($stylesheets)
    {
        if (empty($this->path) ) {
            $pieces = explode('.css', is_array($stylesheets) ? $stylesheets[0] : $stylesheets );
            $this->path = $pieces[0] . '_min.css';
        }

        // Did they pass a list of stylesheets to compress + concatenate?
        if (is_array($stylesheets) ) {
            array_walk($stylesheets, function(&$val) {
                $val = CSS_Compress::replace($val);
            });
        } else {
            $stylesheets = $this->replace($stylesheets);
        }
        
        $this->compressed_css = implode((array) $stylesheets );
    }
    
    public function get_css()
    {
        return $this->compressed_css;
    }
    
    public function save_as($path = '')
    {
        if (!empty($path) ) {
            $this->path = $path;
        }
        $file_name = end(explode('/', $this->path) );
        header("Content-Disposition: attachment, filename=$file_name");
        header("Content-type: application/octet-stream");
        echo implode((array)$this->compressed_css);
    }
    
    public function save($path = '')
    {
        if (!empty($path) ) {
            $this->path = $path;
        }
        $this->create_directories();
        file_put_contents($this->path, $this->compressed_css );
    }
    
    public function replace($file)
    { 
       $path = ( false !== strstr($file, '{') ) ? $file : implode( file($file) );
       return preg_replace('/(?<=[;\s}])\s|(?<=:)\s|\s(?={\s)|[\r\n]|\/\*.+?\*\//ms', '', $path );
    }
    
    protected function create_directories()
    {
        $dirs =
           explode(
              end(
                 explode('/', $this->path)
              ),
           $this->path
        );
        
        !file_exists($dirs[0]) && mkdir($dirs[0], 0777, true );
    }
    
}