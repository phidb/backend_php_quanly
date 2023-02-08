<?php
    echo '<h3>ID: ' . $id . '</h3>';
    echo '<h3>Title: ' . $title . '</h3>';
    echo '<h3>SliderController - Form</h3>';
    $linkList   =  route($controllerName);

?>

<a href="<?php echo $linkList; ?>">Back</a>
