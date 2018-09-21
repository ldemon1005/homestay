@extends('admin.master')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@stop

@section('js')
    <!-- DataTables -->
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- page script -->
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>
@stop

@section('main')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý tài khoản admin
                {{--<small>advanced tables</small>--}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Quản lý tài khoản admin</li>
                <li class="active">Danh sách admin</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách admin</h3>
                        </div>
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Email</th>
                                    <th>Mật khẩu</th>
                                    <th>Trạng thái</th>
                                    <th>Sửa / Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>abcdef@gmail.com</td>
                                    <td>123456</td>
                                    <td>Hoạt động</td>
                                    <td><a href="">Bút</a> <a href="">Thùng rác</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>abcdef@gmail.com</td>
                                    <td>123456</td>
                                    <td>Hoạt động</td>
                                    <td><a href="">Bút</a> <a href="">Thùng rác</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>abcdef@gmail.com</td>
                                    <td>123456</td>
                                    <td>Hoạt động</td>
                                    <td><a href="">Bút</a> <a href="">Thùng rác</a></td>
                                </tr>
                                </tbody>
                                {{--<tfoot>--}}
                                {{--<tr>--}}
                                    {{--<th>Rendering engine</th>--}}
                                    {{--<th>Browser</th>--}}
                                    {{--<th>Platform(s)</th>--}}
                                    {{--<th>Engine version</th>--}}
                                    {{--<th>CSS grade</th>--}}
                                {{--</tr>--}}
                                {{--</tfoot>--}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop