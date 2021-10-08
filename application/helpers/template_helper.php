<?php
//Dynamically add Javascript files to header page
if(!function_exists('add_js')){
    function add_js($file='')
    {
        $str = '';
        $ci = &get_instance();
        $header_js  = $ci->config->item('header_js');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $header_js[] = $item;
            }
            $ci->config->set_item('header_js',$header_js);
        }else{
            $str = $file;
            $header_js[] = $str;
            $ci->config->set_item('header_js',$header_js);
        }
    }
}

//Dynamically add CSS files to header page
if(!function_exists('add_css')){
    function add_css($file='')
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){   
                $header_css[] = $item;
            }
            $ci->config->set_item('header_css',$header_css);
        }else{
            $str = $file;
            $header_css[] = $str;
            $ci->config->set_item('header_css',$header_css);
        }
    }
}

//Dynamicaly put js and css to header
if(!function_exists('put_headers')){
    function put_headers()
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');
        $header_js  = $ci->config->item('header_js');

        foreach($header_css AS $item){
            $str .= '<link rel="stylesheet" href="'.base_url().$item.'" type="text/css" />'."\n";
        }

        foreach($header_js AS $item){
            $str .= '<script  src="'.base_url().$item.'"></script>'."\n";
        }

        return $str;
    }
}

//Dynamically add Javascript files to footer page
if(!function_exists('add_footer_js')){
    function add_footer_js($file='')
    {
        $str = '';
        $ci = &get_instance();
        $footer_js  = $ci->config->item('footer_js');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $footer_js[] = $item;
            }
            $ci->config->set_item('footer_js',$footer_js);
        }else{
            $str = $file;
            $footer_js[] = $str;
            $ci->config->set_item('footer_js',$footer_js);
        }
    }
}

//Dynmicaly put your js in footer 
if(!function_exists('put_footers')){
    function put_footers()
    {
        $str = '';
        $ci = &get_instance();
        $footer_js  = $ci->config->item('footer_js');

        foreach($footer_js AS $item){
            $str .= '<script  src="'.base_url().$item.'"></script>'."\n";
        }

        return $str;
    }
}

//##################################################### Admin  Css & js ###################################################
//Dynamically add Javascript files to header page
if(!function_exists('addmin_js')){
    function addmin_js($file='')
    {
        $str = '';
        $ci = &get_instance();
        $header_js  = $ci->config->item('admin_header_js');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $header_js[] = $item;
            }
            $ci->config->set_item('admin_header_js',$header_js);
        }else{
            $str = $file;
            $header_js[] = $str;
            $ci->config->set_item('admin_header_js',$header_js);
        }
    }
}

//Dynamically add CSS files to header page
if(!function_exists('addmin_css')){
    function addmin_css($file='')
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('admin_header_css');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){   
                $header_css[] = $item;
            }
            $ci->config->set_item('admin_header_css',$header_css);
        }else{
            $str = $file;
            $header_css[] = $str;
            $ci->config->set_item('admin_header_css',$header_css);
        }
    }
}

//Dynamicaly put js and css to header
if(!function_exists('put_admin_headers')){
    function put_admin_headers()
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('admin_header_css');
        $header_js  = $ci->config->item('admin_header_js');

        foreach($header_css AS $item){
            $str .= '<link rel="stylesheet" href="'.base_url('webroot/').$item.'" type="text/css" />'."\n";
        }

        foreach($header_js AS $item){
            $str .= '<script type="text/javascript" src="'.base_url('webroot/').$item.'"></script>'."\n";
        }

        return $str;
    }
}

//Dynamically add Javascript files to footer page
if(!function_exists('add_admin_footer_js')){
    function add_admin_footer_js($file='')
    {
        $str = '';
        $ci = &get_instance();
        $footer_js  = $ci->config->item('admin_footer_js');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $footer_js[] = $item;
            }
            $ci->config->set_item('admin_footer_js',$footer_js);
        }else{
            $str = $file;
            $footer_js[] = $str;
            $ci->config->set_item('admin_footer_js',$footer_js);
        }
    }
}

//Dynmicaly put your js in footer 
if(!function_exists('put_admin_footers')){
    function put_admin_footers()
    {
        $str = '';
        $ci = &get_instance();
        $footer_js  = $ci->config->item('admin_footer_js');

        foreach($footer_js AS $item){
            $str .= '<script type="text/javascript" src="'.base_url('webroot/').$item.'"></script>'."\n";
        }

        return $str;
    }
}
