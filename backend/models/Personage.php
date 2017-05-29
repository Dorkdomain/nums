<?php

namespace backend\models;

use Yii;

class Personage extends \yii\db\ActiveRecord
{
    public $username;
    public $old_password;
    public $new_password;
    public $two_password;

    public function rules()
    {
        return [
            [['old_password'], 'string', 'max' => 255],
            [['old_password'],'validateOldPassword'],
            [['new_password'] , 'string'],
            [['new_password'],'validateNewPassword'],
            [['two_password'],'compare','compareAttribute' => 'new_password', 'message' => '两次新密码输入不一样'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'old_password' => Yii::t('app', '原密码'),
            'new_password' => Yii::t('app', '新密码'),
            'two_password' => Yii::t('app', '重复新密码'),
        ];
    }
    public function validateOldPassword()
    {
        $user_model = \common\models\User::findOne(yii::$app->User->identity->id);

        if ($user_model)
        {
            if (!Yii::$app->getSecurity()->validatePassword($this->old_password, $user_model->password_hash))
            {
                $this->addError('old_password', '原密码输入错误');
                return false;
            }
            else
                return true;
        }
        else
        {
            $this->addError('old_password', '网络故障');
            return false;
        }

    }

    public function validateNewPassword()
    {
        if (!$this->validateOldPassword())
        {
            $this->addError('new_password', '必须先输入正确的原密码');
        }
       /* $num = preg_match('/[0-9]/', $this->new_password);
        $letter = preg_match('/[a-zA-Z]/', $this->new_password);
        if (!$num || !$letter)
        {
            $this->addError('new_password', '新密码必须为8-16位的数字字母组合');
        }*/
    }

    public function onlyValidate()
    {
        if ($this->username != yii::$app->adminUser->identity->username)
        {
            $user_model = AdminUsers::findOne(['username' => $this->username]);
            if ($user_model)
                $this->addError('username', '用户名已经存在');
        }

    }

   /*public function solveData($model)
    {
        $admin_user_model = User::findOne(['username' => $model->username]);

        if ($admin_user_model)
        {
            if ($model->new_password)
            {
                if (Salt::verifySalt($model->old_password, $admin_user_model->salt) != $admin_user_model->password)
                    return 'pass_error';
                else
                {
                    $pass_hash = Salt::generateSalt($model->new_password);
                    $admin_user_model->salt = $pass_hash['salt'];
                    $admin_user_model->password = $pass_hash['hash'];

                    if ($admin_user_model->save())
                        return 'yes';
                    else
                        return 'no';
                }
            }
            else
            {
                $admin_user_model->save();
                return 'normal';
            }
        }
    }*/

    /*public function upload()
    {
        if ($this->validate())
        {
            $file_url = yii::$app->adminUser->identity->username .'.'. $this->image_file->extension;
            $this->image_file->saveAs('appear/'.$file_url, false);

            return $file_url;
        }
        else
            return false;
    }*/
}
