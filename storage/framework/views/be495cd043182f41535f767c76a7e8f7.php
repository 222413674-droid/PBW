<?php $__env->startSection('title', 'Home - BPS Provinsi Sulawesi Selatan'); ?>

<?php $__env->startSection('content'); ?>
<main class="home-main">
<section class="home-welcome">
    <div><span class="eyebrow">PORTAL DATA STATISTIK</span><h1><span id="welcomeGreeting">Selamat Datang</span></h1><p>BPS Provinsi Sulawesi Selatan</p></div>
    <div class="clock-box"><strong id="clock">--:--:--</strong><span id="date">Memuat tanggal...</span></div>
</section>

<section class="hero-dashboard">
    <div class="hero-copy">
        <span class="eyebrow">DATA UNTUK INDONESIA</span>
        <h2>Lembaga yang Independen, Terpercaya, dan Berperan Aktif dalam Menyajikan Data Statistik Sulawesi Selatan</h2>
        <p>Jelajahi publikasi, informasi statistik, infografis BPS, kondisi cuaca terkini, serta informasi gempa dalam satu dashboard.</p>
        <div class="home-search"><input type="text" id="homeSearch" placeholder="Cari judul publikasi..." autocomplete="off"><button type="button" onclick="searchPublication()">🔍</button></div>
        <div id="homeSearchHint" class="home-search-hint"></div>
    </div>
    <div class="hero-mark"><img src="<?php echo e(asset('assets/img/bps.jpg')); ?>" alt="Logo BPS"><span>STATISTIK<br>TERPERCAYA</span></div>
</section>

<section class="section-heading"><div><span class="eyebrow">INFORMASI REALTIME</span><h2>Data Hari Ini</h2></div><span class="live-badge"><span></span> LIVE</span></section>
<section class="dashboard-grid">
    <article class="dashboard-card weather-card-home"><div class="card-top"><div><span class="card-label">CUACA SAAT INI</span><h3 id="weatherLocation">Makassar</h3></div><span id="weatherIcon" class="big-icon">🌤️</span></div><div class="weather-temperature" id="weatherTemperature">--°C</div><div class="weather-condition" id="weatherCondition">Memuat data cuaca...</div><div class="mini-stats"><div><span>💧 Kelembapan</span><strong id="weatherHumidity">--%</strong></div><div><span>💨 Angin</span><strong id="weatherWind">-- km/jam</strong></div></div><small id="weatherUpdated">Sumber: Open-Meteo</small></article>
    <article class="dashboard-card"><div class="card-top"><div><span class="card-label">POPULASI</span><h3>Jumlah Penduduk</h3></div><span class="card-icon">👥</span></div><div class="bps-value" id="populationValue">--</div><p id="populationPeriod">Menunggu BPS API...</p><small>Sumber: BPS WebAPI</small></article>
    <article class="dashboard-card"><div class="card-top"><div><span class="card-label">EKONOMI</span><h3>Pertumbuhan Ekonomi</h3></div><span class="card-icon">📈</span></div><div class="bps-value" id="growthValue">--</div><p id="growthPeriod">Menunggu BPS API...</p><small>Sumber: BPS WebAPI</small></article>
    <article class="dashboard-card"><div class="card-top"><div><span class="card-label">KETENAGAKERJAAN</span><h3>Pengangguran</h3></div><span class="card-icon">💼</span></div><div class="bps-value" id="unemploymentValue">--</div><p id="unemploymentPeriod">Menunggu BPS API...</p><small>Sumber: BPS WebAPI</small></article>
</section>

<section class="analytics-layout">
    <article class="dashboard-card chart-card"><div class="card-top"><div><span class="card-label">VISUALISASI BPS</span><h3>Perkembangan Jumlah Penduduk</h3></div><span class="card-icon">📊</span></div><div class="chart-wrapper"><canvas id="populationChart"></canvas></div><p id="bpsChartStatus" class="api-status">Mengambil data BPS...</p></article>
    <article class="dashboard-card earthquake-card-home"><div class="card-top"><div><span class="card-label">BMKG</span><h3>Gempa Terbaru</h3></div><span class="card-icon">🌋</span></div><div class="quake-magnitude" id="quakeMagnitude">M --</div><p class="quake-region" id="quakeRegion">Memuat informasi gempa...</p><div class="quake-details"><div><span>Waktu</span><strong id="quakeTime">--</strong></div><div><span>Kedalaman</span><strong id="quakeDepth">--</strong></div></div><div class="quake-potential" id="quakePotential">Sumber: BMKG</div></article>
</section>

<section class="section-heading publications-heading"><div><span class="eyebrow">BPS WEBAPI</span><h2>Infografis Terbaru</h2></div><span class="api-status" id="infographicStatus">Mengambil data BPS...</span></section>
<section class="infographic-grid" id="infographicGrid"><div class="empty-publications">Memuat infografis terbaru dari BPS WebAPI...</div></section>

<section class="section-heading publications-heading"><div><span class="eyebrow">DATABASE WEBSITE</span><h2>Publikasi Terbaru</h2></div><a class="section-link" href="<?php echo e(route('publikasi.index')); ?>">Lihat semua →</a></section>
<section class="publication-grid">
<?php $__empty_1 = true; $__currentLoopData = $recentPublications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<a class="publication-card" href="<?php echo e($pub->link ?: route('publikasi.index')); ?>" <?php if($pub->link): ?> target="_blank" rel="noopener" <?php endif; ?>>
    <div class="publication-cover"><?php if($pub->sampul): ?><img src="<?php echo e(asset('storage/'.$pub->sampul)); ?>" alt="<?php echo e($pub->judul); ?>"><?php else: ?><div class="no-cover">BPS</div><?php endif; ?></div>
    <div class="publication-info"><span><?php echo e(optional($pub->tanggal_rilis)->format('d/m/Y')); ?></span><h3><?php echo e($pub->judul); ?></h3><small>Lihat publikasi ↗</small></div>
</a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><div class="empty-publications">Belum ada publikasi pada database.</div><?php endif; ?>
</section>
</main>
<footer class="home-footer"><strong>BPS PROVINSI SULAWESI SELATAN</strong><span>Portal Statistik • <?php echo e(date('Y')); ?></span></footer>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const API={bps:<?php echo json_encode(route('api.bps'), 15, 512) ?>,weather:<?php echo json_encode(route('api.weather'), 15, 512) ?>,earthquake:<?php echo json_encode(route('api.earthquake'), 15, 512) ?>,infographics:<?php echo json_encode(route('api.infographics'), 15, 512) ?>,publications:<?php echo json_encode(route('api.publikasi'), 15, 512) ?>};
function setText(id,value){const e=document.getElementById(id);if(e)e.textContent=value;}
function updateClock(){const n=new Date();setText('clock',n.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit',second:'2-digit'}));setText('date',n.toLocaleDateString('id-ID',{weekday:'long',day:'numeric',month:'long',year:'numeric'}));}
updateClock();setInterval(updateClock,1000);
function weatherLabel(code){const m={0:['☀️','Cerah'],1:['🌤️','Cerah Berawan'],2:['⛅','Berawan Sebagian'],3:['☁️','Berawan'],45:['🌫️','Berkabut'],48:['🌫️','Berkabut'],51:['🌦️','Gerimis'],53:['🌦️','Gerimis'],55:['🌧️','Gerimis Lebat'],61:['🌧️','Hujan Ringan'],63:['🌧️','Hujan'],65:['🌧️','Hujan Lebat'],80:['🌦️','Hujan'],81:['🌧️','Hujan'],82:['⛈️','Hujan Sangat Lebat'],95:['⛈️','Badai Petir'],96:['⛈️','Badai Petir'],99:['⛈️','Badai Petir']};return m[code]||['🌡️','Kondisi tidak diketahui'];}
async function loadWeather(){try{const r=await fetch(API.weather);const j=await r.json();if(!j.success)throw Error();const d=j.data;setText('weatherLocation',d.location);setText('weatherTemperature',`${d.temperature}${d.temperature_unit}`);setText('weatherHumidity',`${d.humidity}${d.humidity_unit}`);setText('weatherWind',`${d.wind} km/jam`);const c=weatherLabel(d.weather_code);setText('weatherIcon',c[0]);setText('weatherCondition',c[1]);setText('weatherUpdated',`Update ${d.time||''} • Sumber: Open-Meteo`);}catch(e){setText('weatherCondition','Data cuaca sementara tidak tersedia');}}
function renderBpsCard(item,valueId,periodId,unit){if(!item||item.error||!item.latest){setText(valueId,'--');setText(periodId,'Data belum tersedia');return;}const v=Number(item.latest.value);setText(valueId,`${new Intl.NumberFormat('id-ID',{maximumFractionDigits:2}).format(v)} ${item.unit||unit}`);setText(periodId,`Periode ${item.latest.year}`);}
let populationChart;
function renderPopulationChart(series){const c=document.getElementById('populationChart');if(!c)return;if(populationChart)populationChart.destroy();populationChart=new Chart(c,{type:'line',data:{labels:series.map(x=>x.year),datasets:[{label:'Jumlah Penduduk',data:series.map(x=>x.value),tension:.35,fill:true,borderWidth:2,pointRadius:3}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{y:{beginAtZero:false,ticks:{callback:v=>new Intl.NumberFormat('id-ID').format(v)}}}}});}
async function loadBps(){try{const r=await fetch(API.bps);const j=await r.json();if(!j.success)throw Error(j.message);const d=j.data;renderBpsCard(d.BPS_POPULATION_VAR,'populationValue','populationPeriod','orang');renderBpsCard(d.BPS_ECONOMIC_GROWTH_VAR,'growthValue','growthPeriod','%');renderBpsCard(d.BPS_UNEMPLOYMENT_VAR,'unemploymentValue','unemploymentPeriod','%');if(d.BPS_POPULATION_VAR?.series)renderPopulationChart(d.BPS_POPULATION_VAR.series);setText('bpsChartStatus','Sumber: BPS WebAPI');}catch(e){setText('bpsChartStatus','BPS API belum dikonfigurasi atau tidak dapat diakses.');}}
async function loadEarthquake(){try{const r=await fetch(API.earthquake);const j=await r.json();if(!j.success)throw Error();const d=j.data;setText('quakeMagnitude',`M ${d.magnitude}`);setText('quakeRegion',d.wilayah);setText('quakeTime',`${d.tanggal} ${d.jam}`);setText('quakeDepth',d.kedalaman);setText('quakePotential',d.potensi||'Sumber: BMKG');}catch(e){setText('quakeRegion','Informasi gempa sementara tidak tersedia');}}
async function loadInfographics(){const g=document.getElementById('infographicGrid');try{const r=await fetch(API.infographics);const j=await r.json();if(!j.success)throw Error(j.message);const items=j.data||[];if(!items.length){g.innerHTML='<div class="empty-publications">Belum ada infografis dari BPS.</div>';return;}g.innerHTML=items.map(x=>`<a href="https://sulsel.bps.go.id/id/infographic?id=${encodeURIComponent(x.inf_id||x.id||'')}" target="_blank" rel="noopener" class="infographic-card"><div class="infographic-image">${x.image?`<img src="${x.image}" alt="${escapeHtml(x.title||'Infografis BPS')}" loading="lazy">`:'<span>Tanpa gambar</span>'}</div><div class="infographic-info"><span>${escapeHtml(x.date||'')}</span><h3>${escapeHtml(x.title||'Infografis BPS')}</h3></div></a>`).join('');setText('infographicStatus',`${items.length} infografis`);}catch(e){g.innerHTML='<div class="empty-publications">Infografis sementara tidak tersedia.</div>';setText('infographicStatus','Tidak tersedia');}}
function escapeHtml(s){return String(s).replace(/[&<>'"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#39;','"':'&quot;'}[c]));}
async function searchPublication(){const q=document.getElementById('homeSearch').value.trim();const h=document.getElementById('homeSearchHint');if(!q){h.textContent='';return;}try{const r=await fetch(API.publications+'?keyword='+encodeURIComponent(q));const j=await r.json();const items=j.data||[];h.innerHTML=items.length?items.slice(0,5).map(x=>`<a href="${<?php echo json_encode(route('publikasi.index'), 15, 512) ?>}?q=${encodeURIComponent(x.judul)}">${escapeHtml(x.judul)}</a>`).join(''):'Tidak ada publikasi yang cocok.';}catch(e){h.textContent='Pencarian sementara tidak tersedia.';}}
loadWeather();loadBps();loadEarthquake();loadInfographics();
document.addEventListener('DOMContentLoaded',()=>document.body.classList.add('fade-in'));
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\webbps_laravel_bps_p\resources\views/home/index.blade.php ENDPATH**/ ?>