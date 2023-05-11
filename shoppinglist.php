<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
  <h1>Einkaufsliste</h1>
  <div class="form-container">
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <label for="element">Element:</label>
      <input type="text" id="element" name="element" required>
      <button type="submit">Hinzufügen</button>
    </form>
  </div>

  <div class="list-container">
    <?php
    session_start(); // Start the session to save the array with the elements

    // Check whether the form has been sent
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check whether a purchase item is to be added
        if (!empty($_POST["element"])) {
            // Add item to shopping list
            $_SESSION['einkaufsliste'][] = $_POST["element"];
        }
        // Check whether an element is to be deleted
        elseif (isset($_POST["delete"])) {
            $index = $_POST["delete"];
            // Remove item from the shopping list
            if (isset($_SESSION['einkaufsliste'][$index])) {
                unset($_SESSION['einkaufsliste'][$index]);
            }
        }
    }
    ?>
    <h2>Meine Einkaufsliste:</h2>
    <?php    
    // Check that the shopping list is not empty
    if (!empty($_SESSION['einkaufsliste'])) {
        //echo "<h2>Meine Einkaufsliste:</h2>";
        echo "<ul>";
        // Show all items in the shopping list
        foreach ($_SESSION['einkaufsliste'] as $index => $element) {
            echo "<li>$element";
            // Show form for deleting the item
            echo "<form method='POST' action='".$_SERVER["PHP_SELF"]."'>";
            echo "<input type='hidden' name='delete' value='$index'>";
            echo "<button type='submit'>X</button>";
            echo "</form>";
            echo "</li>";
        }
        echo "</ul>";
    }
    ?>
  </div>
</div>

</body>
</html>