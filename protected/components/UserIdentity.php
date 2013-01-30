<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        $record = User::model()->findByAttributes(array('name'=>$this->username));
        if(!is_null($record) && md5($this->password) == $record->password){
            Yii::app()->user->setState('authority', $record->authority);
            Yii::app()->user->setState('name', $record->name);
            Yii::app()->user->setState('password', $record->password);
            Yii::app()->user->setState('telephone', $record->telephone);
            $this->errorCode = self::ERROR_NONE;
        }else{
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        return !$this->errorCode;
	}
}
