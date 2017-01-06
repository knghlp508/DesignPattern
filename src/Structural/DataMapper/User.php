<?php
namespace App\Structural\DataMapper;

/**
 * 这是数据库记录在内存的表现层
 *
 * 验证也在该对象中进行
 * Class User
 * @package App\Structural\DataMapper
 */
class User
{
    protected $userId;

    protected $username;

    protected $email;

    /**
     * User constructor.
     * @param null $id
     * @param null $username
     * @param null $email
     */
    public function __construct($id = null, $username = null, $email = null)
    {
        $this->userId=$id;
        $this->username=$username;
        $this->email=$email;
    }

    /**
     * @return null
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param null $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param null $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param null $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}