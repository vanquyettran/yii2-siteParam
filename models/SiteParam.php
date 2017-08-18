<?php
/**
 * Created by PhpStorm.
 * User: Quyet
 * Date: 8/9/2017
 * Time: 10:45 AM
 */
namespace common\modules\siteParam\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class SiteParam extends \common\modules\siteParam\baseModels\SiteParam
{
    const PUBLISHER_NAME = 'publisher_name';
    const PUBLISHER_ADDRESS = 'publisher_address';
    const PUBLISHER_PHONE_NUMBER = 'publisher_phone_number';
    const PUBLISHER_EMAIL = 'publisher_email';

    const FACEBOOK_PAGE_URL = 'facebook_page_url';
    const GOOGLE_PLUS_PAGE_URL = 'google_plus_page_url';
    const YOUTUBE_PAGE_URL = 'youtube_page_url';
    const TWITTER_PAGE_URL = 'twitter_page_url';
    const INSTAGRAM_PAGE_URL = 'instagram_page_url';

    const FACEBOOK_APP_ID = 'facebook_app_id';
    const FACEBOOK_APP_SECRET = 'facebook_app_secret';

    public static function getNames()
    {
        return [
            self::PUBLISHER_NAME => Yii::t('app', 'Publisher name'),
            self::PUBLISHER_ADDRESS => Yii::t('app', 'Publisher address'),
            self::PUBLISHER_PHONE_NUMBER => Yii::t('app', 'Publisher phone number'),
            self::PUBLISHER_EMAIL => Yii::t('app', 'Publisher email'),

            self::FACEBOOK_PAGE_URL => Yii::t('app', 'Facebook page url'),
            self::GOOGLE_PLUS_PAGE_URL => Yii::t('app', 'Google plus page url'),
            self::YOUTUBE_PAGE_URL => Yii::t('app', 'Youtube page url'),
            self::TWITTER_PAGE_URL => Yii::t('app', 'Twitter page url'),
            self::INSTAGRAM_PAGE_URL => Yii::t('app', 'Instagram page url'),

            self::FACEBOOK_APP_ID => Yii::t('app', 'Facebook app id'),
            self::FACEBOOK_APP_SECRET => Yii::t('app', 'Facebook app secret'),
        ];
    }

    private static $_indexData;

    /**
     * @return self[]
     */
    public static function indexData()
    {
        if (self::$_indexData == null) {
            self::$_indexData = self::find()->indexBy('id')->all();
        }

        return self::$_indexData;
    }

    /**
     * @param $name
     * @return self|null
     */
    public static function findOneByName($name)
    {
        $data = self::indexData();
        foreach ($data as $item) {
            if ($item->name == $name) {
                return $item;
            }
        }
        return null;
    }

    /**
     * @param $names
     * @param $limit
     * @return self[]
     */
    public static function findAllByNames($names, $limit = INF)
    {
        $result = [];
        $data = self::indexData();
        $i = 0;
        foreach ($data as $item) {
            if (in_array($item->name, $names)) {
                $result[] = $item;
                $i++;
            }
            if ($i >= $limit) {
                break;
            }
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'creator_id',
                'updatedByAttribute' => 'updater_id',
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
                'value' => time(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['active', 'type', 'sort_order'], 'integer'],
            [['name', 'value'], 'string', 'max' => 255],
        ];
    }
}