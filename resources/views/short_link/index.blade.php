@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center" style="margin-top: 70%; margin-bottom: 70%">

            {{-- <h6 id="showNewLink" class="mt-3 display-1" style="font-size: 1.5em"></h6>
            <button class="btn-clipboard btn btn-outline-dark btn-sm mb-2" data-clipboard-target="#showNewLink" style="display: none">
                copy
            </button> --}}

            <div class="row">
                <div class="col-10">
                    <h6 id="showNewLink" class="mt-3 display-1" style="font-size: 1.5em"></h6>
                </div>
                <div class="col-2">
                    <button class="btn-clipboard btn btn-outline-dark btn-sm" data-clipboard-target="#showNewLink" style="display: none; border: none; margin-top: 13px; background-color: #f8f9fa">
                        <img src="{{asset('img/copy.png')}}" width="20px">
                    </button>
                </div>
            </div>
            <form action="{{ route('generateShortLink') }}" method="post" id="generateShortLinkForm"> @csrf
                <div class="form-group">
                    <input type="text" name="old_link" class="form-control" placeholder="Вставьте ссылку">
                </div>
                <button type="submit" class="btn btn-sm btn-outline-primary" id="generateShortLink">Генерировать ссылку</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#generateShortLink").click(function(e) {
        e.preventDefault();

        var form = $('#generateShortLinkForm').serialize();

        $.ajax({
            url: "{{route('generateShortLink')}}",
            type: "POST",
            data: form,
            success: function(data) {
                $("#showNewLink").html(data);
            },
            error: function() {
                alert('errorroror');
            },

        });

    });
</script>



<script type="text/javascript">
    var clipboard = new ClipboardJS('.btn');

    clipboard.on('success', function(e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);

        e.clearSelection();
    });

    clipboard.on('error', function(e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
    });
</script>

<script type="text/javascript">
    $("#generateShortLink").click(function() {
        $(".btn-clipboard").show();
    })
</script>

@endsection




