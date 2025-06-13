<?PHP

include_once("ClaseValidacion.php");

// Usage
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $validator = new FormValidator($_POST);
    $validator->setRequiredFields(['name', 'email']);
    try {
        $validator->validate();
        // If validation passes, process the form
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>