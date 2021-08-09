@extends('backend.body')
@section('body')



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Sub Sub-Category Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Categories</li>
                                <li class="breadcrumb-item">Sub Sub-Categories</li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <br>
                <div class="row clearfix">
                    <div class="card">
                        <div class="body container col-md-6">
                            <div class="header">
                                <h3 class="badge badge-primary p-3 font-12">{{__('Sub Sub-Category Information')}}</h3>
                            </div>

                            <form class="form-horizontal"
                                  action="{{ route('subsubcategories.update', $subsubcategory->id) }}"
                                  method="POST" enctype="multipart/form-data">
                                <input name="_method" type="hidden" value="PATCH">
                                @csrf


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Name</span>
                                    </div>
                                    <input type="text" placeholder="{{__('Name')}}" id="name" name="name"
                                           class="form-control"
                                           required value="{{$subsubcategory->name}}">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Category</span>
                                    </div>
                                    <select name="category_id" required class="form-control demo-select2">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" <?php if ($subsubcategory->category_id == $category->id) echo "selected";?> >{{__($category->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Sub-Category</span>
                                    </div>
                                    <select name="sub_category_id" id="sub_category_id"
                                            class="form-control demo-select2"
                                            required>

                                    </select>
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Slug</span>
                                    </div>

                                    <input type="text" placeholder="{{__('Slug')}}" id="slug" name="slug"
                                           value="{{ $subsubcategory->slug }}" class="form-control">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Meta Title</span>
                                    </div>
                                    <input type="text" class="form-control" name="meta_title"
                                           value="{{ $subsubcategory->meta_title }}"
                                           placeholder="{{__('Meta Title')}}">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Description</span>
                                    </div>
                                    <textarea name="meta_description" rows="8"
                                              class="form-control">{{ $subsubcategory->meta_description }}</textarea>
                                </div>

                                <div class="panel-footer text-right">
                                    <button class="btn btn-outline-success"
                                            type="submit">{{__('Save')}}</button>
                                </div>

                            </form>
                            <!--===================================================-->
                            <!--End Horizontal Form-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

    <script type="text/javascript">

        function get_subcategories_by_category() {
            var category_id = $('#category_id').val();
            $.post('{{ route('subcategories.get_subcategories_by_category') }}', {
                _token: '{{ csrf_token() }}',
                category_id: category_id
            }, function (data) {
                $('#sub_category_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#sub_category_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                    $('.demo-select2').select2();
                }
            });
        }

        $('.demo-select2').select2();

        $(document).ready(function () {

            $("#category_id > option").each(function () {
                if (this.value == '{{$subsubcategory->subcategory->category_id}}') {
                    $("#category_id").val(this.value).change();
                }
            });

            get_subcategories_by_category();
        });

        $('#category_id').on('change', function () {
            get_subcategories_by_category();
        });

    </script>
@endpush
