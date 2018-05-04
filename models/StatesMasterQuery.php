<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StatesMaster]].
 *
 * @see StatesMaster
 */
class StatesMasterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return StatesMaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return StatesMaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
