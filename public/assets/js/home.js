function updateClock() {
    const now = new Date();

    document.getElementById("clock").textContent =
        now.toLocaleTimeString("id-ID", {
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit"
        });

    document.getElementById("date").textContent =
        now.toLocaleDateString("id-ID", {
            weekday: "long",
            day: "numeric",
            month: "long",
            year: "numeric"
        });
}

updateClock();
setInterval(updateClock, 1000);

function setText(id, value) {
    const el = document.getElementById(id);
    if (el) el.textContent = value;
}

async function loadWeather() {
    try {
        const response = await fetch("api/weather.php", { cache: "no-store" });
        const result = await response.json();

        if (!result.success) throw new Error(result.message);

        const data = result.data;

        setText("weatherLocation", data.location);
        setText("weatherTemperature", `${data.temperature}${data.temperature_unit}`);
        setText("weatherHumidity", `${data.humidity}${data.humidity_unit}`);
        setText("weatherWind", `${data.wind} km/jam`);

        const descriptions = {
            0: ["☀️", "Cerah"],
            1: ["🌤️", "Cerah Berawan"],
            2: ["⛅", "Berawan Sebagian"],
            3: ["☁️", "Berawan"],
            45: ["🌫️", "Berkabut"],
            48: ["🌫️", "Berkabut"],
            51: ["🌦️", "Gerimis"],
            53: ["🌦️", "Gerimis"],
            55: ["🌧️", "Gerimis Lebat"],
            61: ["🌧️", "Hujan Ringan"],
            63: ["🌧️", "Hujan"],
            65: ["🌧️", "Hujan Lebat"],
            80: ["🌦️", "Hujan"],
            81: ["🌧️", "Hujan"],
            82: ["⛈️", "Hujan Sangat Lebat"],
            95: ["⛈️", "Badai Petir"],
            96: ["⛈️", "Badai Petir"],
            99: ["⛈️", "Badai Petir"]
        };

        const condition = descriptions[data.weather_code] || ["🌡️", "Kondisi tidak diketahui"];
        setText("weatherIcon", condition[0]);
        setText("weatherCondition", condition[1]);
        setText("weatherUpdated", `Update ${data.time || ""} • Sumber: Open-Meteo`);
    } catch (error) {
        setText("weatherCondition", "Data cuaca sementara tidak tersedia");
        setText("weatherUpdated", "Sumber: Open-Meteo");
        console.error(error);
    }
}

async function loadBps() {
    try {
        const response = await fetch("api/bps.php", { cache: "no-store" });
        const result = await response.json();

        if (!result.success) {
            setText("bpsChartStatus", result.message || "BPS API belum dikonfigurasi.");
            return;
        }

        const data = result.data;

        renderBpsCard(data.BPS_POPULATION_VAR, "populationValue", "populationPeriod", "orang");
        renderBpsCard(data.BPS_ECONOMIC_GROWTH_VAR, "growthValue", "growthPeriod", "%");
        renderBpsCard(data.BPS_UNEMPLOYMENT_VAR, "unemploymentValue", "unemploymentPeriod", "%");

        const population = data.BPS_POPULATION_VAR;
        if (population && !population.error && Array.isArray(population.series)) {
            renderPopulationChart(population.series);
            setText("bpsChartStatus", `Sumber: BPS WebAPI • var ${population.var_id}`);
        } else {
            setText("bpsChartStatus", "Data populasi belum tersedia dari BPS API.");
        }
    } catch (error) {
        setText("bpsChartStatus", "BPS API belum dikonfigurasi atau tidak dapat diakses.");
        console.error(error);
    }
}

function renderBpsCard(item, valueId, periodId, fallbackUnit) {
    if (!item || item.error || !item.latest) {
        setText(valueId, "--");
        setText(periodId, "Data belum tersedia");
        return;
    }

    const value = Number(item.latest.value);
    const formatted = Number.isFinite(value)
        ? new Intl.NumberFormat("id-ID", {
            maximumFractionDigits: 2
        }).format(value)
        : item.latest.value;

    const unit = item.unit || fallbackUnit || "";
    setText(valueId, `${formatted} ${unit}`.trim());
    setText(periodId, `Periode ${item.latest.year}`);
}

let populationChart;

function renderPopulationChart(series) {
    const canvas = document.getElementById("populationChart");
    if (!canvas) return;

    if (populationChart) populationChart.destroy();

    populationChart = new Chart(canvas, {
        type: "line",
        data: {
            labels: series.map(item => item.year),
            datasets: [{
                label: "Jumlah Penduduk",
                data: series.map(item => item.value),
                tension: 0.35,
                fill: true,
                borderWidth: 2,
                pointRadius: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    ticks: {
                        callback: value => new Intl.NumberFormat("id-ID").format(value)
                    }
                }
            }
        }
    });
}

async function loadEarthquake() {
    try {
        const response = await fetch("api/earthquake.php", { cache: "no-store" });
        const result = await response.json();

        if (!result.success) throw new Error(result.message);

        const data = result.data;

        setText("quakeMagnitude", `M ${data.magnitude}`);
        setText("quakeRegion", data.wilayah);
        setText("quakeTime", `${data.tanggal} ${data.jam}`);
        setText("quakeDepth", data.kedalaman);
        setText("quakePotential", data.potensi && data.potensi !== "-"
            ? data.potensi
            : "Sumber: BMKG");
    } catch (error) {
        setText("quakeMagnitude", "M --");
        setText("quakeRegion", "Informasi gempa sementara tidak tersedia");
        setText("quakeTime", "--");
        setText("quakeDepth", "--");
        setText("quakePotential", "Sumber: BMKG");
        console.error(error);
    }
}

function searchPublication() {
    const input = document.getElementById("homeSearch");
    const hint = document.getElementById("homeSearchHint");
    const keyword = input.value.trim();

    if (keyword === "") {
        hint.textContent = "";
        return;
    }

    fetch("page11A_gethint.php?keyword=" + encodeURIComponent(keyword))
        .then(response => response.json())
        .then(data => {
            const valid = data.filter(item => item.judul && item.judul !== "no suggestion");

            if (valid.length === 0) {
                hint.innerHTML = 'Tidak ada publikasi yang cocok. <a href="page09A.php">Buka daftar publikasi</a>.';
                return;
            }

            hint.innerHTML = valid.slice(0, 5).map(item =>
                `<a href="page09A.php">${escapeHtml(item.judul)}</a>`
            ).join("");
        })
        .catch(() => {
            hint.textContent = "Pencarian sementara tidak tersedia.";
        });
}

async function loadInfographics() {
    const grid = document.getElementById("infographicGrid");
    if (!grid) return;

    // Tampilkan status loading
    grid.innerHTML = `
        <div class="empty-publications">
            Memuat infografis terbaru dari BPS...
        </div>
    `;

    setText("infographicStatus", "Mengambil data BPS...");

    try {
        // Tambahkan timestamp agar browser tidak memakai cache lama
        const response = await fetch(
            "api/bps/infographic.php?t=" + Date.now(),
            {
                cache: "no-store"
            }
        );

        if (!response.ok) {
            throw new Error(
                "HTTP Error " + response.status
            );
        }

        const result = await response.json();

        console.log("DATA INFOGRAFIS BPS:", result);

        if (!result.success) {
            throw new Error(
                result.message || "Gagal mengambil data BPS"
            );
        }

        const items = Array.isArray(result.data)
            ? result.data.slice(0, 6)
            : [];

        console.log("INFOGRAFIS TERBARU:", items);

        if (items.length === 0) {
            grid.innerHTML = `
                <div class="empty-publications">
                    Belum ada infografis dari BPS.
                </div>
            `;

            setText(
                "infographicStatus",
                "Tidak ada data"
            );

            return;
        }

        grid.innerHTML = items.map(item => {

            const title = escapeHtml(
                item.title || "Infografis BPS"
            );

            const date = escapeHtml(
                item.date || ""
            );

            const image = escapeHtml(
                item.image || ""
            );

            // ID asli dari BPS WebAPI
            const infId = item.inf_id || item.id;

            // Link menuju halaman DETAIL infografis BPS
            const detailUrl = infId
                ? `https://sulsel.bps.go.id/id/infographic?id=${encodeURIComponent(infId)}`
                : "https://sulsel.bps.go.id/id/infographic";

            return `
                <a
                    href="${detailUrl}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="infographic-card"
                >

                    <div class="infographic-image">
                        ${
                            image
                                ? `
                                    <img
                                        src="${image}"
                                        alt="${title}"
                                        loading="lazy"
                                    >
                                `
                                : `
                                    <span>
                                        Tanpa gambar
                                    </span>
                                `
                        }
                    </div>

                    <div class="infographic-info">

                        <span class="infographic-date">
                            ${date}
                        </span>

                        <h3>
                            ${title}
                        </h3>

                        <span class="infographic-link">
                            Lihat di BPS ↗
                        </span>

                    </div>

                </a>
            `;

        }).join("");

        setText(
            "infographicStatus",
            `BPS WebAPI • ${items.length} data terbaru`
        );

    } catch (error) {

        console.error(
            "ERROR INFOGRAFIS BPS:",
            error
        );

        grid.innerHTML = `
            <div class="empty-publications">
                Infografis BPS sementara tidak tersedia.
            </div>
        `;

        setText(
            "infographicStatus",
            "API tidak tersedia"
        );
    }
}

function escapeHtml(value) {
    const div = document.createElement("div");
    div.textContent = value;
    return div.innerHTML;
}

document.getElementById("homeSearch")?.addEventListener("keydown", event => {
    if (event.key === "Enter") searchPublication();
});

loadWeather();
loadBps();
loadEarthquake();

// External API data is refreshed every 10 minutes, not every second.
setInterval(loadWeather, 10 * 60 * 1000);
setInterval(loadBps, 10 * 60 * 1000);
setInterval(loadEarthquake, 10 * 60 * 1000);

// Infografis BPS dimuat langsung dari WebAPI dan diperbarui setiap 10 menit.
loadInfographics();
setInterval(loadInfographics, 10 * 60 * 1000);
