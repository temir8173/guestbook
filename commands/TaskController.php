<?php


namespace app\commands;


use app\repositories\InvitationRepository;
use yii\console\Controller;

class TaskController extends Controller
{
    public function __construct(
        $id,
        $module,
        private InvitationRepository $invitationRepository,

        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionUpdateInvitationsEventDate()
    {
        $this->invitationRepository->updateDemoEventDate();
    }
}