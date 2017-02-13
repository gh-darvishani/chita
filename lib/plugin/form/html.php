<?php

import::lib('plugin/plugin');
//import::lib('csrf');
// import::lang('grid',lang);

class html extends plugin {

    private $tag;
    private $xhtml;

    function init($xhtml = true) {
        $this->xhtml = $xhtml;
    }

    function startForm($action = '#', $method = 'post', $id = '', $attr_ar = array() ) {
        $str = "<form action=\"$action\" method=\"$method\"";
        if ( !empty($id) ) {
            $str .= " id=\"$id\"";
        }
        $str .= $attr_ar? $this->addAttributes( $attr_ar ) . '>': '>';
        return $str;
    }

    private function addAttributes( $attr_ar ) {
        $str = '';
        // check minimized (boolean) attributes
        $min_atts = array('checked', 'disabled', 'readonly', 'multiple',
            'required', 'autofocus', 'novalidate', 'formnovalidate'); // html5
        foreach( $attr_ar as $key=>$val ) {
            if ( in_array($key, $min_atts) ) {
                if ( !empty($val) ) {
                    $str .= $this->xhtml? " $key=\"$key\"": " $key";
                }
            } else {
                $str .= " $key=\"$val\"";
            }
        }
        return $str;
    }

    function addInput($type, $name, $value, $attr_ar = array() ) {
        $str = "<input type=\"$type\" name=\"$name\" value=\"$value\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= $this->xhtml? ' />': '>';
        return $str;
    }

    function addTextarea($name, $rows = 4, $cols = 30, $value = '', $attr_ar = array() ) {
        $str = "<textarea name=\"$name\" rows=\"$rows\" cols=\"$cols\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= ">$value</textarea>";
        return $str;
    }

    // for attribute refers to id of associated form element
    function addLabelFor($forID, $text, $attr_ar = array() ) {
        $str = "<label for=\"$forID\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= ">$text</label>";
        return $str;
    }

    // from parallel arrays for option values and text
    function addSelectListArrays($name, $val_list, $txt_list, $selected_value = NULL,
                                 $header = NULL, $attr_ar = array() ) {
        $option_list = array_combine( $val_list, $txt_list );
        $str = $this->addSelectList($name, $option_list, true, $selected_value, $header, $attr_ar );
        return $str;
    }

    // option values and text come from one array (can be assoc)
    // $bVal false if text serves as value (no value attr)
    function addSelectList($name, $option_list, $bVal = true, $selected_value = NULL,
                           $header = NULL, $attr_ar = array() ) {
        $str = "<select name=\"$name\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= ">\n";
        if ( isset($header) ) {
            $str .= "  <option value=\"\">$header</option>\n";
        }
        foreach ( $option_list as $val => $text ) {
            $str .= $bVal? "  <option value=\"$val\"": "  <option";
            if ( isset($selected_value) && ( $selected_value === $val || $selected_value === $text) ) {
                $str .= $this->xhtml? ' selected="selected"': ' selected';
            }
            $str .= ">$text</option>\n";
        }
        $str .= "</select>";
        return $str;
    }

    function endForm() {
        return "</form>";
    }

    function startTag($tag, $attr_ar = array() ) {
        $this->tag = $tag;
        $str = "<$tag";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= '>';
        return $str;
    }

    function endTag($tag = '') {
        $str = $tag? "</$tag>": "</$this->tag>";
        $this->tag = '';
        return $str;
    }

    function addEmptyTag($tag, $attr_ar = array() ) {
        $str = "<$tag";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= $this->xhtml? ' />': '>';
        return $str;
    }
    public function addA($url,$value,$attr=[]){
        $m="<a href='$url' ";
        $m.=$this->addAttributes($attr);
        $m.=">";
        $m.=$value;
        $m.="</a>";
        return $m;
    }
    public function ckEditor($textId){
        $jsFile=import::fileWithUrl('/lib/plugin/form/editor/ckeditor.js');
        $mm= '<script src="'.$jsFile.'"></script> <script data-sample="1">
				CKEDITOR.replace("'.$textId.'", {
					 toolbar : \'full\',
				} );
			</script>';
        return $mm;
    }
//
//
//    private $filed=[];
//    private $attr=[];
//    public function __call($name, $arguments=[])
//    {
//
//       array_push( $this->filed ,[$name,$arguments]);
//
//    }
//    public function _html($html,$value='')
//        {
//
//        }
//
//    public function init()
//
//    {
//        $this->plugin_name="html";
//    }
//    function display($style=''){
//         echo '<div style = "'.$style.' ">';
//
//       foreach ($this->filed as $item)
//        {
//
//
//            $arg='';
//
//
//            foreach ($item[1] as  $k=>$value) {
//                foreach ($value as $key => $va) {
//
//                    $arg .= $key . "='" . $va . "'";
//                 }
//            }
//            $html_char=['br','hr','p'];
//            if(in_array($item[0],$html_char)){
//                echo "<".$item[0]. " ".$arg."></".$item[0].">";
//            }else
//            {
//                echo '<input type="' . $item[0] . '" ' . $arg . '>';
//            }
//        }
//        echo "</div>";
//    }
//    public function form($action='',$method='post',$attr=''){
//        echo "<form method='$method'  action='$action' $attr >";
//    }
//    public function uploadForm($action='',$attr=''){
//        echo "<form method='post' enctype='multipart/form-data' >";
//    }
//    public function endForm(){
//        echo "</form>";
//    }
//    function __destruct()
//    {
//        $jsFile=import::fileWithUrl('/lib/plugin/form/public/javascript/zebra_form.js');
//        $jsFile2=import::fileWithUrl('/lib/plugin/form/public/javascript/zebra_form.src.js');
//        $jsFile3=import::fileWithUrl('/lib/plugin/form/public/javascript/jquery.min.js');
//        echo '<script src="'.$jsFile.'"></script> ';
//        echo '<script src="'.$jsFile2.'"></script> ';
//        echo '<script src="'.$jsFile3.'"></script> ';
//        echo '<script>window.jQuery || document.write(\'<script src="'.$jsFile3.'"></script>\')</script>';


 //   }
}