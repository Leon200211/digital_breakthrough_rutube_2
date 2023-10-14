<?php

namespace engine\main\controllers;

use engine\base\controllers\BaseController;
use engine\main\models\MainModel;

class UploadBannerController extends BaseController
{

    private $_format = ['png', 'jpeg', 'jpg'];


    public function index()
    {

    }

    /**
     * @return false|string
     * @throws \engine\base\exceptions\RouteException
     */
    public function outputData()
    {
        return $this->render($_SERVER['DOCUMENT_ROOT'] . '/engine/main/views/uploadBannerPage');
    }

    public function uploadBanner(): void
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
        $id = $this->model->read('upload_banner', [
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
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/files/banner/" . $fileName;

        if (move_uploaded_file($_FILES['file']["tmp_name"], $targetPath)) {
            $this->model->add('upload_banner', [
                'fields' => [
                    'photo' => $fileName,
                    'name' => $_REQUEST['name'],
                    'description' => $_REQUEST['description'],
                    'is_processed' => 0
                ]
            ]);


            http_response_code(200);
            $result = [
                "id" => $idNewVideo + 1,
                "status" => 'success'
            ];
            echo json_encode($result);

            $curl = curl_init();
            $aPost = array(
                'upload_id' => $idNewVideo + 1,
                'quality_upgrade' => $_REQUEST['quality'] === 'true' ? 1 : 0,
                'generate_comments' => $_REQUEST['commentary'] === 'true' ? 1 : 0,
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
    public function uploadBannerFromApi(): void
    {
        if(!$this->model) $this->model = MainModel::getInstance();
        $profileDb = $this->model->read('upload_banner', [
           'fields' => ['id', 'video'],
           'where' => ['id' => $_REQUEST['upload_id']]
        ]);
        if (empty($profileDb)) {
            http_response_code(400);
            echo "Не корректные данные";
            exit();
        }

        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (!in_array($ext, $this->_format)) {
            http_response_code(400);
            echo "Не подходящий формат файла";
            exit();
        }

        $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/files/banner/" . $profileDb[0]['video'];
        if (move_uploaded_file($_FILES['file']["tmp_name"], $targetPath)) {
            $this->model->update('upload_banner', [
                'fields' => [
                    'is_processed' => 1,
                ],
                'where' => ['id' => $profileDb[0]['id']]
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
    public function checkBanner(): void
    {
        //sleep(5);
        http_response_code(200);
        $result = [
            'is_processed' => 1,
            'photo' => 123,
        ];
        echo json_encode($result);
        exit();

        if (empty($_REQUEST['id'])) {
            http_response_code(400);
            echo "Error 400";
            exit();
        }

        if(!$this->model) $this->model = MainModel::getInstance();
        $profileDb = $this->model->read('upload_banner', [
            'fields' => ['id', 'is_processed', 'video'],
            'where' => ['id' => $_REQUEST['id']]
        ]);

        if (empty($profileDb)) {
            http_response_code(400);
            echo "Не корректные данные";
            exit();
        }

        if ($profileDb[0]['is_processed'] == 1) {
            http_response_code(200);
            $result = [
                'is_processed' => 1,
                'photo' => $profileDb[0]['photo'],
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