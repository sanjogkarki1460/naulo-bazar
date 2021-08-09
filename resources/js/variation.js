<script>
$.each(JSON.parse(value.title),function(index,value){
if(value != 'Color')
{
$('#attributes_result').append(
'<div class="col-md-3">'+'<div class="input-group mb-3">'+' <div class="input-group-prepend">'
+'<span class="input-group-text"><i class="fa fa-dollar"></i>'+
'&nbsp;'+value+'</span>'+
'</div>'+
'<input type="hidden" class="form-control" name="option_group[variation][variation_name][]" placeholder="'+value+'" value="'+value+'" > '+
'<input type="text" class="form-control" name="option_group[variation][variation_value][]" placeholder="'+value+'" value="" required> '
+'</div>'+
'</div>'
);
if (index === (len - 1))
{
$('#attributes_result').append('<div class="col-md-3">'+'<div class="input-group mb-3">'+' <div class="input-group-prepend">'
+'<span class="input-group-text"><i class="fa fa-dollar"></i>'+
'&nbsp;Price</span>'+
'</div>'+
'<input type="text" class="form-control" name="option_group[variation][variation_price][]" placeholder="price" value="" required> '+'<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix2(this)" style="float: right;z-index: 8;position: relative;"></span>'
+'</div>');
}
}
else
{
$('#attributes_color_result').append(
'<div class="col-md-3">'+'<div class="input-group mb-3">'+' <div class="input-group-prepend">'
+'<span class="input-group-text"><i class="fa fa-dollar"></i>'+
'&nbsp;Color Hex</span>'+
'</div>'+
'<input type="text" class="form-control" name="option_group[colors][color][]" placeholder="" value=""> '+'<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)" style="float: right;z-index: 8;position: relative;"></span> </div>'+
'<div class="col-md-12">'+
'<div class="card">'+
'<div class="card-header">'+
'<i class="fa fa-image"></i> &nbsp; Gallery Images'+
'</div>'+
'<div class="alert alert-info border-info">'+
'<input type="file" class="dropify"'+
'name="option_group[colors][image][]" multiple required>'+
'</div>'+
'</div>'
+
'</div>'
);
}

});

}

</script>
