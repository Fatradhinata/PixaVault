document.addEventListener("DOMContentLoaded", function () {
    var role = "own-profile";

    const buttons = document.querySelectorAll(".tab-btn");
    const contents = document.querySelectorAll(".tab-content");

    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            buttons.forEach((btn) => btn.classList.remove("active"));
            contents.forEach((content) => content.classList.remove("active"));

            this.classList.add("active");
            document.getElementById(this.dataset.tab).classList.add("active");
        });
    });

    if (role == "own-user") {
        document.querySelectorAll(".role-own-profile").forEach((el) => el.classList.remove("d-none"));
        document.querySelectorAll(".role-other-user").forEach((el) => el.classList.add("d-none"));
    } else if (role == "other-user") {
        document.querySelectorAll(".role-other-user").forEach((el) => el.classList.remove("d-none"));
        document.querySelectorAll(".role-own-profile").forEach((el) => el.classList.add("d-none"));
    }

    const statsDropdown = document.querySelectorAll(
        ".tab-content-stats-dropdown"
    );
    const ctx = document.getElementById("viewsChart").getContext("2d");

    const viewDataSets = {
        weekly: [1500, 700, 900, 1200, 2313, 400, 1300],
        monthly: Array.from(
            { length: 30 },
            () => Math.floor(Math.random() * 8000) + 1000
        ), // Random 30 hari
        yearly: Array.from(
            { length: 12 },
            () => Math.floor(Math.random() * 60000) + 5000
        ), // Random 12 bulan
    };

    const labels = {
        weekly: ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"],
        monthly: Array.from({ length: 30 }, (_, i) => (i + 1).toString()), // Tanggal 1-30
        yearly: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"], // Nama bulan
    };

    function getStepSize(data) {
        const maxVal = Math.max(...data);
        const magnitude = Math.pow(10, Math.floor(Math.log10(maxVal)));
        return Math.ceil(maxVal / magnitude) * (magnitude / 5);
    }

    function createViewChart(data, labelSet) {
        return new Chart(ctx, {
            type: "bar",
            data: {
                labels: labelSet,
                datasets: [
                    {
                        label: "Views",
                        data: data,
                        backgroundColor: data.map((val) =>
                            val === Math.max(...data) ? "#ccff00" : "#D9D9D9"
                        ),
                        borderRadius: 8,
                        maxBarThickness: 25,
                    },
                ],
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            title: () => "",
                            label: (tooltipItem) =>
                                tooltipItem.raw.toLocaleString(),
                        },
                        yAlign: "bottom",
                        displayColors: false,
                        backgroundColor: "#1e1e38",
                        bodyColor: "#ffffff",
                        padding: 10,
                        cornerRadius: 6,
                        bodyFont: {
                            size: 16,
                            family: "Poppins, Arial, sans-serif",
                        },
                    },
                },
                responsive: true,
                scales: {
                    x: { ticks: { display: true }, grid: { display: false } },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: getStepSize(data),
                        },
                    },
                },
            },
        });
    }

    let viewChart = createViewChart(viewDataSets.weekly, labels.weekly); // Chart awal

    document
        .getElementById("timeViewFilter")
        .addEventListener("change", function (e) {
            const selectedPeriod = e.target.value;
            const selectedData = viewDataSets[selectedPeriod];
            viewChart.data.datasets[0].data = selectedData;
            viewChart.data.labels = labels[selectedPeriod];

            viewChart.data.datasets[0].backgroundColor = selectedData.map(
                (val) =>
                    val === Math.max(...selectedData) ? "#ccff00" : "#D9D9D9"
            );

            document.getElementById("view-count").innerText = Math.max(
                ...selectedData
            );

            viewChart.options.scales.y.ticks.stepSize =
                getStepSize(selectedData);
            viewChart.update(); // Update chart
        });
    // Data Chart Downloads
    const downloadsCtx = document
        .getElementById("downloadsChart")
        .getContext("2d");

    const downloadDataSets = {
        weekly: [800, 1200, 500, 2300, 4750, 950, 1300],
        monthly: Array.from(
            { length: 30 },
            () => Math.floor(Math.random() * 8000) + 1000
        ), // Random 30 hari
        yearly: Array.from(
            { length: 12 },
            () => Math.floor(Math.random() * 60000) + 5000
        ), // Random 12 bulan
    };

    function getStepSize(data) {
        const maxVal = Math.max(...data);
        const magnitude = Math.pow(10, Math.floor(Math.log10(maxVal)));
        return Math.ceil(maxVal / magnitude) * (magnitude / 5);
    }

    function createDownloadChart(data, labelSet) {
        return new Chart(downloadsCtx, {
            type: "bar",
            data: {
                labels: labelSet,
                datasets: [
                    {
                        label: "Downloads",
                        data: data,
                        backgroundColor: data.map((val) =>
                            val === Math.max(...data) ? "#ffcc00" : "#D9D9D9"
                        ),
                        borderRadius: 8,
                        maxBarThickness: 25,
                    },
                ],
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            title: () => "",
                            label: (tooltipItem) =>
                                tooltipItem.raw.toLocaleString(),
                        },
                        yAlign: "bottom",
                        displayColors: false,
                        backgroundColor: "#1e1e38",
                        bodyColor: "#ffffff",
                        padding: 10,
                        cornerRadius: 6,
                        bodyFont: {
                            size: 16,
                            family: "Poppins, Arial, sans-serif",
                        },
                    },
                },
                responsive: true,
                scales: {
                    x: { ticks: { display: true }, grid: { display: false } },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: getStepSize(data),
                        },
                    },
                },
            },
        });
    }

    let downloadChart = createDownloadChart(
        downloadDataSets.weekly,
        labels.weekly
    );

    document
        .getElementById("timeDownloadFilter")
        .addEventListener("change", function (e) {
            const selectedPeriod = e.target.value;
            const selectedData = downloadDataSets[selectedPeriod];
            downloadChart.data.datasets[0].data = selectedData;
            downloadChart.data.labels = labels[selectedPeriod];
            downloadChart.data.datasets[0].backgroundColor = selectedData.map(
                (val) =>
                    val === Math.max(...selectedData) ? "#ffcc00" : "#D9D9D9"
            );
            document.getElementById("download-count").innerText = Math.max(
                ...selectedData
            );
            downloadChart.options.scales.y.ticks.stepSize =
                getStepSize(selectedData);
            downloadChart.update();
        });

    statsDropdown.forEach((dropdown) => {
        dropdown.addEventListener("click", function () {
            // Toggle class 'open' untuk rotate icon arrow
            this.classList.toggle("open");
        });

        // Menutup dropdown saat klik di luar
        document.addEventListener("click", function (event) {
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove("open");
            }
        });
    });

    var followBtn = document.getElementById("button-follow");

    followBtn.addEventListener("click", function () {
        if (followBtn.className == "btn-follow") {
            followBtn.classList.add("btn-followed");
            followBtn.classList.remove("btn-follow");
            followBtn.innerText = "Followed";
        } else if (followBtn.className == "btn-followed") {
            followBtn.classList.add("btn-follow");
            followBtn.classList.remove("btn-followed");
            followBtn.innerText = "Follow";
        }
    });
});
