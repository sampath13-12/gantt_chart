<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gantt Chart Generator</title>
    <style>
       
        .gantt-chart {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        .gantt-chart th, .gantt-chart td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .gantt-chart th {
            background-color: #f2f2f2;
        }
        .gantt-chart .task {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Task Name: <input type="text" name="task_name[]"><br>
        Start Date: <input type="date" name="start_date[]"><br>
        End Date: <input type="date" name="end_date[]"><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $task_names = $_POST["task_name"];
        $start_dates = $_POST["start_date"];
        $end_dates = $_POST["end_date"];


        echo "<h2>Gantt Chart</h2>";
        echo "<table class='gantt-chart'>";
        echo "<tr><th>Task Name</th><th>Start Date</th><th>End Date</th><th>Duration</th></tr>";
        for ($i = 0; $i < count($task_names); $i++) {
            $task_name = htmlspecialchars($task_names[$i]);
            $start_date = htmlspecialchars($start_dates[$i]);
            $end_date = htmlspecialchars($end_dates[$i]);
            echo "<tr><td>$task_name</td><td>$start_date</td><td>$end_date</td><td>" . calculate_duration($start_date, $end_date) . " days</td></tr>";
        }
        echo "</table>";
    }

    function calculate_duration($start_date, $end_date) {
        $start = strtotime($start_date);
        $end = strtotime($end_date);
        $duration = round(($end - $start) / (60 * 60 * 24));
        return $duration;
    }
    ?>
</body>
</html>
