<?php

namespace engine\main\controllers;

use engine\base\controllers\BaseController;
use engine\main\models\MainModel;

class UploadProfileHistoryController extends BaseController
{

    public $data;


    public function index()
    {
        if(!$this->model) $this->model = MainModel::getInstance();

        $this->data = $this->model->read('upload_profile', [
            'fields' => ['id', 'photo', 'name', 'description', 'is_processed']
        ]);

    }

    /**
     * @return false|string
     * @throws \engine\base\exceptions\RouteException
     */
    public function outputData()
    {
        return $this->render($_SERVER['DOCUMENT_ROOT'] . '/engine/main/views/uploadProfilePageHistory');
    }

}