@extends('layout.main')

@section('title', 'Beranda IoT')

@section('content')

<div class="header">
    <h1>Beranda IoT</h1>
</div>

<div class="dashboard-grid">

    <div class="iot-card">
        <h3>Suhu</h3>
        <p class="value suhu-value">--</p>
    </div>

    <div class="iot-card">
        <h3>Kelembapan</h3>
        <p class="value humidity-value">--</p>
    </div>

    <div class="iot-card">
        <h3>Posisi Servo</h3>

        <input
            type="range"
            min="0"
            max="180"
            value="90"
            id="servoSlider"
            class="servo-slider"
            @if(Auth::user()->role !== 'admin') disabled @endif
        >

        <p class="value" id="servoValue">90°</p>

        @if(Auth::user()->role !== 'admin')
            <small class="readonly-text">Mode lihat saja</small>
        @endif
    </div>

    <div class="iot-card">
        <h3>Display LCD</h3>

        <input
            type="text"
            id="lcdInput"
            class="lcd-input"
            placeholder="Masukkan teks"
            @if(Auth::user()->role !== 'admin') disabled @endif
        >

        <button
            type="button"
            id="lcdButton"
            class="btn lcd-btn"
            @if(Auth::user()->role !== 'admin') disabled @endif
        >
            Submit
        </button>

        @if(Auth::user()->role !== 'admin')
            <small class="readonly-text">Hanya admin yang bisa mengirim</small>
        @endif
    </div>

</div>

<div class="device-panel">
    <h2>Monitoring Device</h2>

    <table>
        <thead>
            <tr>
                <th>ID Device</th>
                <th>Topik</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($devices as $device)
                <tr>
                    <td>{{ $device->serial_number }}</td>
                    <td>{{ $device->topik }}</td>
                    <td>
    <span
        class="{{ $device->status === 'Online' ? 'status-online' : 'status-offline' }}"
        data-device-status="{{ $device->serial_number }}"
    >
        {{ $device->status ?? 'Offline' }}
    </span>
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align:center; color:#00ffff;">
                        Belum ada device
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    margin-bottom: 40px;
}

.iot-card,
.device-panel {
    background: rgba(10, 14, 39, 0.75);
    border: 2px solid rgba(0, 255, 136, 0.35);
    padding: 28px;
    box-shadow: 0 0 25px rgba(0, 255, 136, 0.2);
    clip-path: polygon(16px 0, 100% 0, 100% calc(100% - 16px), calc(100% - 16px) 100%, 0 100%, 0 16px);
}

.iot-card h3,
.device-panel h2 {
    font-family: 'Orbitron', sans-serif;
    color: #00ffff;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 20px;
}

.value {
    text-align: center;
    font-size: 34px;
    font-family: 'Orbitron', sans-serif;
    color: #00ff88;
    text-shadow: 0 0 15px #00ff88;
}

.suhu-value {
    color: #ff4d8d;
    text-shadow: 0 0 15px #ff4d8d;
}

.humidity-value {
    color: #00ffff;
    text-shadow: 0 0 15px #00ffff;
}

.servo-slider {
    width: 100%;
    margin: 16px 0;
    accent-color: #00ff88;
}

.lcd-input {
    width: 100%;
    padding: 14px;
    margin-bottom: 16px;
    background: rgba(0, 0, 0, 0.35);
    border: 2px solid #00ff88;
    color: #00ff88;
    font-family: 'Rajdhani', sans-serif;
    font-size: 18px;
    outline: none;
}

.lcd-input:focus {
    border-color: #00ffff;
    box-shadow: 0 0 15px rgba(0,255,255,.5);
}

.lcd-btn {
    width: 100%;
}

.lcd-btn:disabled,
.servo-slider:disabled,
.lcd-input:disabled {
    opacity: 0.45;
    cursor: not-allowed;
}

.readonly-text {
    display: block;
    margin-top: 12px;
    text-align: center;
    color: #ffcc00;
    font-weight: 700;
}

.status-online {
    color: #00ff88;
    font-weight: 900;
    text-shadow: 0 0 10px #00ff88;
}

.status-offline {
    color: #ff004c;
    font-weight: 900;
    text-shadow: 0 0 10px #ff004c;
}

@media (max-width: 1024px) {
    .dashboard-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 640px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
}
</style>
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>



<script>
const isAdmin = "{{ Auth::user()->role }}" === "admin";


const MQTT_HOST = "wss://{{ $mqtt['host'] }}:{{ $mqtt['ws_port'] }}/mqtt";
const MQTT_USERNAME = "{{ $mqtt['username'] }}";
const MQTT_PASSWORD = "{{ $mqtt['password'] }}";
const MQTT_CLIENT_ID = "myiot-web-" + Math.random().toString(16).substring(2, 10);

const client = mqtt.connect(MQTT_HOST, {
    username: MQTT_USERNAME,
    password: MQTT_PASSWORD,
    clientId: MQTT_CLIENT_ID,
    clean: true,
    reconnectPeriod: 3000,
    connectTimeout: 30000,
});

const servoSlider = document.getElementById("servoSlider");
const servoValue = document.getElementById("servoValue");
const lcdInput = document.getElementById("lcdInput");
const lcdButton = document.getElementById("lcdButton");

const suhuValue = document.querySelector(".suhu-value");
const humidityValue = document.querySelector(".humidity-value");


const DEVICE_TIMEOUT = 10000;
const SENSOR_TIMEOUT = 10000;

let lastSuhuSeen = null;
let lastKelembabanSeen = null;
let lastDeviceSeen = {};

client.on("connect", function () {
    console.log("Connected to Shiftr MQTT");
    console.log("Client ID:", MQTT_CLIENT_ID);

    client.subscribe("nusabot/suhu");
    client.subscribe("nusabot/kelembaban");
    client.subscribe("nusabot/servo");
    client.subscribe("nusabot/lcd");
    client.subscribe("nusabot/device/#");
});

client.on("error", function (error) {
    console.error("MQTT Error:", error);
});

client.on("offline", function () {
    console.warn("MQTT Offline");
});

client.on("reconnect", function () {
    console.log("MQTT Reconnecting...");
});

client.on("message", function (topic, message) {
    const payload = message.toString();

    console.log("Topic:", topic);
    console.log("Payload:", payload);

    if (topic === "nusabot/suhu" && suhuValue) {
        suhuValue.textContent = payload + " °C";
        lastSuhuSeen = Date.now();
        saveSensorToDatabase("suhu", payload, topic);
        return;
    }

    if (topic === "nusabot/kelembaban" && humidityValue) {
        humidityValue.textContent = payload + " %";
        lastKelembabanSeen = Date.now();
        saveSensorToDatabase("kelembaban", payload, topic);
        return;
    }

    if (topic === "nusabot/servo" && servoSlider && servoValue) {
        servoSlider.value = payload;
        servoValue.textContent = payload + "°";
        return;
    }

    if (topic === "nusabot/lcd" && lcdInput) {
        lcdInput.value = payload;
        return;
    }

    if (topic.startsWith("nusabot/device/")) {
        const serialNumber = topic.replace("nusabot/device/", "");

        lastDeviceSeen[serialNumber] = Date.now();

        updateDeviceStatus(serialNumber, "Online");
        return;
    }
});


if (servoSlider && servoValue) {
    servoSlider.addEventListener("input", function () {
        servoValue.textContent = this.value + "°";
    });

    servoSlider.addEventListener("change", function () {
        if (!isAdmin) {
            return;
        }

        client.publish("nusabot/servo", this.value, {
            qos: 1,
            retain: true,
        });

        console.log("Servo published:", this.value);
    });
}


if (lcdButton && lcdInput) {
    lcdButton.addEventListener("click", function () {
        if (!isAdmin) {
            return;
        }

        const text = lcdInput.value.trim();

        if (!text) {
            alert("Teks LCD harus diisi.");
            return;
        }

        client.publish("nusabot/lcd", text, {
            qos: 1,
            retain: true,
        });

        console.log("LCD published:", text);
    });
}


function saveSensorToDatabase(namaSensor, dataSensor, topikSensor) {
    fetch("/api/sensor", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
        },
        body: JSON.stringify({
            nama_sensor: namaSensor,
            data: dataSensor,
            topik: topikSensor,
        }),
    })
    .then(response => response.json())
    .then(result => {
        console.log("Sensor saved:", result);
    })
    .catch(error => {
        console.error("Sensor save failed:", error);
    });
}


function updateDeviceStatus(serialNumber, status) {
    const statusElement = document.querySelector(`[data-device-status="${serialNumber}"]`);

    if (statusElement) {
        statusElement.textContent = status;
        statusElement.classList.remove("status-online", "status-offline");

        if (status === "Online") {
            statusElement.classList.add("status-online");
        } else {
            statusElement.classList.add("status-offline");
        }
    }

    fetch("/api/device/status", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
        },
        body: JSON.stringify({
            serial_number: serialNumber,
            status: status,
        }),
    })
    .then(response => response.json())
    .then(result => {
        console.log("Device status saved:", result);
    })
    .catch(error => {
        console.error("Device status save failed:", error);
    });
}


setInterval(function () {
    const now = Date.now();

    if (suhuValue && lastSuhuSeen !== null && now - lastSuhuSeen > SENSOR_TIMEOUT) {
        suhuValue.textContent = "-- °C";
    }

    if (humidityValue && lastKelembabanSeen !== null && now - lastKelembabanSeen > SENSOR_TIMEOUT) {
        humidityValue.textContent = "-- %";
    }

    Object.keys(lastDeviceSeen).forEach(function (serialNumber) {
        if (now - lastDeviceSeen[serialNumber] > DEVICE_TIMEOUT) {
            updateDeviceStatus(serialNumber, "Offline");
            delete lastDeviceSeen[serialNumber];
        }
    });
}, 3000);
</script>

@endsection