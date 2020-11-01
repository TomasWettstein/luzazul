<?php
function old($dato)
{
    if (isset($_POST[$dato])) {
        return $_POST[$dato];
    }
}

function dd(...$input)
{
    var_dump($input);
    exit;
}



?>