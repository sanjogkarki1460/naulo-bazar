@extends('frontend.body.body')
@section('body')
    @include('frontend.body.home.banner')
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $.post('{{ route('home.section.featured') }}', {_token: '{{ csrf_token() }}'}, function (data) {
                $('#section_featured').html(data);
                slickInit();
            });

            $.post('{{ route('home.section.best_selling') }}', {_token: '{{ csrf_token() }}'}, function (data) {
                $('#section_best_selling').html(data);
                slickInit();
            });

            $.post('{{ route('home.section.home_categories') }}', {_token: '{{ csrf_token() }}'}, function (data) {
                $('#section_home_categories').html(data);
                slickInit();
            });



            $.post('{{ route('home.section.best_sellers') }}', {_token: '{{ csrf_token() }}'}, function (data) {
                $('#section_best_sellers').html(data);
                slickInit();
            });
        });
    </script>
@endpush