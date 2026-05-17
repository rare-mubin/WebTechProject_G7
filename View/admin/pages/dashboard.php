<style>
    .dashboard-page {
        color: #222;
    }

    .dashboard-date {
        margin-bottom: 16px;
        color: #666;
        font-size: 14px;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(140px, 1fr));
        gap: 12px;
        margin-bottom: 20px;
    }

    .summary-box {
        background: #ffffff;
        border: 1px solid #dddddd;
        padding: 14px;
    }

    .summary-box span {
        display: block;
        color: #666;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .summary-box strong {
        font-size: 26px;
        font-weight: 600;
    }

    .dashboard-lists {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .dashboard-panel {
        background: #ffffff;
        border: 1px solid #dddddd;
        padding: 14px;
    }

    .dashboard-panel h2 {
        font-size: 18px;
        margin-bottom: 12px;
    }

    .revenue-panel {
        margin-bottom: 20px;
    }

    .chart-box {
        height: 280px;
    }

    .dashboard-panel table {
        width: 100%;
        border-collapse: collapse;
    }

    .dashboard-panel th,
    .dashboard-panel td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
        font-size: 14px;
    }

    .dashboard-panel th {
        background: #f2f2f2;
    }

    .empty-row {
        color: #777;
        text-align: center;
    }

    .dashboard-error {
        display: none;
        margin-bottom: 14px;
        padding: 10px;
        color: #842029;
        background: #f8d7da;
        border: 1px solid #f5c2c7;
    }

    @media (max-width: 900px) {
        .summary-grid,
        .dashboard-lists {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-page">
    <p class="dashboard-date">Today: <span id="dashboardDate">Loading...</span></p>
    <div id="dashboardError" class="dashboard-error"></div>

    <div class="summary-grid">
        <div class="summary-box">
            <span>Total Rooms</span>
            <strong id="totalRooms">0</strong>
        </div>
        <div class="summary-box">
            <span>Occupied Rooms</span>
            <strong id="occupiedRooms">0</strong>
        </div>
        <div class="summary-box">
            <span>Available Rooms</span>
            <strong id="availableRooms">0</strong>
        </div>
        <div class="summary-box">
            <span>Maintenance Rooms</span>
            <strong id="maintenanceRooms">0</strong>
        </div>
    </div>

    <div class="dashboard-panel revenue-panel">
        <h2>Revenue - Past 8 Weeks</h2>
        <div class="chart-box">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <div class="dashboard-lists">
        <div class="dashboard-panel">
            <h2>Today's Arrivals</h2>
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Guest</th>
                        <th>Room</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody id="arrivalsTableBody">
                    <tr>
                        <td colspan="4" class="empty-row">Loading...</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="dashboard-panel">
            <h2>Today's Departures</h2>
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Guest</th>
                        <th>Room</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody id="departuresTableBody">
                    <tr>
                        <td colspan="4" class="empty-row">Loading...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="/WebTechProject_G7/Assets/js/dashboard.js"></script>
