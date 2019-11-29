<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 19.07.2019
 * Time: 16:39
 */

namespace rest\components;

use yii\helpers\Url;
use yii\web\ErrorHandler as WebErrorHandler;
use yii\base\Exception;
use yii\base\ErrorException;
use yii\base\UserException;
use yii\web\HttpException;

/**
 * Class ErrorHandler
 * @package rest\components
 */
class ErrorHandler extends WebErrorHandler
{
    /**
     * @inheritdoc
     */
    protected function convertExceptionToArray($exception)
    {
        if (!YII_DEBUG && !$exception instanceof UserException && !$exception instanceof HttpException) {
            $exception = new HttpException(
                500,
                \Yii::t('yii', 'An internal server error occurred.')
            );
        }

        $swaggerLink = Url::to('swagger/swagger.json', true);
        $array = [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'help'=> "Смотри документацию апи http://petstore.swagger.io/?url=$swaggerLink"
        ];
        if ($exception instanceof HttpException) {
            $array['status'] = 'error';
            $array['code'] = $exception->statusCode;
        }

        if (YII_DEBUG) {
            $array['type'] = get_class($exception);
            if (!$exception instanceof UserException) {
                $array['file'] = $exception->getFile();
                $array['line'] = $exception->getLine();
                $array['stack-trace'] = explode("\n", $exception->getTraceAsString());
                if ($exception instanceof \yii\db\Exception) {
                    $array['error-info'] = $exception->errorInfo;
                }
            }
        }

        return $array;
    }

}
