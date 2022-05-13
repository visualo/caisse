@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">        
        <div class="w-space p-3">
            <div class="row">
            <div class="col-md-3">
                <div class="card card-caisse" style="min-height:100%">
                    <div class="card-header ch-caisse px-0 py-3 text-center">{{ __('Total caisse') }}</div>
                    <div class="card-body px-3">
                        <h1 class="card-title text-center" id="total_caisse">
                            <div class="loader text-center"></div>
                        </h1>
                    </div>
                </div>
            </div>                
            <div class="col-md-9">
                    <div class="card card-caisse px-0" style="padding-top:13px;min-height:100%">
                        <div class="row">
                            <div class="col-md-9">
                                <h2>{{ __('Opérations du jour') }}</h2>        
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" data-date="" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" data-date-format="DD/MM/YYYY" id="search_date" name="search_date">
                            </div>
                        </div>
                    <div class="card-header ch-caisse"></div>        
                    <div class="card-body px-3">
                        <table class="table" id="list_operation">
                            <thead>
                            <tr>
                                <th scope="col" style="color:#000">#</th>
                                <th scope="col" style="color:#000;width:10%">Date</th>
                                <th scope="col" style="color:#000;width:30%">Type</th>
                                <th scope="col" style="color:#000;width:10%">Montant</th>
                                <th scope="col" style="color:#000;width:10%">Retraits</th>
                                <th scope="col" style="color:#000;width:10%">Ajouts</th>
                                <th scope="col" style="color:#000;width:10%">Total</th>
                                <th scope="col" style="color:#000;width:20%">Action</th>
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

<div class="modal fade" id="modalnumeraries" role="dialog" class="modal" data-backdrop="static">
    <div class="modal-dialog modal-md">    
      <div class="modal-content">
        <div class="modal-header" id="firstHeader">
            <span class="modal-title" style="font-size:17px">
                <span id="namepatient">{{__('Liste numéraire')}}</span>
            </span>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body" style="padding:1.595rem">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        {{__('Billets')}}
                    </button>
                  </h2>
                  <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body" id="billet_body">
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        {{__('Pièces')}}
                    </button>
                  </h2>
                  <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body" id="coin_body">
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        {{__('Centimes')}}
                    </button>
                  </h2>
                  <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body" id="cent_body">
                    </div>
                  </div>
                </div>
              </div>
            </div>
       </div>      
    </div>
</div>

<script type="text/javascript">
    $("#search_date").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change")

    var total_day=0;
    var listDay = null; 
    var numeraries=[];
    var j=0;

    $(document).ready(function()
    {
        let url ="{{route('dashboard.list')}}"
        loadDatatable(url)
        myDay();        
        listDay.destroy();
    });

    $(document).on("change","#search_date",function()
    {
        $("#total_caisse").empty();
        $("#total_caisse").append('<div class="loader text-center"></div>');

        let periode = $(this).val();
        let url = '{{route("dashboard.view",["periode"=>":periode"])}}';
        url = url.replace(':periode',periode);                    

        loadDatatable(url)
        myDay();        
        listDay.destroy();
    });

    function myDay() {
        setTimeout(function(){ 
        $('#total_caisse').text(total_day.toFixed(2)+' €')
        }, 1500);
    }

    function loadDatatable(url)
    {
        //        $.noConflict();
        numeraries=[];
        var total_retrait=0;
        var total_ajout=0;
        var k=0;
        total_day=0;
        total_day=0;

        listDay =  $('#list_operation').DataTable({            
        processing: true,
        bProcessing:false,
        bSort:true,             
        ajax: url,
        columns: [
            { data: 'id' },
            { data: 'operation_date',"render": function (data, type, row) { 
                return data.substr(-8);                       
                }
            },
            { data: 'type.title',"render": function (data, type, row) { 
                if(row.type.action=='in')
                {
                    return data.substr(0,30)+'&nbsp;&nbsp;<img src="{{url('images/in.jpg')}}" width="16" height="16"/>'                       
                }else{
                    return data.substr(0,30)+'&nbsp;&nbsp;<img src="{{url('images/out.jpg')}}" width="16" height="16"/>'                       
                }                      
                }
            },
            { data: 'amount',render: $.fn.dataTable.render.number( ',', '.', 2 ) },
            { data: 'amount',"render": function (data, type, row) { 
                if(row.type.action=='out')
                {
                    total_retrait+=data 
                    return total_retrait.toFixed(2)
                }else{
                    return 0 
                }
            }
            },
            { data: 'amount',"render": function (data, type, row) { 
                if(row.type.action=='in')
                {
                    total_ajout+=data 
                    return total_ajout.toFixed(2) 
                }else{
                    return 0 
                }                
            }
            },
            { data: 'amount',"render": function (data, type, row) { 
                if(k<listDay.rows().count())
                {
                    total_day=total_ajout+total_retrait
                }
                k++
                return total_day.toFixed(2)
            }
            },
            { data: 'id',"render": function (data, type, row) {
                let id = row.id;
                let url = '{{route("operation.edit",["id"=>":id"])}}';
                    url = url.replace(':id',id);
                    
                    let obj_numeraries = row.numeraries.map(numerary => {
                        return {
                            value: numerary.value,
                            type: numerary.type,
                            qte: numerary.pivot.qte
                        }
                    })
                    numeraries[j] =obj_numeraries;     
                    j++;               
                    return '<a class="theDetail" style="margin-right:20px" href="#modalnumeraries" data-numerary="'+j+'" id="detail-'+row.id+'"><img src="{{url('images/euro.png')}}" width="28" height="28"/></a>'
                        +'<a class="theEdition" style="margin-right:20px" href="'+url+'" id="edit-'+row.id+'"><img src="{{url('images/edit.png')}}" width="28" height="28"/></a>'
                        +'<a id="'+row.id+'" class="delOperation" style="cursor:pointer"><img src="{{url('images/delete.png')}}" width="28" height="28"/></a>' 
                }
        },
        ],
            order: [[0, 'desc']],
        });
    }

    $(document).on('click','.theDetail',function() 
    {
        let numerary_position = $(this).attr('data-numerary');
        var line_numerary=numeraries[numerary_position];
        $('#billet_body').empty();
        $('#coin_body').empty();
        $('#cent_body').empty();

        line_numerary.forEach(function (numerary) 
        {
            if(numerary.type=='banknote')
            {
                $('#billet_body').append('<span class="tag-money">'+numerary.qte+' de Billet de : '+numerary.value+' €</span>');        
            }
            
            if(numerary.type=='coin')
            {
                $('#coin_body').append('<span class="tag-money">'+numerary.qte+' de Billet de : '+numerary.value+' €</span>');        
            }

            if(numerary.type=='cent')
            {
                $('#cent_body').append('<span class="tag-money">'+numerary.qte+' de Billet de : '+numerary.value+' €</span>');        
            }
        });

        $('#modalnumeraries').modal('toggle');
    });

    $(document).on('click','.delOperation',function(e)
    {
            Swal.fire({
            title: "Etes vous sure de vouloir supprimer cet opération",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler'
            })
            .then((result) => {
            if (result.isConfirmed) {

                total_retrait=0;
                total_ajout=0;
                total_day=0;
                k=0;

                var id = $(this).attr('id');
                var url = '{{route("operation.delete",["id"=>":id"])}}';
                    url = url.replace(':id',id);

                $.ajax({
                    url: url,
                    type: "DELETE",
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {

                        listDay.ajax.reload();
                        myDay();        

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
