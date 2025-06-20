@extends('layout.template')

@section('content')
    <div class="container mt-4 mb-4">

        {{-- Points Table --}}
        <div class="card">
            <div class="card-header">
                <h4>Points Table</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="pointstable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($points as $p)
                            <tr>
                                <td class="text-center">{{ $p->id }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->description }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                                        class="img-thumbnail" style="width: 200px; height: auto;"
                                        title="{{ $p->image }}">
                                </td>

                                <td class="text-center">{{ $p->created_at }}</td>
                                <td class="text-center">{{ $p->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Polyline Table --}}
        <div class="card mt-4">
            <div class="card-header">
                <h4>Data Polylines</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="polylinestable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($polylines as $p)
                            <tr>
                                <td class="text-center">{{ $p->id }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->description }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                                        class="img-thumbnail" style="width: 200px; height: auto;"
                                        title="{{ $p->image }}">
                                </td>

                                <td class="text-center">{{ $p->created_at }}</td>
                                <td class="text-center">{{ $p->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Polygon Table --}}
        <div class="card mt-4">
            <div class="card-header">
                <h4>Data Polygons</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="polygontable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($polygons as $p)
                            <tr>
                                <td class="text-center">{{ $p->id }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->description }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                                        class="img-thumbnail" style="width: 200px; height: auto;"
                                        title="{{ $p->image }}">
                                </td>

                                <td class="text-center">{{ $p->created_at }}</td>
                                <td class="text-center">{{ $p->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
        let pointstable = new DataTable('#pointstable');
        let polylinestable = new DataTable('#polylinestable');
        let polygonstable = new DataTable('#polygontable');
    </script>
@endsection
