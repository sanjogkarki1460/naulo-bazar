<div class="card">
    <div class="text-center">
        <h4 class="badge badge-primary p-3 font-12 ">{{__('Slider Information')}}</h4>
    </div>

    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <br>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                    class="fa fa-text-width"></i> &nbsp;{{__('URL')}}</span>
                </div>
                <input type="text" id="url" name="url" placeholder="http://example.com/" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-3">
                <label class="control-label bold">{{__('Slider Images')}}</label>
                <strong class="text-danger">(850px*315px)</strong>
            </div>
                <div class="col-sm-9">
                    <div id="photos">
                        
                    </div>
                </div>
            </div>
        <div class="panel-footer text-right m-2">
            <button class="btn btn-success" type="submit">{{__('Save')}}</button>
        </div>
    </form>
    <!--===================================================-->
    <!--End Horizontal Form-->

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#photos").spartanMultiImagePicker({
            fieldName:        'photos[]',
            maxCount:         10,
            rowHeight:        '200px',
            groupClassName:   'col-md-4 col-sm-9 col-xs-6',
            maxFileSize:      '',
            dropFileLabel : "Drop Here",
            onExtensionErr : function(index, file){
                console.log(index, file,  'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr : function(index, file){
                console.log(index, file,  'file size too big');
                alert('File size too big');
            }
        });
    });

</script>
