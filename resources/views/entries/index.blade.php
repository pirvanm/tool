@extends('dashboard.base')

@section('custom-css')
<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

<style>
  .dataTables_paginate {
    display: flex !important;
    gap: 1rem !important;
    align-items: center;
    justify-content: flex-end;
  }

  .paginate_button {
    padding: 1rem;
    cursor: pointer;
  }

  .current {
    background-color: #eee !important;
    color: #111 !important;
  }
</style>
@endsection

@section('content')

          <div class="container-fluid">
            <div class="fade-in">              
              <div class="card">
                <div class="card-body">
                  <table id="mytable" class="table table-responsive-sm table-hover table-outline mb-0">
                    <thead class="thead-light">
                        <tr>
                        <th>Name</th>
                        <th class="text-center">Email</th>
                        <th>Color1</th>
                        <th>Color2</th>
                        <th>Color3</th>
                        <th class="text-center">Country</th>
                        <th class="text-center">IP</th>
                        <th>User Agent</th>
                        <th>Created At</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

@endsection

@section('javascript')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
       $(document).ready( function () {
            $('#mytable').DataTable({
              "processing": true,
              "serverSide": true,
              "ajax": {
                url: "{{ route('entries.datatable') }}"
              },
              "columns": [
                {
                  "data": "name",
                  "name": "name",
                  "orderable": false,
                },
                {
                  "data": "email",
                  "name": "email",
                  "orderable": false,
                },
                {
                  "data": "color_1",
                  "name": "color_1",
                  "orderable": false,
                },
                {
                  "data": "color_2",
                  "name": "color_2",
                  "orderable": false,
                },
                {
                  "data": "color_3",
                  "name": "color_3",
                  "orderable": false,
                },
                {
                  "data": "country",
                  "name": "country",
                  "orderable": false,
                },
                {
                  "data": "ip",
                  "name": "ip",
                  "orderable": false,
                },
                {
                  "data": "useragent",
                  "name": "useragent",
                  "orderable": false,
                },
                {
                  "data": "created_at",
                  "name": "created_at",
                  "orderable": false,
                },
                {
                  "data": "action",
                  "name": "action",
                  "orderable": false,
                }
              ]
            });
        } );
      

    </script>
@endsection
