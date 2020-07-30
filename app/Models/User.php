<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 用户
 *
 * Class User
 * @package App\Models
 */
class User extends Model
{
    use SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $dates = ['updated_at', 'created_at', 'deleted_at'];

    /**
     * return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setWxid($value)
    {
        $this->wxid = $value;
    }

    /**
     * return string
     */
    public function getWxid()
    {
        return $this->wxid;
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    /**
     * return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setAvatar($value)
    {
        $this->avatar = $value;
    }

    /**
     * return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setLevel($value)
    {
        $this->level = $value;
    }

    /**
     * return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param $wxid
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null|static
     */
    public static function findByWxid($wxid)
    {
        return self::query()->where('wxid', $wxid)->first();
    }

    public function toDisplay()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
        ];
    }

}
