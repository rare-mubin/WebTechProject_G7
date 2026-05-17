var revenueChart = null;

loadDashboard();
loadRevenueChart();

function loadDashboard() {
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4) {
            if (xhttp.status === 200) {
                try {
                    let response = JSON.parse(xhttp.responseText);

                    if (response.status === "success") {
                        renderDashboard(response);
                    } else {
                        showDashboardError(response.message || "Unable to load dashboard data");
                    }
                } catch (error) {
                    showDashboardError("Invalid dashboard response");
                }
            } else {
                showDashboardError("Unable to load dashboard data");
            }
        }
    };

    xhttp.open("POST", "/WebTechProject_G7/Controller/dashboardCtrl.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=getDashboard");
}

function renderDashboard(response) {
    let summary = response.summary || {};

    setText("dashboardDate", response.today || "");
    setText("totalRooms", summary.total_rooms || 0);
    setText("occupiedRooms", summary.occupied_rooms || 0);
    setText("availableRooms", summary.available_rooms || 0);
    setText("maintenanceRooms", summary.maintenance_rooms || 0);

    renderBookingList("arrivalsTableBody", response.arrivals || []);
    renderBookingList("departuresTableBody", response.departures || []);
}

function renderBookingList(tableBodyId, rows) {
    let tbody = document.getElementById(tableBodyId);

    if (!tbody) {
        return;
    }

    if (rows.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="empty-row">No records found</td></tr>';
        return;
    }

    let html = "";

    for (let i = 0; i < rows.length; i++) {
        html += "<tr>"
            + "<td>" + escapeHtml(rows[i].id) + "</td>"
            + "<td>" + escapeHtml(rows[i].guest_name) + "</td>"
            + "<td>" + escapeHtml(rows[i].room_number) + "</td>"
            + "<td>" + escapeHtml(rows[i].room_type) + "</td>"
            + "</tr>";
    }

    tbody.innerHTML = html;
}

function loadRevenueChart() {
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4) {
            if (xhttp.status === 200) {
                try {
                    let response = JSON.parse(xhttp.responseText);

                    if (response.status === "success") {
                        ensureChartJs(function () {
                            renderRevenueChart(response.labels || [], response.data || []);
                        });
                    } else {
                        showDashboardError(response.message || "Unable to load revenue chart");
                    }
                } catch (error) {
                    showDashboardError("Invalid revenue chart response");
                }
            } else {
                showDashboardError("Unable to load revenue chart");
            }
        }
    };

    xhttp.open("GET", "/WebTechProject_G7/Controller/dashboardCtrl.php?action=revenue", true);
    xhttp.send();
}

function ensureChartJs(callback) {
    if (window.Chart) {
        callback();
        return;
    }

    let existingScript = document.getElementById("chartjs-script");

    if (existingScript) {
        existingScript.onload = callback;
        return;
    }

    let script = document.createElement("script");
    script.id = "chartjs-script";
    script.src = "https://cdn.jsdelivr.net/npm/chart.js";
    script.onload = callback;
    script.onerror = function () {
        showDashboardError("Chart.js could not be loaded");
    };
    document.body.appendChild(script);
}

function renderRevenueChart(labels, data) {
    let canvas = document.getElementById("revenueChart");

    if (!canvas || !window.Chart) {
        return;
    }

    if (revenueChart) {
        revenueChart.destroy();
    }

    revenueChart = new Chart(canvas, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Total Revenue",
                data: data,
                backgroundColor: "#7eb6ff",
                borderColor: "#3563ff",
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function showDashboardError(message) {
    let errorBox = document.getElementById("dashboardError");

    if (errorBox) {
        errorBox.innerHTML = escapeHtml(message);
        errorBox.style.display = "block";
    }

    renderBookingList("arrivalsTableBody", []);
    renderBookingList("departuresTableBody", []);
}

function setText(id, value) {
    let element = document.getElementById(id);

    if (element) {
        element.textContent = value;
    }
}

function escapeHtml(value) {
    if (value === null || value === undefined) {
        return "";
    }

    return String(value)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
