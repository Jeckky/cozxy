<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\ProductGroup;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use beastbytes\wizard\WizardBehavior;

/**
 * ProductGroupController implements the CRUD actions for ProductGroup model.
 */
class ProductGroupController extends ProductMasterController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductGroup::find()
            ->where("userId=" . Yii::$app->user->identity->userId . " and status=1"),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductGroup model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductGroup();
        $ms = '';
        if (isset($_POST["ProductGroup"])) {
            $productGroup = ProductGroup::find()->where("title='" . $_POST["ProductGroup"]["title"] . "' and status=1")->one();
            if (!isset($productGroup)) {
                $model->userId = Yii::$app->user->identity->userId;
                $model->title = $_POST["ProductGroup"]["title"];
                $model->description = strip_tags($_POST["ProductGroup"]["description"]);
                $model->status = 1;
                $model->updateDateTime = new \yii\db\Expression('NOW()');
                $model->createDateTime = new \yii\db\Expression('NOW()');
                if ($model->save(false)) {
                    return $this->redirect(['index']);
                }
            } else {
                $ms = 'This title already exists.';
                $title = $_POST["ProductGroup"]["title"];
                $description = $_POST["ProductGroup"]["description"];
            }
        }
        return $this->render('create', [
            'model' => $model,
            'ms' => $ms,
            'title' => isset($title) ? $title : false,
            'description' => isset($description) ? $description : false
        ]);
    }

    /**
     * Updates an existing ProductGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $ms = '';
        $model = $this->findModel($id);
        if (isset($_POST["ProductGroup"])) {
            $model->attributes = $_POST["ProductGroup"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');



            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'description' => $model->description,
            'ms' => $ms,
        ]);
    }

    /**
     * Deletes an existing ProductGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // Version 1.01 Wizard Of Product Group
    public function beforeAction($action)
    {

        $config = [];
        switch ($action->id) {
            case 'quiz':

                $config = [
                    'steps' => ['question'],
                    'timeout' => 30,
                    'forwardOnly' => true,
                    'events' => [
                        WizardBehavior::EVENT_WIZARD_STEP => [$this, $action->id . 'WizardStep'],
                        WizardBehavior::EVENT_AFTER_WIZARD => [$this, $action->id . 'AfterWizard'],
                        WizardBehavior::EVENT_STEP_EXPIRED => [$this, $action->id . 'StepExpired']
                    ]
                ];
                break;
            case 'create-wizard':
                $actionName = "createWizard";
                $config = [
                    'steps' => ['productGroup', 'address', 'phoneNumber', 'user'],
                    'events' => [
                        WizardBehavior::EVENT_WIZARD_STEP => [$this, $actionName . 'WizardStep'],
                        WizardBehavior::EVENT_AFTER_WIZARD => [$this, $actionName . 'AfterWizard'],
                        WizardBehavior::EVENT_INVALID_STEP => [$this, 'invalidStep']
                    ]
                ];
                break;
            case 'survey':
                $config = [
                    'steps' => [
                        'havePet',
                        [
                            'hasPet' => [
                                'type',
                                [
                                    'cat' => ['cat'],
                                    'dog' => ['dog'],
                                    'pet' => ['pet']
                                ]
                            ],
                            'noPet' => [
                                'getPet',
                                [
                                    'willGet' => [
                                        'get'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'autoAdvance' => false,
                    'defaultBranch' => false,
                    'events' => [
                        WizardBehavior::EVENT_WIZARD_STEP => [$this, $action->id . 'WizardStep'],
                        WizardBehavior::EVENT_AFTER_WIZARD => [$this, $action->id . 'AfterWizard'],
                        WizardBehavior::EVENT_INVALID_STEP => [$this, 'invalidStep']
                    ]
                ];
                break;
            case 'resume':
                $config = ['steps' => []]; // force attachment of WizardBehavior
            default:
                break;
        }

        if (!empty($config)) {
            $config['class'] = WizardBehavior::className();
            $this->attachBehavior('wizard', $config);
        }

        return parent::beforeAction($action);
    }

    public function actionWizard()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductGroup::find()
            ->where("userId=" . Yii::$app->user->identity->userId . " and status=1"),
        ]);

        return $this->render('101/wizard', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateWizard($step)
    {
//        throw new \yii\base\Exception($step);
        return $this->step($step);
    }

    /**
     * Quiz step expired
     * @param WizardEvent The event
     */
    public function quizAfterWizard($event)
    {
        $event->data = $this->render('quiz/result', ['models' => $event->stepData['question']]);
    }

    /**
     * Quiz step expired
     * @param WizardEvent The event
     */
    public function quizStepExpired($event)
    {
        $n = count($event->stepData) - 1;
        $event->stepData[$n]->expired = true;
    }

    /**
     * Process steps from the quiz
     * @param WizardEvent The event
     */
    public function quizWizardStep($event)
    {
        $modelName = 'app\\models\\costfit\\ProductGroup';
        $model = new $modelName(['question' => $this->questions[$event->n]]);
        $t = count($this->questions);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $event->data = $model;
            $event->nextStep = ($event->n < $t - 1 ? WizardBehavior::DIRECTION_REPEAT : WizardBehavior::DIRECTION_FORWARD
            );
            $event->handled = true;
        } else {
            $event->data = $this->render('quiz\question', compact('event', 'model', 't'));
        }
    }

    /**
     * Process wizard steps.
     * The event handler must set $event->handled=true for the wizard to continue
     * @param WizardEvent The event
     */
    public function createWizardWizardStep($event)
    {
        if (empty($event->stepData)) {
            $modelName = 'common\\models\\costfit\\' . ucfirst($event->step);

            $model = new $modelName();
        } else {
            $model = $event->stepData;
        }

        $post = Yii::$app->request->post();
        if (isset($post['cancel'])) {
            $event->continue = false;
        } elseif (isset($post['prev'])) {
            $event->nextStep = WizardBehavior::DIRECTION_BACKWARD;
            $event->handled = true;
        } elseif ($model->load($post) && $model->validate()) {
            $event->data = $model;
            $event->handled = true;

            if (isset($post['pause'])) {
                $event->continue = false;
            } elseif ($event->n < 2 && isset($post['add'])) {
                $event->nextStep = WizardBehavior::DIRECTION_REPEAT;
            }
        } else {
            $ms = '';
            if (isset($_POST["ProductGroup"])) {
                $productGroup = ProductGroup::find()->where("title='" . $_POST["ProductGroup"]["title"] . "' and status=1")->one();
                if (!isset($productGroup)) {
                    $model->userId = Yii::$app->user->identity->userId;
                    $model->title = $_POST["ProductGroup"]["title"];
                    $model->description = strip_tags($_POST["ProductGroup"]["description"]);
                    $model->status = 1;
                    $model->updateDateTime = new \yii\db\Expression('NOW()');
                    $model->createDateTime = new \yii\db\Expression('NOW()');
                    if ($model->save(false)) {
                        return $this->redirect(['index']);
                    }
                } else {
                    $ms = 'This title already exists.';
                    $title = $_POST["ProductGroup"]["title"];
                    $description = $_POST["ProductGroup"]["description"];
                }
            }
//            $event->data = $this->render('registration/' . $event->step, compact('event', 'model'));
            $event->data = $this->render('101/create', compact('event', 'model', 'ms', 'title', 'description'));
        }
    }

    /**
     * @param WizardEvent The event
     */
    public function invalidStep($event)
    {
        $event->data = $this->render('101/invalidStep', compact('event'));
        $event->continue = false;
    }

    /**
     * Registration wizard has ended; the reason can be determined by the
     * step parameter: TRUE = wizard completed, FALSE = wizard did not start,
     * <string> = the step the wizard stopped at
     * @param WizardEvent The event
     */
    public function createWizardAfterWizard($event)
    {
        if (is_string($event->step)) {
            $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
            );

            $registrationDir = Yii::getAlias('@runtime/registration');
            $registrationDirReady = true;
            if (!file_exists($registrationDir)) {
                if (!mkdir($registrationDir) || !chmod($registrationDir, 0775)) {
                    $registrationDirReady = false;
                }
            }
            if ($registrationDirReady && file_put_contents(
            $registrationDir . DIRECTORY_SEPARATOR . $uuid, $event->sender->pauseWizard()
            )) {
                $event->data = $this->render('registration/paused', compact('uuid'));
            } else {
                $event->data = $this->render('registration/notPaused');
            }
        } elseif ($event->step === null) {
            $event->data = $this->render('registration/cancelled');
        } elseif ($event->step) {
            $event->data = $this->render('registration/complete', [
                'data' => $event->stepData
            ]);
        } else {
            $event->data = $this->render('registration/notStarted');
        }
    }

    /**
     * Method description
     *
     * @return mixed The return value
     */
    public function actionResume($uuid)
    {
        $registrationFile = Yii::getAlias('@runtime/registration') . DIRECTORY_SEPARATOR . $uuid;
        if (file_exists($registrationFile)) {
            $this->resumeWizard(@file_get_contents($registrationFile));
            unlink($registrationFile);
            $this->redirect(['registration']);
        } else {
            return $this->render('registration/notResumed');
        }
    }

    // Version 1.01 Wizard Of Product Group
}
