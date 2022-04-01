<?php
namespace App\Controllers;
use Database\DatabaseConnection;

// Only children will be instantiated
abstract class Controller {
    protected $database;

    public function __construct(DatabaseConnection $database) {
        // start session only if there is no session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->database = $database;
    }

    protected function view(string $path, array $params = null) {
        // Démarrer le système de buffering
        ob_start();

        // replace dots by directory separator
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        
        // require view file
        require VIEWS . $path . '.php';

        $content = ob_get_clean();

        require VIEWS . 'layout.php';
    }

    // getter for connection to database
    protected function getDatabase() {
        return $this->database;
    }

    protected function filterData($data) {
        $args = array(
            'animal_name'   => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'animal_species'   => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'animal_gender'   => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'animal_image_url'   => FILTER_VALIDATE_URL,
            'animal_weight'   => FILTER_SANITIZE_NUMBER_INT,
            'animal_info'   => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'animal_favorite_keeper'   => FILTER_SANITIZE_NUMBER_INT,
            'animal_enclosure_id'   => FILTER_SANITIZE_NUMBER_INT,
        );
        $data = filter_input_array(INPUT_POST, $args, true);
    }
}