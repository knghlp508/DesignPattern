<?php
namespace App\Structural\DataMapper;

/**
 * 数据映射类
 * Class UserMapper
 * @package App\Structural\DataMapper
 */
class UserMapper
{
    /**
     * @var DBAL
     */
    protected $adapter;

    /**
     * UserMapper constructor.
     * @param DBAL $layer
     */
    public function __construct(DBAL $layer)
    {
        $this->adapter = $layer;
    }

    /**
     * 将用户对象保存到数据库中
     * @param User $user
     * @return bool
     */
    public function save(User $user)
    {
        //$data的键名对应数据表字段
        $data = [
            'userid' => $user->getUserId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail()
        ];

        //如果没有指定ID则在数据库中创建新纪录，否则更新已有记录
        if (($id = $user->getUserId()) == null) {
            unset($data['userid']);
            $this->adapter->insert($data);
            return true;
        } else {
            $this->adapter->update(['userid=?' => $id]);
            return true;
        }
    }

    /**
     * 基于ID在数据库中查找用户并返回用户实例
     * @param integer $id
     * @throws \InvalidArgumentException
     * @return User
     */
    public function findById($id)
    {
        $result = $this->adapter->find($id);
        if (count($result) == 0) throw new \InvalidArgumentException("User #$id is not found.");
        $row = $result->current();
        return $this->mapObject($row);
    }

    /**
     * 获取数据库所有记录并返回用户实例数组
     * @return array
     */
    public function findAll()
    {
        $result = $this->adapter->findAll();
        $entries = [];
        foreach ($result as $row) {
            $entries[] = $this->mapObject($row);
        }
        return $entries;
    }

    /**
     * 映射表记录到对象
     * @param array $row
     * @return User
     */
    public function mapObject(array $row)
    {
        $entry = new User();
        $entry->setUserId($row['userid']);
        $entry->setUsername($row['username']);
        $entry->setEmail($row['email']);
        return $entry;
    }
}