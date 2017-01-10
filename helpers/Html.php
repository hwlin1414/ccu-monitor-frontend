<?php

namespace app\helpers;

use yii\helpers\BaseHtml;

class Html extends BaseHtml
{
    function createSubmit($name = null, $options = [])
    {
        if(is_null($name)) $name = '新增';

        $options = array_merge([
            'class' => 'btn cyan darken-1 waves-effect waves-light',
        ], $options);

        return Html::submitButton($name, $options);
    }

    function createButton($url = ['create'], $name = null, $options = [])
    {
        if(is_null($name)) $name = '新增';

        $options = array_merge([
            'class' => 'btn cyan darken-1 waves-effect waves-light',
        ], $options);

        return Html::a($name, $url, $options);
    }

    function updateSubmit($name = null, $options = [])
    {
        if(is_null($name)) $name = '修改';

        $options = array_merge([
            'class' => 'btn light-blue darken-2 waves-effect waves-light',
        ], $options);

        return Html::submitButton($name, $options);
    }

    function updateButton($url = ['update'], $name = null, $options = [])
    {
        if(is_null($name)) $name = '修改';

        $options = array_merge([
            'class' => 'btn light-blue darken-2 waves-effect waves-light',
        ], $options);

        return Html::a($name, $url, $options);
    }

    function deleteButton($url = ['delete'], $name = null, $options = [])
    {
        if(is_null($name)) $name = '刪除';

        $options = array_merge([
            'class' => 'btn red lighten-1 waves-effect waves-light',
            'data-method' => 'POST',
            'data-confirm' => '您確定要刪除嗎?',
        ], $options);

        return Html::a($name, $url, $options);
    }
}
