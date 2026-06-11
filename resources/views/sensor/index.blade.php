@extends('layout.main')

@section('title', 'Data Sensor')

@section('content')
    <div class="header">
        <h1>Data Sensor</h1>
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('sensor.create') }}" class="btn">Tambah Data</a>
        @endif
    </div>

    <!-- table -->
     <table>
            <thead>
                <tr>
                    <th>Nama Sensor</th>
                    <th>Data</th>
                    
                    @if(Auth::user()->role === 'admin')
                <th>Aksi</th>
            @endif

                </tr>
            </thead>
          <tbody>
@forelse ($sensors as $sensor)
    <tr>
        <td>{{ $sensor->nama_sensor }}</td>
        <td>{{ $sensor->data }}</td>
            
        @if(Auth::user()->role === 'admin')
            <td class="action-cell">
                <div class="action-group">
                    <a href="{{ route('sensor.edit', $sensor->id) }}"
                       class="action-btn btn-edit">
                        Edit
                </a>

                <form action="{{ route('sensor.destroy', $sensor->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin hapus data ini?')">
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
                    Belum ada data sensor
                </td>
    </tr>
@endforelse
</tbody>

        </table>
@endsection