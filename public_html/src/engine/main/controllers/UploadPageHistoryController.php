<?php

namespace engine\main\controllers;

use engine\base\controllers\BaseController;
use engine\main\models\MainModel;

class UploadPageHistoryController extends BaseController
{

    public $data;


    public function index()
    {
        if(!$this->model) $this->model = MainModel::getInstance();

        $this->data = $this->model->read('upload_video', [
            'fields' => ['id', 'video', 'thumbnail', 'name', 'description', 'is_processed']
        ]);

    }

    /**
     * @return false|string
     * @throws \engine\base\exceptions\RouteException
     */
    public function outputData()
    {
        return $this->render($_SERVER['DOCUMENT_ROOT'] . '/engine/main/views/uploadVideoPageHistory');
    }

}