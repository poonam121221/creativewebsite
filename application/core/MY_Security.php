<?php
class MY_Security extends CI_Security {

    public function __construct()
    {
        parent::__construct();      
    }

    /**
	 * Show CSRF Error
	 *
	 * @return	void
	 */
	public function csrf_show_error()
	{
		show_error('The action you have requested is not allowed.', 403);
        //show_403();
    }
    
}//end class MY_Security