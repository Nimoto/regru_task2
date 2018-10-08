<?php
function ($date, $type)
{
    $userId = Yii::$app->user->id;
    $key = implode('_', [$userId, $date, $type]);
    $result = $cache->get($key);

    if (!$result) {
        $dataList = SomeDataModel::find()->where(['date' => $date, 'type' => $type, 'user_id' => $userId])->all();
        $result = [];
        if (!empty($dataList)) {
            foreach ($dataList as $dataItem) {
                $result[$dataItem->id] = ['a' => $dataItem->a, 'b' => $dataItem->b];
            }
        }

        $cache->set($key, $result);
    }

    return $result;
}