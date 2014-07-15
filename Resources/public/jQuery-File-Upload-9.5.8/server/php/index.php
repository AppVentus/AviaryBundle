<?php
$options = array(
    'delete_type' => 'POST',
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => '',
    'db_name' => 'nooster',
    'db_table' => 'files'
);

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');

class CustomUploadHandler extends UploadHandler {

    protected function initialize() {
        parent::initialize();
    }

    protected function trim_file_name($file_path, $name, $size, $type, $error,
            $index, $content_range) {
        $name = parent::trim_file_name($file_path, $name, $size, $type, $error,
            $index, $content_range);
        $name = strtolower(trim(preg_replace('/[^A-Za-z0-9-.]+/', '-', $name)));
        return $name;
    }

    /*
    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
            $index = null, $content_range = null) {
        $file = parent::handle_file_upload(
            $uploaded_file, $name, $size, $type, $error, $index, $content_range
        );

        $bdd = new PDO('mysql:host=localhost;dbname=nooster', 'root', '');

        $request = $bdd->prepare('INSERT INTO files(name) VALUES(:name)');
        $request->execute(array(
            'name' => $file->name
        ));

        $file->id = $bdd->lastInsertId();

        return $file;
    }

    protected function set_additional_file_properties($file) {
        parent::set_additional_file_properties($file);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $bdd = new PDO('mysql:host=localhost;dbname=nooster', 'root', '');

            $request = $bdd->prepare('SELECT id FROM files WHERE name=:name');
            $request->execute(array(
                'name' => $file->name
            ));

            while ($data = $request->fetch()) {
                $file->id = $data['id'];
            }
        }
    }


    public function delete($print_response = true) {
        $response = parent::delete(false);
        foreach ($response as $name => $deleted) {
            if ($deleted) {
                $bdd = new PDO('mysql:host=localhost;dbname=nooster', 'root', '');
    
                $request = $bdd->prepare('DELETE FROM files WHERE name=:name');
                $request->execute(array(
                    'name' => $name
                ));
            }
        } 
        return $this->generate_response($response, $print_response);
    }
    */
}

$upload_handler = new CustomUploadHandler(array(
    'image_versions' => array() // no image versions
));