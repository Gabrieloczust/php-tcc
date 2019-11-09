<?php

class Documento extends Model
{
    public $pasta = "assets/uploads/";

    public function mover($id, $file)
    {

        $pasta = $this->existePasta($id);

        $uploadfile = $pasta . '/' . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
            return true;
        } else {
            return false;
        }
    }

    private function existePasta($id)
    {
        $pasta = $this->pasta . $id;
        if (!file_exists($pasta)) :
            mkdir("$pasta", 0777, true);
        endif;
        return $pasta;
    }
}
