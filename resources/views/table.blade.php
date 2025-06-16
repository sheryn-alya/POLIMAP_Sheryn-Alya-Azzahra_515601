@extends('layout.template')

@section('content')
    <div class="container mt-4">

        {{-- Card: Points --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                <h4 class="text-center mb-2">Daftar Data Points</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered text-center" id="pointstable">
                        <thead class="table-dark">
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>description</th>
                                <th>image</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($points as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->description }}</td>
                                    <td>
                                        <img src="{{ asset('storage/images/' . $p->image) }}" alt="{{ $p->image }}"
                                            width="200" title="{{ $p->image }}">
                                    </td>
                                    <td>{{ $p->created_at }}</td>
                                    <td>{{ $p->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Card: Polylines --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                <h4 class="text-center mb-2">Daftar Data Polylines</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered text-center" id="polylinestable">
                        <thead class="table-dark">
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>description</th>
                                <th>image</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($polylines as $pl)
                                <tr>
                                    <td>{{ $pl->id }}</td>
                                    <td>{{ $pl->name }}</td>
                                    <td>{{ $pl->description }}</td>
                                    <td>
                                        <img src="{{ asset('storage/images/' . $pl->image) }}" alt="{{ $pl->image }}"
                                            width="200" title="{{ $pl->image }}">
                                    </td>
                                    <td>{{ $pl->created_at }}</td>
                                    <td>{{ $pl->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Card: Polygons --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                <h4 class="text-center mb-2">Daftar Data Polygons</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered text-center" id="polygonstable">
                        <thead class="table-dark">
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>description</th>
                                <th>image</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($polygons as $pg)
                                <tr>
                                    <td>{{ $pg->id }}</td>
                                    <td>{{ $pg->name }}</td>
                                    <td>{{ $pg->description }}</td>
                                    <td>
                                        <img src="{{ asset('storage/images/' . $pg->image) }}" alt="{{ $pg->image }}"
                                            width="200" title="{{ $pg->image }}">
                                    </td>
                                    <td>{{ $pg->created_at }}</td>
                                    <td>{{ $pg->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script>
        new tablepoints('#pointstable');
        new tablepolylines('#polylinestable');
        new tablepolygons('#polygonstable');
    </script>
@endsection
