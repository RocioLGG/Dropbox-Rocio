<?php
require_once 'terceros/dropbox/vendor/autoload.php';
use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;

$dropboxKey = "b42p5ml3wa3f03m";
$dropboxSecret = "2gm1l2k1vg96ows";
$dropboxToken = "sl.BweWjdSuaEMBMCXQFmSyqBKO9xp5MxJvy9dOfzmRt7-YN2G50IrjILcRtk-O3RlVKzP96sUFXmAOD6Dc1lYtYR_PgdI8h43dgao1cONNGRpsOJ6WLVGAxt2oOlgtuLJ9ObmWeuKTM-uzIbRJkKYlLeU";
$app = new DropboxApp($dropboxKey,$dropboxSecret,$dropboxToken);
$dropbox = new Dropbox($app);

if(!empty($_FILES)){
    $nombre = uniqid();
    $tempfile = $_FILES['file']['tmp_name'];

    if(isset($tempfile) && !empty($tempfile)) {
        $ext = explode(".",$_FILES['file']['name']);
        $ext = end($ext);
        $nombredropbox = "/" .$nombre . "." .$ext;

        try{
            echo "Ruta del archivo temporal: " . $tempfile . "<br>";

            $file = $dropbox->simpleUpload($tempfile, $nombredropbox, ['autorename' => true]);
            echo "Archivo subido correctamente";
        } catch(\Exception $e){
            echo "Error al subir el archivo: " . $e->getMessage();
        }
    } else {
        echo "Error: No se ha proporcionado ninguna ruta de archivo temporal";
    }
}



?>