<div class="product-sort d-flex align-items-center py-1">
    <h4 style="white-space: nowrap">
        SORT BY :
    </h4>
    <label>
        <select name="sort" class="sort ml-1">
        <option value="1" id="high">high to low </option>
        <option value="1">low to high </option>
        </select>
    </label>
</div>
@push('scripts')
   <script>
      $(document).ready(function(){
        $('#high').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                method: 'get',
                url : '{{url("sorting/high")}}',
                success:function(data){
                    console.log(data.html);
                    $('#product-data').hide();
                    $('#result-data').html(data.html);
                }
            })
        })
      });
   </script>
@endpush