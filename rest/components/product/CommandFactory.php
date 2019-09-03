<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 03.09.2019
 * Time: 20:47
 */
declare(strict_types=1);

namespace rest\components\product;

/**
 * Class CommandFactory
 * @package rest\components\product
 */
class CommandFactory
{
    const TYPE_DELETE = 'delete';
    const TYPE_CREATE = 'new';
    const TYPE_UPDATE = 'update';

    /**
     * @param $data
     * @return ProductCommand|null
     */
    public static function create($data)
    {
        if (isset($data['action'], $data['id']) && $data['action'] && $data['id']){
            switch ($data['action']){
                case self::TYPE_DELETE:
                    return new DeleteCommand($data['id']);
                case self::TYPE_CREATE:
                    return new CreateCommand($data['id']);
                case self::TYPE_UPDATE:
                    return new UpdateCommand($data['id']);
                default:
                    return null;
            }
        }

        return null;
    }
}
