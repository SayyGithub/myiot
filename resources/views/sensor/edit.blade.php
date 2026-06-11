@extends('layout.main')

@section('title', 'Edit Data Sensor')

@push('styles')
<style>
.edit-wrapper {
    max-width: 720px;
    margin-top: 40px;
    padding: 40px;
    background: rgba(10, 14, 39, 0.75);
    backdrop-filter: blur(12px);
    border: 2px solid rgba(0, 255, 136, 0.25);
    border-radius: 12px;
    box-shadow:
        0 0 25px rgba(0, 255, 136, 0.15),
        inset 0 0 20px rgba(0, 255, 255, 0.03);
    position: relative;
    animation: fadeIn 0.8s ease-out;
}

.edit-wrapper::before,
.edit-wrapper::after {
    content: '';
    position: absolute;
    width: 60px;
    height: 60px;
    border: 2px solid rgba(0, 255, 136, 0.35);
}

.edit-wrapper::before {
    top: 12px;
    left: 12px;
    border-right: none;
    border-bottom: none;
}

.edit-wrapper::after {
    bottom: 12px;
    right: 12px;
    border-left: none;
    border-top: none;
}

.edit-wrapper h1 {
    font-family: 'Orbitron', sans-serif;
    font-size: 52px;
    font-weight: 900;
    color: #00ff88;
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom: 35px;
    line-height: 1.2;
    text-shadow:
        0 0 12px #00ff88,
        0 0 24px rgba(0, 255, 136, 0.5);
    animation: textGlow 2s ease-in-out infinite;
}

.edit-wrapper h1::before {
    content: '[ ';
    color: #00ffff;
}

.edit-wrapper h1::after {
    content: ' ]';
    color: #00ffff;
}

.form-group {
    margin-bottom: 28px;
    position: relative;
}

.form-group label {
    display: block;
    margin-bottom: 10px;
    font-family: 'Orbitron', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #00ffff;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.form-group input {
    width: 100%;
    padding: 18px 20px;
    background: rgba(0, 10, 30, 0.9);
    border: 2px solid rgba(0, 255, 136, 0.3);
    color: #00ff88;
    font-size: 18px;
    font-family: 'Rajdhani', sans-serif;
    font-weight: 600;
    outline: none;
    transition: all 0.3s ease;
    box-shadow: inset 0 0 10px rgba(0, 255, 136, 0.05);
}

.form-group input:focus {
    border-color: #00ffff;
    box-shadow:
        0 0 20px rgba(0, 255, 255, 0.25),
        inset 0 0 10px rgba(0, 255, 255, 0.08);
    color: #00ffff;
    transform: scale(1.01);
}

.form-group input:hover {
    border-color: rgba(0, 255, 255, 0.5);
}

.error-alert {
    margin-bottom: 25px;
    padding: 16px 20px;
    background: rgba(255, 0, 76, 0.08);
    border: 1px solid rgba(255, 0, 76, 0.4);
    color: #ff4d6d;
    font-weight: 700;
    border-radius: 6px;
    box-shadow: 0 0 15px rgba(255, 0, 76, 0.15);
}

.error-alert div {
    margin-bottom: 6px;
}

.error-alert div:last-child {
    margin-bottom: 0;
}

.edit-wrapper .btn {
    margin-top: 10px;
    min-width: 220px;
    font-size: 20px;
    padding: 16px 30px;
    display: inline-block;
    text-align: center;
}

.edit-wrapper .btn:hover {
    transform: translateY(-3px) scale(1.02);
}

@media (max-width: 768px) {
    .edit-wrapper {
        padding: 28px;
        margin-top: 20px;
    }

    .edit-wrapper h1 {
        font-size: 34px;
        letter-spacing: 2px;
    }

    .form-group label {
        font-size: 15px;
    }

    .form-group input {
        font-size: 16px;
        padding: 14px 16px;
    }

    .edit-wrapper .btn {
        width: 100%;
        min-width: unset;
    }
}
</style>
@endpush

@section('content')

<div class="edit-wrapper">
   
 <h1>Edit Data Sensor</h1>
    @if ($errors->any())
        <div class="error-alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('sensor.update', $sensor->id) }}" method="POST" id="sensorForm">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Sensor</label>
            <input type="text"
                   name="nama_sensor"
                   value="{{ old('nama_sensor', $sensor->nama_sensor) }}"
                   required>
        </div>

        <div class="form-group">
            <label>Data Sensor</label>
            <input type="number"
                   name="data"
                   value="{{ old('data', $sensor->data) }}"
                   required>
        </div>

        <button type="submit" class="btn" id="submitBtn">Update</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('sensorForm');
    const submitBtn = document.getElementById('submitBtn');
    const inputs = document.querySelectorAll('.form-group input');

    inputs.forEach(input => {
        input.addEventListener('input', function () {
            if (this.value) {
                this.style.borderColor = '#00ffff';
                this.style.boxShadow = '0 0 15px rgba(0, 255, 255, 0.2)';
            } else {
                this.style.borderColor = 'rgba(0, 255, 136, 0.3)';
                this.style.boxShadow = 'none';
            }
        });

        input.addEventListener('focus', function () {
            this.parentElement.style.transform = 'scale(1.02)';
            this.parentElement.style.transition = 'transform 0.3s ease';
        });

        input.addEventListener('blur', function () {
            this.parentElement.style.transform = 'scale(1)';
        });
    });

    if (form) {
        form.addEventListener('submit', function () {
            submitBtn.classList.add('loading');
            submitBtn.textContent = 'PROCESSING...';
            submitBtn.disabled = true;
        });
    }
});
</script>
@endpush