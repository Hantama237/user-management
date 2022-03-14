@extends('master')
@section("head")
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        th input{
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <main class="px-3 mb-3">
        <h1 class="mb-3">UsMan</h1>
        <button data-bs-toggle="modal" data-bs-target="#addModal" class="w-100 mb-3 btn btn-lg btn-secondary fw-bold border-white bg-white">Add User</button>
        <div class="bg-white p-2 rounded" >
            <table id="user-table">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Nationality</th>
                        <th>Date of Birth</th>
                        <th style="width: 10em;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($users as $i) --}}
                    <tr>
                        <td>
                            <div class="rounded-circle bg-dark" height="50px" width="50px"></div>
                            {{-- <img class="rounded-circle" height="50px" width="50px" src="" alt=""> --}}
                        </td>
                        <td>Handryan Pratama</td>
                        <td>male</td>
                        <td>Indonesia</td>
                        <td>1999-09-15</td>
                        <td>
                            <button class="btn btn-primary">Detail</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    {{-- @endforeach --}}
                    
                </tbody>
            </table>
        </div>
    </main>
  
    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="bg-dark modal-content text-left text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="detail-modal-body" class="modal-body">
                <h5>Account Details</h5>
                <span  id="acc-email"></span><br>
                <h5 class="mt-3">Profile Details</h5>
                <span  id="p-picture">
                    <img class="rounded-circle" height="50" width="50" src="" alt=""><br>
                    <span id="p-name"></span><br>
                    <span id="p-gender"></span><br>
                    <span id="p-nationality"></span><br>
                    <span id="p-dateofbirth"></span><br>
                </span>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#updateModal" type="button" class="btn btn-primary">Update</button>
               
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="bg-dark modal-content text-left text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="update-modal-body" class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="add-form">
                    <h5>Account</h5>
                    <div class="form-group">
                        <div class="input-group mb-1">
                            <input id="add-a-email" name="email" type="text" class="form-control" placeholder="email">
                        </div>
                        <div class="input-group mb-1">
                            <input id="add-a-password" name="password" type="password" class="form-control" placeholder="password">
                        </div>
                        <div class="input-group mb-1">
                            <input id="add-a-email" name="password_confirmation" type="password" class="form-control" placeholder="password confirmation">
                        </div>
                    </div>
                    <h5 class="mt-3">Profile Data</h5>
                    <div class="form-group mb-2">
                        <div class="input-group mb-1">
                            <input id="add-p-picture" accept="image/*" name="picture" type="file" class="form-control" placeholder="picture">
                        </div>
                        <div class="input-group mb-1">
                            <input id="add-p-name" name="name" type="text" class="form-control" placeholder="name">
                        </div>
                        <div class="input-group mb-1">
                            <select id="add-p-gender" class="form-control" name="gender" id="">
                                <option value="male">male</option>
                                <option value="female">female</option>
                            </select>
                        </div>
                        <div class="input-group mb-1">
                            <select id="add-p-nationality" class="form-control" name="nationality" id="">
                                <option value="Russia">Russia</option>
                                <option value="America">America</option>
                                <option value="China">China</option>
                                <option value="Ukraine">Ukraine</option>
                            </select>
                        </div>
                        <div class="input-group mb-1">
                            <input id="add-p-dateofbirth" name="date_of_birth" type="date" class="form-control" placeholder="date of birth">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="add-submit" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="bg-dark modal-content text-left text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="update-modal-body" class="modal-body">
                <h5>Account</h5>
                <div class="form-group">
                    <div class="input-group">
                        <input readonly id="edit-a-email" name="email" type="text" class="form-control" placeholder="email">
                    </div>
                </div>
                <h5 class="mt-3">Profile Edit</h5>
                <form method="POST" enctype="multipart/form-data" id="update-form">
                    <div class="form-group mb-2">
                        <div class="input-group mb-1">
                            <input id="edit-p-picture" accept="image/*" name="picture" type="file" class="form-control" placeholder="picture">
                        </div>
                        <div class="input-group mb-1">
                            <input id="edit-p-name" name="name" type="text" class="form-control" placeholder="name">
                        </div>
                        <div class="input-group mb-1">
                            <select id="edit-p-gender" class="form-control" name="gender" id="">
                                <option value="male">male</option>
                                <option value="female">female</option>
                            </select>
                        </div>
                        <div class="input-group mb-1">
                            <select id="edit-p-nationality" class="form-control" name="nationality" id="">
                                <option value="Russia">Russia</option>
                                <option value="America">America</option>
                                <option value="China">China</option>
                                <option value="Ukraine">Ukraine</option>
                            </select>
                        </div>
                        <div class="input-group mb-1">
                            <input id="edit-p-dateofbirth" name="date_of_birth" type="date" class="form-control" placeholder="date of birth">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="update-submit" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
        </div>
    </div>
@endsection
@section("script")
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    var table = null;
    let ready = false;
    let userId = null;
    let profileId = null;
    function showDetailModal(id){
            userId = id;
            $("#detail-modal-body").LoadingOverlay("show");
            $.ajax({
                type:'GET',
                url:"/admin/get/user/"+id,
                success:function(data){
                    
                    if(ready){
                        profileId = data.data.profile.id
                        $("#acc-email").text(data.data.email)
                        $("#p-picture img").attr('src','{!!asset("/assets/images/profile/")!!}/'+data.data.profile.picture)
                        $("#p-name").text(data.data.profile.name)
                        $("#p-gender").text(data.data.profile.gender)
                        $("#p-nationality").text(data.data.profile.nationality)
                        let date = new Date(Date.parse(data.data.profile.date_of_birth))
                       $("#p-dateofbirth").text(date.toDateString())

                       $("#edit-a-email").val(data.data.email)

                       $("#edit-p-name").val(data.data.profile.name)
                       $("#edit-p-gender").val(data.data.profile.gender).change();
                       $("#edit-p-nationality").val(data.data.profile.nationality).change();
                       let day = ("0" + date.getDate()).slice(-2);
                       let month = ("0" + (date.getMonth() + 1)).slice(-2);
                       let inputDate = date.getFullYear()+"-"+(month)+"-"+(day) ;
                       $("#edit-p-dateofbirth").val(inputDate);
                    }
                }
                
            }).done(()=>{
                $("#detail-modal-body").LoadingOverlay("hide");
            });
            $("#detailModal").modal("show")
    }
    function deleteUser(id){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((confirmed) => {
            if (confirmed) {
                $.LoadingOverlay("show");
                $.ajax({
                    type:'GET',
                    url:"/admin/delete/user/"+id,
                    success:function(data){
                        table.ajax.reload();
                        swal("Delete user success!", {
                            icon: "success",
                        });
                    }
                }).done(()=>{
                    $.LoadingOverlay("hide");
                });
                
                
            }
        });
    }
    $(document).ready( function () {
        ready = true;
        // add filter
        $('#user-table thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#user-table thead');
        table = $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin/",
            columns: [
                {data: 'Picture', name: 'Picture', orderable: false, searchable: false},
                {data: 'Name', name: 'Name'},
                {data: 'Gender', name: 'Gender'},
                {data: 'Nationality', name: 'Nationality'},
                {data: 'Date of Birth', name: 'Date of Birth'},
                {data: 'Action', name: 'Action', orderable: false, searchable: false},
            ],
            orderCellsTop: true,
            fixedHeader: true,
            //add filter function 
            initComplete: function () {
            var api = this.api();
                api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    if(title != "Picture" && title != "Action")
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
                    else
                    $(cell).html('');
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})';
                            var cursorPosition = this.selectionStart;
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
            },
        });
        $.fn.dataTable.ext.errMode = () => swal('Oops','Error while loading the table data. Please refresh','error');

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{!!csrf_token()!!}'
            }
        });

        $("#update-submit").click(()=>{$("#update-form").submit()})
        $("#update-form").submit((e)=>{
            $.LoadingOverlay("show");
            e.preventDefault();
            let formData = new FormData(document.getElementById("update-form"));
            $.ajax({
                type:'POST',
                url:"/admin/profile/update/"+profileId,
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    table.ajax.reload();
                },
                error: function(xhr, status, error){
                    $.LoadingOverlay("hide");
                    if(xhr.status == 400){
                        let messages = "";
                        for (const [key, value] of Object.entries(xhr.responseJSON)) {
                            value.forEach(element => {
                                messages += element+"\n";
                            });
                        }
                        swal('Oops',messages,'error')
                    }else{
                        swal('Oops','Update user profile failed','error')
                    }
                }
            }).done(()=>{
                $.LoadingOverlay("hide");
                $("#updateModal").modal("hide")
            });
            
        })
        $("#add-submit").click(()=>{$("#add-form").submit()})
        $("#add-form").submit((e)=>{
            $.LoadingOverlay("show");
            e.preventDefault();
            let formData = new FormData(document.getElementById("add-form"));
            $.ajax({
                type:'POST',
                url:"/admin/user/create",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    table.ajax.reload();
                },
                error: function(xhr, status, error){
                    $.LoadingOverlay("hide");
                    if(xhr.status == 400){
                        let messages = "";
                        for (const [key, value] of Object.entries(xhr.responseJSON)) {
                            value.forEach(element => {
                                messages += element+"\n";
                            });
                        }
                        swal('Oops',messages,'error')
                    }else{
                        swal('Oops','Add user failed','error')
                    }
                }
            }).done(()=>{
                $.LoadingOverlay("hide");
                $("#addModal").modal("hide")
            });
        })

    } );
</script>
@endsection