@extends('admin.master')

@section('css')
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
@stop

@section('js')
    <!-- CK Editor -->
    <script src="bower_components/ckeditor/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
        $(function () {
            CKEDITOR.replace('editor1');
            CKEDITOR.replace('editor2');
            CKEDITOR.replace('editor3');
        })
    </script>
@stop

@section('main')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Cấu hình website
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Editors</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Info</h3>
                            <div class="pull-right box-tools">
                                <button type="button" class="btn btn-info btn-sm" data-widget="collapse"
                                        data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-info btn-sm" data-widget="remove"
                                        data-toggle="tooltip"
                                        title="Remove">
                                    <i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body pad">
                            <form>
                                <textarea id="editor1" name="info" rows="10" cols="80">{!! $info->value !!}</textarea>
                            </form>
                        </div>
                    </div>

                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Điều khoản</h3>
                            <div class="pull-right box-tools">
                                <button type="button" class="btn btn-info btn-sm" data-widget="collapse"
                                        data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-info btn-sm" data-widget="remove"
                                        data-toggle="tooltip"
                                        title="Remove">
                                    <i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body pad">
                            <form>
                                <textarea id="editor2" name="term" rows="10"></textarea>
                            </form>
                        </div>
                    </div>

                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Chính sách</h3>
                            <div class="pull-right box-tools">
                                <button type="button" class="btn btn-info btn-sm" data-widget="collapse"
                                        data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-info btn-sm" data-widget="remove"
                                        data-toggle="tooltip"
                                        title="Remove">
                                    <i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body pad">
                            <form>
                                <textarea id="editor3" name="policy" rows="10"></textarea>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop

<form method="post" enctype="multipart/form-data" action=" {{ asset('admin/config/banner') }} ">
    Banner:
    <input type="file" name="value" value="{{ $banner->value }}" accept="image/*">
    <button>Send</button>
    {{csrf_field()}}
</form>
<br>
@foreach( unserialize($banner->value) as $banner)
    {{$banner}}
    <br>
@endforeach
<form method="post">
    Info:
    <input name="value" value="{{ $info->value }}">
    <button>Send</button>
    {{csrf_field()}}
</form>

<br>

<form method="post">
    Term:
    <input name="value" value="{{ $term->value }}">
    <button>Send</button>
    {{csrf_field()}}
</form>

<br>

<form method="post">
    Policy:
    <input name="value" value="{{ $policy->value }}">
    <button>Send</button>
    {{csrf_field()}}
</form>