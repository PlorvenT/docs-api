<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 15:20
 */
declare(strict_types=1);

namespace rest\controllers;

use rest\components\Controller;
use rest\controllers\actions\orderDocument\IndexAction;
use rest\controllers\actions\orderDocument\CreateAction;
use rest\controllers\actions\orderDocument\DeleteAction;
use rest\controllers\actions\orderDocument\DownloadAction;
use rest\controllers\actions\orderDocument\UpdateAction;

/**
 * Class OrderDocumentController
 * @package rest\controllers
 */
class OrderDocumentController extends Controller
{
    //actions
    public const ACTION_INDEX = 'index';
    public const ACTION_CREATE = 'create';
    public const ACTION_UPDATE = 'update';
    public const ACTION_DOWNLOAD = 'download';
    public const ACTION_DELETE = 'delete';

    /**
     * @inheritdoc
     */
    public function actions(): array
    {
        return [
            self::ACTION_INDEX => [
                'class' => IndexAction::class
            ],
            self::ACTION_CREATE => [
                'class' => CreateAction::class
            ],
            self::ACTION_UPDATE => [
                'class' => UpdateAction::class
            ],
            self::ACTION_DOWNLOAD => [
                'class' => DownloadAction::class
            ],
            self::ACTION_DELETE => [
                'class' => DeleteAction::class
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    protected function verbs(): array
    {
        return [
            self::ACTION_INDEX => ['GET'],
            self::ACTION_DOWNLOAD => ['GET'],
            self::ACTION_CREATE => ['POST'],
            self::ACTION_UPDATE => ['POST'],
            self::ACTION_DELETE => ['DELETE'],
        ];
    }
}
