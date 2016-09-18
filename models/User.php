<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $companyId
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $phone
 * @property string $city
 * @property integer $role
 * @property integer $status
 * @property string $name
 * @property string $avatar
 * @property string $banner_top
 * @property string $position
 * @property string $hobby
 * @property string $description
 * @property integer $createDate
 * @property integer $updateDate
 *
 */
class User extends ActiveRecord implements IdentityInterface {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const ROLE_USER = 10;
    const ROLE_ADMIN = 20;
    const ROLE_EDITOR = 30;
    const ROLE_CS = 40;
    const ROLE_CASHIER = 50;
    const ROLE_FINANCE = 60;
    const VENDOR_FACEBOOK = 1;
    const VENDOR_GOOGLE = 2;
    const VENDOR_TWITTER = 3;
    const VENDOR_GITHUB = 4;
    /* LEVEL */
    /* LEVEL */
    const LEVEL_ADMIN = 1;
    const LEVEL_WORK_REQUEST = 2;
    const LEVEL_WORK_ORDER = 3;
    const LEVEL_SUPERVISOR = 4;
    const LEVEL_DATA_ENTRY = 5;
    const LEVEL_SPAREPART = 6;
    const LEVEL_PLANNER = 7;

    public static $statuses = ['Not Active', 'Active'];
    public static $imagePath = '@webroot/images/avatar/';
    public static $userLevel = [1 => 'ADMIN', 'OTHER LEVEL 1', 'OTHER LEVEL 2'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email',], 'required'],
            [['status', 'roleId'], 'integer'],
            [['description'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'name', 'avatar', 'hobby'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 20],
            [['city'], 'string', 'max' => 50],
            [['position', 'createDate', 'updateDate'], 'string', 'max' => 128],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['avatar'], 'file', 'extensions' => 'jpg,png,gif', 'on' => 'update'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'branchId' => 'Branch',
            'phone' => 'Phone',
            'city' => 'City',
            'status' => 'Status',
            'name' => 'Name',
            'avatar' => 'Avatar',
            'banner_top' => 'Banner Top',
            'params' => 'Params',
            'position' => 'Position',
            'hobby' => 'Hobby',
            'description' => 'Description',
            'createDate' => 'Created At',
            'UpdateDate' => 'Updated At',
            'roleId' => 'Access'
        ];
    }

    public function getRoles()
    {
        return $this->hasOne(Role::className(), ['id' => 'roleId']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function dropdown()
    {
        $dropdown = [];

        $query = new \yii\db\Query;
        $query->select('id, username')
                ->from('user');
        $command = $query->createCommand();
        $models = $command->queryAll();
        if ($models)
            foreach ($models as $model) {
                $dropdown[$model['id']] = $model['username'];
            }
        return $dropdown;
    }

    public function behaviors()
    {
        return [
            'avatar' => [
                'class' => \app\components\CropBehavior::className(),
                'paths' => self::$imagePath . '{id}/',
                'width' => 100,
                'height' => 100
            ],
        ];
    }

    public function getImageTrue()
    {
        $image = $this->avatar;
        $pos = strpos($image, "http");
        if ($pos !== FALSE) {
            return $this->avatar;
        } else {
            return Yii::getAlias($this->image);
        }
    }

    public function getThumbnailTrue()
    {
        $image = $this->avatar;
        $pos = strpos($image, "http");
        if ($pos !== FALSE) {
            return $this->avatar;
        } else {
            if ($image) {
                $name = \yii\helpers\StringHelper::basename($image);
                $dir = \yii\helpers\StringHelper::dirname($image);
                return Yii::getAlias($dir . '/thumb/' . $name);
            } else {
                return Yii::$app->request->baseUrl . '/img/photo.jpg.png';
            }
        }
    }

    public function getAvatarTrue()
    {
        return $this->thumbnailTrue;
    }

    public function getAvatarImage()
    {
        return $this->thumbnailTrue;
    }

    public function getThumb()
    {
        if ($this->thumbnailTrue) {
            return \yii\helpers\Html::img($this->thumbnailTrue, ['width' => '100px']);
        } else
            return \yii\helpers\Html::img(Yii::getAlias('@web/img/photo.jpg.png'), ['width' => '100px']);
    }

}
