<?php

namespace app\helpers;

use yii\base\Object;

class ModelHelper extends Object
{
    public static function compare($new, $origin, $attributes = null)
    {
        $diff = [];
        $attrs0 = $new->getAttributes($attributes);
        $attrs1 = $origin->getAttributes($attributes);
        foreach($attrs0 as $key => $value){
            if(strval($attrs0[$key]) !== strval($attrs1[$key])){
                $diff[$key] = ['new' => $attrs0[$key], 'origin' => $attrs1[$key]];
            }
        }
        return $diff;
    }
}
