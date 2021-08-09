@extends('backend.body')
@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Country Sections</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Countries List</li>
                            </ol>
                        </nav>
                    </div>

                </div>

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                        <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <th width="10%">#</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Status</th>
                                        </tfoot>
                                        <tbody>
                                        @foreach($countries as $key => $country)
                                            <tr>
                                                <td>{{ ($key+1) + ($countries->currentPage() - 1)*$countries->perPage() }}</td>
                                                <td>{{ $country->name }}</td>
                                                <td>{{ $country->code }}</td>
                                                <td><label class="switch">
                                                        <input onchange="update_status(this)" value="{{ $country->id }}"
                                                               type="checkbox" <?php if ($country->status == 1) echo "checked";?> >
                                                        <span class="slider round"></span></label></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $countries->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">

        function update_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('countries.status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function (data) {
                if (data == 1) {
                    showAlert('success', 'Country status updated successfully');
                } else {
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

    </script>
@endpush
