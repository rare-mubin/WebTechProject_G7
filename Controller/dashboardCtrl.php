<?php
require_once __DIR__ . "/../Model/dashboardModel.php";

header("Content-Type: application/json");
date_default_timezone_set("Asia/Dhaka");

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && $_GET["action"] === "revenue") {
    $model = new DashboardModel();
    $endDate = date("Y-m-d");
    $startDate = date("Y-m-d", strtotime("monday this week -7 weeks"));
    $revenueRows = $model->getRevenueByWeek($startDate, $endDate);
    $revenueByWeek = [];

    foreach ($revenueRows as $row) {
        $revenueByWeek[$row["week_key"]] = $row["total_revenue"];
    }

    $labels = [];
    $values = [];

    for ($i = 7; $i >= 0; $i--) {
        $weekStart = strtotime("monday this week -" . $i . " weeks");
        $weekKey = date("oW", $weekStart);

        $labels[] = "Week " . date("W", $weekStart);
        $values[] = $revenueByWeek[$weekKey] ?? 0;
    }

    echo json_encode([
        "status" => "success",
        "message" => "Revenue chart data loaded",
        "labels" => $labels,
        "data" => $values
    ]);
    exit;
}

if (isset($_POST["action"]) && $_POST["action"] === "getDashboard") {
    $today = date("Y-m-d");
    $model = new DashboardModel();

    $summary = [
        "total_rooms" => $model->countTotalRooms(),
        "occupied_rooms" => $model->countOccupiedRooms(),
        "available_rooms" => $model->countAvailableRooms(),
        "maintenance_rooms" => $model->countMaintenanceRooms()
    ];

    echo json_encode([
        "status" => "success",
        "message" => "Dashboard data loaded",
        "today" => $today,
        "summary" => $summary,
        "arrivals" => $model->getTodaysArrivals($today),
        "departures" => $model->getTodaysDepartures($today)
    ]);
    exit;
}

echo json_encode([
    "status" => "error",
    "message" => "Invalid request"
]);
exit;
?>
