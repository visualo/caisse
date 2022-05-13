@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">        
        <div class="w-space">
            <div class="row">                
            <div class="col-md-12 p-4">
                <div class="card card-caisse" style="min-height:100%">
                    <div class="row">                
                        <div class="col-md-9">
                            <h2>{{ __('Type d\'opération') }}
                            </h2>        
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="add_type_operation" data-target="#modaltypeopeartion" class="btn btn-primary float-end">{{ __('Ajouter type d\'opération') }}</button>
                        </div>
                    </div>
                    <div class="card-header ch-caisse px-0 py-3"></div>        
                    <div class="card-body px-3">
                        <div class="row">
                            <table class="table" id="type_operation">
                                <thead>
                                <tr>
                                    <th scope="col" style="color:#000">#</th>
                                    <th scope="col" style="color:#000;width:40%">Titre d'opération</th>
                                    <th scope="col" style="color:#000;width:20%">Action</th>
                                    <th scope="col" style="color:#000;width:20%">Etat</th>
                                    <th scope="col" style="color:#000;width:20%">Opérations</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>    
                </div>
            </div>
            </div>
        </div>    
    </div>
</div>

<div class="modal fade" id="modaltypeopeartion" role="dialog" class="modal" data-backdrop="static">
    <div class="modal-dialog modal-sm">    
      <div class="modal-content">
        <div class="modal-header" id="firstHeader">
            <span class="modal-title" style="font-size:17px">
                <span id="namepatient">{{__('Type d\'opération')}}</span>
            </span>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body" style="padding:1.595rem">
          <form method="POST" action="" id="save_type_opeartion" data-action="add">
          @csrf
                <div class="row">
                    <div class="form-group col-md-12 mb-3">
                        <label for="title control-label">{{__('Titre')}}</label>
                        <small class="smallPlus">{{__('Type d\'opération')}}</small>
                        <input type="text" id="title" name="title" class="form-control" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12 mb-3">
                      <label for="action">{{__('Action')}}</label>
                      <small class="smallPlus">{{__('Type de mouvement')}}</small>
                          <select class="form-select" aria-label="Default select example" id="action" name="action">
                              <option value=""></option>
                              <option value="in">{{__('Entrée')}}</option>
                              <option value="out">{{__('Sortie')}}</option>
                          </select>
                          <input type="hidden" name="type_id" id="type_id">
                    </div>
                </div>
                <div class="form-row mt-4">
                <div class="col-md-12">
                    <div class="form-group rtlCss  float-right bom-btn-mdl">
                      <button type="submit" class="btn btn-primary float-end">{{__('Enregistrer')}}</button>
                    </div>
                </div>
            </div>                
          </form>
        </div>
      </div>
      
    </div>
  </div>

<script type="text/javascript">
    var listOperation = null; 
    $(document).ready(function()
    {
        listOperation =  $('#type_operation').DataTable({            
        processing: true,
        bProcessing:false,
        bSort:true,             
        ajax: "{{route('typeoperation.list')}}",
        columns: [
                { data: 'id' },
                { data: 'title'},
                { data: 'action',"render": function (data, type, row) { 
                    if(row.action=='in')
                    {
                        return '<img src="{{url('images/in.jpg')}}" width="16" height="16"/>'                       
                    }else{
                        return '<img src="{{url('images/out.jpg')}}" width="16" height="16"/>'                       
                    }                      
                }
                },
                { data: 'status'},
                { data: 'action',"render": function (data, type, row) {
                    return '<a class="theEdition" style="margin-right:20px" href="#modaltypeopeartion" data-title="'+row.title+'" data-type="'+row.action+'" id="'+row.id+'">'
                        +'<img src="{{url('images/edit.png')}}" width="28" height="28"/></a><a id="'+row.id+'" class="delOperation" style="cursor:pointer"><img src="{{url('images/delete.png')}}" width="28" height="28"/></a>' 
                 }
                },
            ],
            order: [[0, 'desc']],
          });
        });

        $(document).on('click','.theEdition',function() 
        {
            let title =$(this).attr('data-title');
            let action =$(this).attr('data-type');
            let id =$(this).attr('id');

            $('#type_id').val(id);
            $('#title').val(title);
            $('#action').val(action);
            $('#save_type_opeartion').attr('data-action', "edit");
            
            $('#modaltypeopeartion').modal('toggle');
        });

        $(document).on('click','#add_type_operation',function() 
        {
            $('#save_type_opeartion')[0].reset();
            $('#modaltypeopeartion').modal('toggle');
        });

        $(document).on('submit','#save_type_opeartion',function(e) 
        {
            e.preventDefault();
            let id =$(this).attr('data-action');
            var url = "{{route('typeoperation.add')}}"

            id=="add"
               ? url = "{{route('typeoperation.add')}}"
               : url = "{{route('typeoperation.edit')}}"

            var formData = new FormData(this);

            $.ajax({
                url: url,
                data: formData,
                type: 'post',
                async: false,
                processData: false,
                contentType: false,
                success:function(data)
                {
                    Swal.fire({
                        title: data.message,
                        icon: "info",
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {

                        if (result.value) {
                            listOperation.ajax.reload();
                        }
                    })                

                    $('#modaltypeopeartion').modal('toggle');

                },
                error: function (data) {
                var obj = data.responseJSON.errors;
                obj[Object.keys(obj)[0]];

                Swal.fire({
                    title: obj[Object.keys(obj)[0]],
                    text: obj[Object.keys(obj)[0]],
                    icon: "warning",
                    button: "OK",
                });
                }
            });
        });

        $(document).on('click','.delOperation',function(e)
        {
            Swal.fire({
            title: "Etes vous sure de vouloir supprimer ce type d'opération",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler'
            })
            .then((result) => {
            if (result.isConfirmed) {

                var id = $(this).attr('id');
                var url = '{{route("typeoperation.delete",["id"=>":id"])}}';
                    url = url.replace(':id',id);

                $.ajax({
                    url: url,
                    type: "DELETE",
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {

                        listOperation.ajax.reload();

                        Swal.fire({
                        title: data.message,
                        icon: "success",
                        button: "OK",
                        });

                    },
                    error: function (data) {
                        var obj = data.responseJSON.errors;
                        obj[Object.keys(obj)[0]];

                        Swal.fire({
                        title: obj[Object.keys(obj)[0]],
                        text: obj[Object.keys(obj)[0]],
                        icon: "warning",
                        button: "OK",
                    });
                    }
                });
                }
            });
        });

</script>

@endsection
