<?php

namespace engine\main\controllers;

use engine\base\controllers\BaseController;
use engine\main\models\MainModel;

class UploadPageController extends BaseController
{

    private $_format = ['mp4', 'mov', 'wmv', 'avi', 'avchd', 'flv', 'f4v', 'swf', 'mkv', 'webm'];
    private $_formatPhoto = ['jpg', 'jpeg', 'png'];


    public function index()
    {

    }

    /**
     * @return false|string
     * @throws \engine\base\exceptions\RouteException
     */
    public function outputData()
    {
        return $this->render($_SERVER['DOCUMENT_ROOT'] . '/engine/main/views/uploadVideoPage');
    }

    public function uploadVideo(): void
    {
        if (empty($_FILES['file']['name'])) {
            http_response_code(400);
            echo "Не подходящий формат файла";
            exit();
        }

        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (!in_array($ext, $this->_format)) {
            http_response_code(400);
            echo "Не подходящий формат файла";
            exit();
        }

        if(!$this->model) $this->model = MainModel::getInstance();
        $id = $this->model->read('upload_video', [
            'fields' => ['id'],
            'limit' => '1',
            'order' => ['id'],
            'order_direction' => ['DESC'],
        ]);

        if (!empty($id)) {
            $idNewVideo = $id[0]['id'];
        } else {
            $idNewVideo = 0;
        }

        $fileName = 'test_' . random_int(1, 1000000) . '.' . $ext;
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/files/uploads/" . $fileName;

        if (move_uploaded_file($_FILES['file']["tmp_name"], $targetPath)) {
            $this->model->add('upload_video', [
                'fields' => [
                    'video' => 'test_1.pm4',
                    'name' => $_REQUEST['name'],
                    'description' => $_REQUEST['description'],
                    'style' => $_REQUEST['style_type'],
                    'is_processed' => 0
                ]
            ]);


            http_response_code(200);
            $result = [
                "id"     => $idNewVideo + 1,
                "status" => 'success',
                "video"  => $fileName,
            ];
            echo json_encode($result);

            $curl = curl_init();
            $aPost = array(
                'upload_id' => $idNewVideo + 1,
                'name' => $_REQUEST['name'],
                'description' => $_REQUEST['description'],
                'style' => $_REQUEST['style'],
            );
            if ((version_compare(PHP_VERSION, '5.5') >= 0)) {
                $aPost['file'] = new \CURLFile($targetPath);
                curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
            } else {
                $aPost['file'] = "@".$targetPath;
            }
            //curl_setopt($curl, CURLOPT_URL, $SITE_URL . 'loadVideo/test');
            curl_setopt($curl, CURLOPT_URL, "{$_ENV['BACKEND_API_URL']}/api/upload_file");
            curl_setopt($curl, CURLOPT_TIMEOUT, 120);
            curl_setopt($curl, CURLOPT_BUFFERSIZE, 128);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $aPost);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_TIMEOUT_MS, 2000);
            $sResponse = curl_exec($curl);

            exit();
        } else {
            http_response_code(500);
            echo "Error";
            exit();
        }
    }


    /**
     * @return void
     */
    public function uploadVideoFromApi(): void
    {
        if(!$this->model) $this->model = MainModel::getInstance();
        $videoDb = $this->model->read('upload_video', [
           'fields' => ['id'],
           'where' => ['id' => $_REQUEST['upload_id']]
        ]);
        if (empty($videoDb)) {
            http_response_code(400);
            echo "Не корректные данные";
            exit();
        }

        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        if (!in_array($ext, $this->_formatPhoto)) {
            http_response_code(400);
            echo "Не подходящий формат файла";
            exit();
        }


        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $fileName = 'res_' . random_int(1, 1000000) . '.' . $ext;
        $targetPathPhoto = $_SERVER['DOCUMENT_ROOT'] . "/files/uploads/photo/" . $fileName;

        if (move_uploaded_file($_FILES['photo']["tmp_name"], $targetPathPhoto)) {
            $this->model->update('upload_video', [
                'fields' => [
                    'is_processed' => 1,
                    //'thumbnail' => $fileName,
                    'thumbnail' => 'res_1.png',
                ],
                'where' => ['id' => $videoDb[0]['id']]
            ]);
            http_response_code(200);
            echo "success";
            exit();
        } else {
            http_response_code(500);
            echo "Error";
            exit();
        }

    }

    /**
     * @return void
     */
    public function checkVideo(): void
    {
        if (empty($_REQUEST['id'])) {
            http_response_code(400);
            echo "Error 400";
            exit();
        }

        if(!$this->model) $this->model = MainModel::getInstance();
        $photoDb = $this->model->read('upload_video', [
            'fields' => ['id', 'is_processed', 'thumbnail'],
            'where' => ['id' => $_REQUEST['id']]
        ]);

        if (empty($photoDb)) {
            http_response_code(400);
            echo "Не корректные данные";
            exit();
        }

        if ($photoDb[0]['is_processed'] == 1) {
            http_response_code(200);
            $result = [
                'is_processed' => 1,
                'photo' => $photoDb[0]['thumbnail'],
            ];
            echo json_encode($result);
        } else {
            http_response_code(200);
            $result = [
                'is_processed' => 0
            ];
            echo json_encode($result);
        }
        session_write_close();
        exit();
    }

}