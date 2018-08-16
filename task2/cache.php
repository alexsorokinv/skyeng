<?php

    public function newCache($date, $type) {
        $userId = \Yii::$app->user->id;
        $dataList = SomeDataModel::getDb()->cache(function ($db) use ($date, $type, $userId) {
            return SomeDataModel::find()->where(['date' => $date, 'type' => $type, 'user_id' => $userId])->all();
        });
        $result = [];

        if (!empty($dataList)) {
            foreach ($dataList as $dataItem) {
                $result[$dataItem->id] = ['a' => $dataItem->a, 'b' => $dataItem->b];
            }
        }

        return $result;
    }