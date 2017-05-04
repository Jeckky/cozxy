<?php

namespace backend\controllers;

use Yii;
use common\gii\templates\model\Generator;

class GenerateModelController extends \yii\web\Controller {

    public function actionIndex() {
        //Uncomment For Generate Cozxy DB
        $dbName = "db"; // Change Other For Generate Model Of Other DB
        $folderName = 'costfit';
        //Uncomment For Generate Cozxy DB
        //
        //Uncomment For Generate DBWorld
        $dbName = "dbWorld"; // Change Other For Generate Model Of Other DB World
        //$folderName = 'dbworld'; // folder for dbWorld
        //Uncomment For Generate DBWorld
        //

        $connection = \Yii::$app->{$dbName};
        $errors = " ";
        $model = $connection->createCommand('SHOW TABLES');
        $tables = $model->queryAll();
        foreach ($tables as $table) {
            foreach ($table as $tableName) {
                $tn = explode('_', $tableName);
                $tn = array_map('ucwords', $tn);
                $modelClass = implode('', $tn);

                //Master Model
                $generator = new Generator();
                $generator->db = $dbName;
                $generator->tableName = $tableName;
                $generator->modelClass = $modelClass . "Master";
                $generator->ns = "common\models\\$folderName\master";
                $generator->baseClass = 'common\models\ModelMaster';

                /**
                 * for i18n
                 * comment this 2 lines if you do not need
                 */
                $generator->enableI18N = true;
                $generator->messageCategory = $tableName;
                /**
                 * /i18n
                 */
                $files = $generator->generate();
                $answers = [];
                foreach ($files as $file) {
                    $answers[$file->id] = 1;
                }
                $result = '';

                //Extend Model
                $generator2 = new Generator();
                $generator2->db = $dbName;
                $generator2->tableName = $tableName;
                $generator2->modelClass = $modelClass;
                $generator2->ns = "common\models\\$folderName";
                $generator2->baseClass = $generator->ns . '\\' . $generator->modelClass;
                $generator2->templates['extends'] = Yii::getAlias('@common/gii/templates/model/extends');
                $generator2->template = 'extends';
                $files2 = $generator2->generate();
                $answers2 = [];
                foreach ($files2 as $file2) {
                    $answers2[$file2->id] = 1;
                }
                $result2 = '';

                if ($generator->save($files, $answers, $result)) {
                    echo '<p>';
                    echo 'tableName:' . $generator->tableName . ', modelClass:' . $generator->modelClass . '<br />';

                    //check file exist

                    if (!file_exists(Yii::getAlias('@' . str_replace('\\', '/', $generator2->ns)) . '/' . $generator2->modelClass . '.php')) {
                        if ($generator2->save($files2, $answers2, $result2)) {
                            echo Yii::getAlias('@' . str_replace('\\', '/', $generator2->ns)) . '/' . $generator2->modelClass . '.php<br />';
                            echo 'tableName:' . $generator2->tableName . ', modelClass:' . $generator2->modelClass . '<br />';
                        }
                    }

                    echo '</p>';
                } else {
                    break;
                }
            }
        }
    }

}
