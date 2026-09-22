<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white h5 mb-0">Manajemen Tugas</div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="title" class="form-control" placeholder="Masukkan tugas baru..." value="{{ old('title') }}">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tugas</th>
                                        <th class="text-center" style="width: 120px;">Status</th>
                                        <th class="text-center" style="width: 120px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tasks as $task)
                                        <tr>
                                            <td class="{{ $task->status ? 'text-decoration-line-through text-muted' : '' }}">
                                                {{ $task->title }}
                                            </td>
                                            <td class="text-center">
                                                @if ($task->status == 0)
                                                    <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success">Selesai</button>
                                                    </form>
                                                @else
                                                    <span class="badge bg-secondary">Tuntas</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus tugas ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Belum ada tugas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>