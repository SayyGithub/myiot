@extends('layout.main')

@section('title', 'Data Device')

@section('content')

<div class="header">
    <h1>Data Device</h1>

    @if(Auth::user()->role === 'admin')
        <a href="{{ route('device.create') }}" class="btn">
            Tambah Device
        </a>
    @endif
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Serial Number</th>
            <th>Topik</th>
            <th>Dibuat</th>

            @if(Auth::user()->role === 'admin')
                <th>Aksi</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @forelse ($devices as $device)
            <tr>
                <td>{{ $device->id }}</td>
                <td>{{ $device->serial_number }}</td>
                <td>{{ $device->topik }}</td>
                <td>{{ $device->created_at->format('d-m-Y H:i') }}</td>

                @if(Auth::user()->role === 'admin')
                    <td class="action-cell">
                        <div class="action-group">
                            <a href="{{ route('device.edit', $device->id) }}" class="action-btn btn-edit">
                                Edit
                            </a>

                            <form action="{{ route('device.destroy', $device->id) }}" method="POST" onsubmit="return confirm('Hapus device ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="action-btn btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="{{ Auth::user()->role === 'admin' ? 5 : 4 }}" style="text-align:center; color:#00ffff;">
                    Belum ada device
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection