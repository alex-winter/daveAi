<?php

return json_decode(
    file_get_contents(
        __DIR__ . '/city.list.json'
    )
);
