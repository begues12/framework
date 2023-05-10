<?php
namespace Engine\Core;

use Engine\Core\Config;

class BaseFTP {

    private $Config;
    private $ftpConnection;

    public function __construct() {
        $this->Config = new Config();
        
        $this->connect(
            $this->Config->get("FTP_HOST"),
            $this->Config->get("FTP_USER"),
            $this->Config->get("FTP_PASS")
        );
        
    }

    public function connect($server, $username, $password) {
        $this->ftpConnection = ftp_connect($server);

        if (!$this->ftpConnection) {
            throw new \Exception("No se pudo conectar al servidor FTP");
        }

        $login = ftp_login($this->ftpConnection, $username, $password);

        if (!$login) {
            throw new \Exception("No se pudo iniciar sesión en el servidor FTP");
        }
    }

    public function listFiles($directory = '.') {
        $fileList = ftp_nlist($this->ftpConnection, $directory);

        if ($fileList === false) {
            throw new \Exception("No se pudo obtener la lista de archivos y directorios");
        }

        return $fileList;
    }

    public function downloadFile($remoteFile, $localFile) {
        $success = ftp_get($this->ftpConnection, $localFile, $remoteFile, FTP_BINARY);

        if (!$success) {
            throw new \Exception("No se pudo descargar el archivo");
        }
    }

    public function uploadFile($localFile, $remoteFile) {
        $success = ftp_put($this->ftpConnection, $remoteFile, $localFile, FTP_BINARY);

        if (!$success) {
            throw new \Exception("No se pudo subir el archivo");
        }
    }

    public function disconnect() {
        if ($this->ftpConnection) {
            ftp_close($this->ftpConnection);
            $this->ftpConnection = null;
        }
    }
}

?>