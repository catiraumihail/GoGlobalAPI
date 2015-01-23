<?php

/* Common functions */

namespace GoGlobalApi\lib;

class GGHelper{
    public static function WrapTag($tag, $value, $attributes=array()) {
        $attr = "";
        foreach($attributes as $k=>$v) $attr.= sprintf(" %s=\"%s\"",$k,$v);
		if(!empty($value))
			return sprintf("<%s%s>%s</%s>", $tag, $attr, $value, $tag);
		else
			return sprintf("<%s%s/>",$tag,$attr);
    }
}
