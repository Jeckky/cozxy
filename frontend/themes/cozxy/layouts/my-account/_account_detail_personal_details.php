<div class="col-sm-12 col-md-2">Name:</div>
<div class="col-sm-12 col-md-10"><?= $model['firstname'] ?> <?= $model['lastname'] ?></div>
<div class="col-sm-12 col-md-2">E-mail:</div>
<div class="col-sm-12 col-md-10"><?= $model['email'] ?></div>
<div class="col-sm-12 col-md-2">Birthday:</div>
<div class="col-sm-12 col-md-10"><?= $model['birthDate'] ?></div>
<div class="col-sm-12 col-md-2">Password:</div>
<div class="col-sm-12 col-md-10"><?= Html::a('Change Password', Url::to(['my-account/change-password']), ['class' => 'fc-g999']) ?> </div>
<div class="size12">&nbsp;</div>
<div class="size32 hr-margin">&nbsp;</div>