<?php
class Template
{
    private $pageVars = array();
    private $template;
	private $header;
	private $footer;
    private $viewDirectory;
 
    public function __construct($template)
    {
        $this->viewDirectory = SITE_ROOT_DIR . 'view';
 
		$this->header = $this->viewDirectory . '/' . 'header.php';
        $this->template = $this->viewDirectory . '/' . $template;
		$this->footer = $this->viewDirectory . '/' . 'footer.php';
    }
 
    public function set($var, $val)
    {
        $this->pageVars[$var] = $val;
    }
 
 
    public function set_header($var)
    {
        $this->header = $this->viewDirectory . SITE_DS . $var;
    }
	
	public function set_footer($var)
    {
        $this->footer = $this->viewDirectory . SITE_DS . $var;
    }
	
    public function render()
    {
        extract($this->pageVars);
        //ob_start();
		require_once($this->header);
        require_once($this->template);
        require_once($this->footer);
        //return ob_get_clean();
    }
}
