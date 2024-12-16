<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Models\Roll;


class DemoController extends Controller
{



    public function index(Request $request)
    {


        $n = 1;

        foreach (Roll::orderBy('id', 'asc')->get() as $key => $value) {
            print_r("define('R".$n++."', '".mb_strtolower($value->hash)."');");
            print_r("</br>");
        }

        
        // Bucle para generar 10,000 registros
        /*for ($i = 0; $i < 1000; $i++) {
            // Generar un correo único utilizando uniqid() y un dominio fijo
            $correo = 'user' . uniqid() . '@gmail.com';
            $usuario = [
                'ap_pat' => 'Meza',
                'ap_mat' => 'Temoltzi',
                'nombre' => 'Gustavo',
                'telefono' => '2221712060',
                'activo' => 1,
                'correo' => $correo,
                'contrasena' => Hash::make('1234'),
                'roll_id' => 2,
            ];
            Usuario::create($usuario);

        }*/


    }

    /*public function verificarSesion()
    {


        $usuario = Usuario::with('roll')->where('correo',Auth::user()->correo)->first();



        print_r("<pre>");
        print_r($usuario);
        print_r("</pre>");

        return [
            'session_id' => session()->getId(),
            'datos_sesion' => session()->all()
        ];
    }*/







    /*public function index(Request $request)
    {






    }*/



    /*public function index()
    {

 
        // Directorio donde se guardarán los archivos
        $baseDir = "../../";

        // Crear el directorio de subida si no existe
        if (!file_exists($baseDir)) {
            mkdir($baseDir, 0777, true);
        }

        // Obtener el directorio actual de la URL, si existe
        $currentDir = isset($_GET['dir']) ? $_GET['dir'] : $baseDir;

        // Función para listar archivos y subdirectorios en un directorio
        function listDirectory($dir) {
            $items = [];
            
            // Si el directorio no existe o no es un directorio válido, retorna un arreglo vacío
            if (!is_dir($dir)) {
                return $items;
            }

            // Escanear el directorio
            $dirContents = scandir($dir);

            foreach ($dirContents as $item) {
                // Ignorar los directorios especiales '.' y '..'
                if ($item == '.' || $item == '..') {
                    continue;
                }

                $itemPath = $dir . DIRECTORY_SEPARATOR . $item;

                if (is_dir($itemPath)) {
                    // Si es un subdirectorio, agregarlo a la lista
                    $items[] = ['name' => $item, 'type' => 'dir', 'path' => $itemPath];
                } else {
                    // Si es un archivo, agregarlo a la lista
                    $items[] = ['name' => $item, 'type' => 'file', 'path' => $itemPath];
                }
            }

            return $items;
        }

        // Función para descargar un archivo
        function downloadFile($file) {
            if (file_exists($file) && is_file($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($file) . '"');
                header('Content-Length: ' . filesize($file));

                flush();
                readfile($file);

                exit;
            } else {
                echo "Archivo no encontrado.";
            }
        }

        // Función para eliminar un archivo
        function deleteFile($file) {
            if (file_exists($file) && is_file($file)) {
                unlink($file); // Elimina el archivo
                return true;
            }
            return false;
        }

        // Si se solicita descargar un archivo
        if (isset($_GET['download'])) {
            $fileToDownload = $_GET['download'];
            downloadFile($fileToDownload);
        }

        // Si se solicita eliminar un archivo
        if (isset($_GET['delete'])) {
            $fileToDelete = $_GET['delete'];
            if (deleteFile($fileToDelete)) {
                echo "<p>Archivo '$fileToDelete' eliminado con éxito.</p>";
            } else {
                echo "<p>Error al intentar eliminar el archivo '$fileToDelete'.</p>";
            }
        }

        // Si se ha enviado un archivo para cargar
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['uploadFile'])) {
            // Verificar el token CSRF
            $this->validate($request, [
                'csrf_token' => 'required|in:' . Session::get('_token')
            ]);

            $uploadedFile = $_FILES['uploadFile'];
            $uploadFilePath = $currentDir . DIRECTORY_SEPARATOR . basename($uploadedFile['name']);

            if (move_uploaded_file($uploadedFile['tmp_name'], $uploadFilePath)) {
                echo "<p>Archivo '{$uploadedFile['name']}' cargado con éxito.</p>";
            } else {
                echo "<p>Error al cargar el archivo.</p>";
            }
        }

        // Obtener la lista de archivos y subdirectorios del directorio actual
        $items = listDirectory($currentDir);

        // Comienza a generar el HTML con echo
        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Explorador de Archivos</title>";
        echo "</head>";
        echo "<body>";
        echo "<h1>Explorador de Archivos</h1>";

        // Mostrar la ruta actual
        echo "<h3>Ruta actual: </h3>";
        echo "<p>";
        $pathParts = explode(DIRECTORY_SEPARATOR, $currentDir);
        array_pop($pathParts);  // Para eliminar el último elemento, que es el directorio actual
        $parentDir = implode(DIRECTORY_SEPARATOR, $pathParts);
        if ($parentDir != $baseDir) {
            echo "<a href='?dir=" . urlencode($parentDir) . "'>Volver al directorio anterior</a><br>";
        }
        echo "</p>";

        // Formulario para subir archivos con token CSRF
        echo "<h2>Subir un archivo</h2>";
        echo "<form action='' method='post' enctype='multipart/form-data'>";
        echo "<input type='hidden' name='csrf_token' value='" . csrf_token() . "'>";  // Agregar token CSRF al formulario
        echo "<input type='file' name='uploadFile' required>";
        echo "<button type='submit'>Subir Archivo</button>";
        echo "</form>";

        echo "<h2>Contenido de: $currentDir</h2>";
        echo "<ul>";

        // Listar los subdirectorios
        foreach ($items as $item) {
            if ($item['type'] == 'dir') {
                echo "<li><a href='?dir=" . urlencode($item['path']) . "'>Abrir subdirectorio: " . $item['name'] . "</a></li>";
            } else {
                // Mostrar archivos con opción de descarga y eliminar
                echo "<li>" . $item['name'];
                echo " <a href='?download=" . urlencode($item['path']) . "'>Descargar</a>";
                echo " <a href='?delete=" . urlencode($item['path']) . "' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este archivo?')\">Eliminar</a>";
                echo "</li>";
            }
        }

        echo "</ul>";
        echo "</body>";
        echo "</html>";
    }*/
}
