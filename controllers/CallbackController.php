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


class CallbackController
{
    public function actionCallback()
    {
        $param = CallbackModel::getParam();
        CallbackView::getView( $param );
    }

    public function actionSend()
    {
        echo CallbackModel::sendMail();
    }
}
