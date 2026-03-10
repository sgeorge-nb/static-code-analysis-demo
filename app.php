<?php
// Example PHP file with poor maintainability and high complexity.
// ⚠️ For analysis and testing purposes only.

$globalConfig = array(
    "db_host" => "localhost",
    "db_user" => "root",
    "db_pass" => "example123",
    "logFile" => "app.log",
    "debug" => true,
);

// bad practice: global variable usage
$usesrs = array("Alice", "Bob", "Charlie", "Dave", "Eve");

function connectToDatabase()
{
    global $globalConfig;
    // no error handling or separation of concerns
    $conn = mysqli_connect($globalConfig["db_host"], $globalConfig["db_user"], $globalConfig["db_pass"]);
    if (!$conn)
    {
        echo "Connection failed!";
        return null;
    }
    return $conn;
}

function complicatedLogic($input)
{
    // deeply nested logic, magic numbers, repeated code
    $result = 0;
    for ($i = 0; $i < strlen($input); $i++)
    {
        $char = $input[$i];
        if ($char >= 'A' && $char <= 'Z')
        {
            if ($char == 'A' || $char == 'E' || $char == 'I' || $char == 'O' || $char == 'U')
            {
                $result += ord($char) * 2;
            } else
            {
                $result += ord($char);
                if ($result % 3 == 0)
                {
                    $result -= 5;
                } else if ($result % 5 == 0)
                {
                    $result += 10;
                } else
                {
                    for ($j = 0; $j < 5; $j++)
                    {
                        $result += ord($char) % ($j + 1);
                    }
                }
            }
        } else if ($char >= 'a' && $char <= 'z')
        {
            $result += ord($char) * 3;
            if ($char == 'z')
            {
                $result -= 15;
            }
        } else
        {
            $result += 1;
        }
    }
    return $result;
}

// duplicate and redundant logic
function anotherComplicatedFunction($data)
{
    $x = 0;
    foreach ($data as $d)
    {
        $x += complicatedLogic($d);
    }
    return $x + rand(0, 10);
}

function processData($data)
{
    $results = array();
    foreach ($data as $item)
    {
        $results[] = anotherComplicatedFunction(array($item));
    }
    // Mixed responsibilities: data processing, logging, and output
    global $globalConfig;
    if ($globalConfig["debug"])
    {
        file_put_contents($globalConfig["logFile"], "Processed: " . implode(",", $results) . "\n", FILE_APPEND);
    }
    echo "Results: " . implode(", ", $results);
}

function doEverything()
{
    global $users;
    $conn = connectToDatabase();
    if ($conn)
    {
        processData($users);
        mysqli_close($conn);
    }
}

// monolithic main logic
doEverything();
?>