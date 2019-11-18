<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 26-Feb-19
 * Time: 21:20
 */

namespace controllers;

use models\CallbackModel;
use views\CallbackView;

//spl_autoload_register();

class CallbackController
{
    public function actionCallback()
    {
        $filename = CallbackModel::getCallback();
        $param = CallbackModel::getParam();
        CallbackView::getView($filename, $param);
    }
}
