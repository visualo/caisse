@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="container">
                <div class="w-space">
                <form method="POST" action="" id="opeartionCaisse">
                    @csrf              
                    <div class="card card-caisse" style="min-height:100%">
                        <div class="card-header ch-caisse px-0 py-3">{{ __('Entrée de fond de caisse') }}</div>
                        <div class="card-body px-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="typeoperation" class="mb-2">{{ __('Type d\'opération') }}</label>
                                        <select class="form-select" aria-label="Default select example" id="type_opeartion" name="type_opeartion" >
                                            <option></option>
                                            @foreach($typeopeartions as $key => $typeopeartion)
                                            <option value="{{$typeopeartion->id}}">{{$typeopeartion->title}}</option>
                                            @endforeach                
                                        </select>
                                        <input type="hidden" name="caisse" id="caisse" value="1">
                                        <input type="hidden" name="operation" id="operation">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="date" class="mb-2">{{ __('Date') }}</label>
                                        <input type="date" class="form-control" data-date="" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" data-date-format="DD/MM/YYYY" id="date_operation" name="date_operation">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <p class="f-caisse mb-0 mt-4" id="total">0 €</p>
                                    <input type="hidden" name="total_operation" id="total_operation">
                                </div>
                            </div>          
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="note" class="form-label">{{ __('Note') }}</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                </div>
                            </div>          

                        </div>
                    </div>


                    <div class="card card-caisse" style="min-height:100%">
                        <div class="card-header ch-caisse px-0 py-3">{{ __('Billets') }}</div>
                        <div class="card-body px-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="nominal" class="mb-2">{{ __('Nominal') }}</label>
                                        <select class="form-select" aria-label="Default select example" id="nominal_note" name="nominal_note" >
                                            <option></option>
                                            @foreach($numeraries as $key => $numerarie)
                                                @if($numerarie->type=="banknote")
                                                    <option value="{{$numerarie->id}}">{{$numerarie->value}}</option>
                                                @endif
                                            @endforeach                
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="quantitycoin" class="mb-2">{{ __('Quantité') }}</label>
                                        <input type="number" class="form-control" id="quantity_note" name="quantity">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <p class="f-caisse mb-0 mt-4" id="total_note">0 €</p>
                                </div>
                            </div>          
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="hv_note" id="hv_note">
                                    <input type="hidden" name="hc_note" id="hc_note">
                                    <div id="bloc_note" class="mb-3"></div>    
                                </div>
                            </div>          

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" id="add_note" class="btn btn-success mb-3">{{ __('Ajouter') }}</button>
                                </div>
                            </div>          

                        </div>
                    </div>

                    <div class="card card-caisse" style="min-height:100%">
                        <div class="card-header ch-caisse px-0 py-3">{{ __('Pièces') }}</div>
                        <div class="card-body px-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="nominalcoin" class="mb-2">{{ __('Nominal') }}</label>
                                        <select class="form-select" aria-label="Default select example" id="nominal_coin" name="nominal_coin" >
                                            <option></option>
                                            @foreach($numeraries as $key => $numerarie)
                                                @if($numerarie->type=="coin")
                                                    <option value="{{$numerarie->id}}">{{$numerarie->value}}</option>
                                                @endif
                                            @endforeach                
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="quantity" class="mb-2">{{ __('Quantité') }}</label>
                                        <input type="number" class="form-control" id="quantity_coin" name="quantity_coin">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <p class="f-caisse mb-0 mt-4" id="total_coin">0 €</p>
                                </div>
                            </div>          
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="hv_coin" id="hv_coin">
                                    <input type="hidden" name="hc_coin" id="hc_coin">
                                    <div id="bloc_coin" class="mb-3"></div>    
                                </div>
                            </div>          

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" id="add_coin" class="btn btn-success mb-3">{{ __('Ajouter') }}</button>
                                </div>
                            </div>          

                        </div>
                    </div>


                    <div class="card card-caisse" style="min-height:100%">
                        <div class="card-header ch-caisse px-0 py-3">{{ __('Centimes') }}</div>
                        <div class="card-body px-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="nominalcent" class="mb-2">{{ __('Nominal') }}</label>
                                        <select class="form-select" aria-label="Default select example" id="nominal_cent" name="nominal_cent" >
                                            <option></option>
                                            @foreach($numeraries as $key => $numerarie)
                                                @if($numerarie->type=="cent")
                                                    <option value="{{$numerarie->id}}">{{$numerarie->value}}</option>
                                                @endif
                                            @endforeach                
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="quantitycent" class="mb-2">{{ __('Quantité') }}</label>
                                        <input type="number" class="form-control" id="quantity_cent" name="quantity_cent">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <p class="f-caisse mb-0 mt-4" id="total_cent">0 €</p>
                                </div>
                            </div>          
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="hv_cent" id="hv_cent">
                                    <input type="hidden" name="hc_cent" id="hc_cent">
                                    <div id="bloc_cent" class="mb-3"></div>    
                                </div>
                            </div>          

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" id="add_cent" class="btn btn-success mb-3">{{ __('Ajouter') }}</button>
                                </div>
                            </div>          
                        </div>
                    </div>
                <hr>

                <div class="row">
                    <div class="col-md-12 text-center my-2">
                        <button type="submit" id="add_caisse" class="btn btn-default mb-3 s-btn">{{ __('Enregistrer') }}</button>
                    </div>
                </div>          
            </form>
        </div>
        </div>
            
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#date_operation").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change")

    var values_note=[], qte_note=[];
    var i_note=0, total_note=0;

    var values_coin=[], qte_coin=[];
    var i_coin=0, total_coin=0;

    var values_cent=[], qte_cent=[];
    var i_cent=0, total_cent=0;
    var modeOperation='add';
    
    function update_operation(id)
    {   
        modeOperation='edit';
        $('#operation').val(id);

        let url = '{{route("operation.view",["id"=>":id"])}}';
        url = url.replace(':id',id);                    

        $.ajax({
          url: url,
          method:"POST",
          dataType: 'json',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data) 
          {
            if(data.operation.length>0)
            {
                var operation = data.operation[0];

                $('#type_opeartion').val(operation.typeoperation_id);
                $('#date_operation').val(operation.operation_date.substr(0,10));
                $('#comment').val(operation.comment);

                if(operation.numeraries.length>0)
                {
                    for(n=0; n<operation.numeraries.length; n++)
                    {
                        if(operation.numeraries[n].type=='banknote')
                        {
                            total_note= add_money(operation.numeraries[n].value.toString(),operation.numeraries[n].pivot.qte.toString(),values_note,qte_note,'hv_note','hc_note','total_note','total','total_operation','bloc_note',i_note,total_note,'b-cancel')
                            i_note++;
                        }

                        if(operation.numeraries[n].type=='coin')
                        {
                            total_coin= add_money(operation.numeraries[n].value.toString(),operation.numeraries[n].pivot.qte.toString(),values_coin,qte_coin,'hv_coin','hc_coin','total_coin','total','total_operation','bloc_coin',i_coin,total_coin,'c-cancel')
                            i_coin++;
                        }

                        if(operation.numeraries[n].type=='cent')
                        {
                            total_cent= add_money(operation.numeraries[n].value.toString(),operation.numeraries[n].pivot.qte.toString(),values_cent,qte_cent,'hv_cent','hc_cent','total_cent','total','total_operation','bloc_cent',i_cent,total_cent,'m-cancel')
                            i_cent++;
                        }
                    }
                }
            }
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

    let is_ID =document.URL.split("/")[document.URL.split("/").length-2]
    if(!isNaN(is_ID)) update_operation(is_ID)

    function add_money(nominal, qte, v_note,q_note,db_v_note,db_q_note,t_note,total,op_total, bc_note,i_position,amount,e_cancel)
    {
        if(qte==0 || nominal==0 )
        {
            Swal.fire({
              title: "Vous devez d'abord remplir vos champs",
              icon: "warning",
              button: "Ok",
            });
            return false;
        }

        if (v_note.includes(nominal))
        {
            Swal.fire({
                title: 'Error!',
                text: 'Vous avez déjà ajouté ce billet de '+nominal+' € !',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false
        }

        v_note[i_position] = nominal;
        q_note[i_position] = qte;

        t_note=='total_cent'
            ? amount+= parseFloat((nominal/100)*qte)
            : amount+=nominal*qte

        t_note=='total_note'
            ? total_note=amount
            : t_note=='total_coin'
                ? total_coin=amount
                : total_cent=amount

        t_note=='total_cent'
            ? $('#'+t_note).text(amount.toFixed(2)+' €')
            : $('#'+t_note).text(amount+' €')

        $('#'+db_v_note).val(JSON.stringify(v_note));
        $('#'+db_q_note).val(JSON.stringify(q_note));


        $('#'+total).text(parseInt(total_note)+parseInt(total_coin)+parseFloat(total_cent.toFixed(2))+' €');
        $('#'+op_total).val(parseInt(total_note)+parseInt(total_coin)+parseFloat(total_cent.toFixed(2)));
        $('#'+bc_note).append('<span id="add'+db_v_note.substr(-4)+i_position+'" class="tag-money">'+qte+' de Billet de : '+nominal+' €<span id="br'+i_position+'" style="cursor:pointer" class="'+e_cancel+'">x</span></span>');        

        document.getElementById('quantity_'+bc_note.substr(-4)).value = ''
        document.getElementById('nominal_'+bc_note.substr(-4)).value = ''

        return amount; 
    }

    function delete_money(id,onlyvalue,values_amount,qte_amount,hv_note,hc_note,addnote,tcm_note,total,total_operation)
    {
        Swal.fire({
            title: 'Etes vous sure de vouloir supprimer cette somme de '+values_amount[onlyvalue] + '€ ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui!'
        }).then((result) => {
        if (result.isConfirmed) {

            values_amount.splice(onlyvalue,1);
            qte_amount.splice(onlyvalue,1);

            $('#'+hv_note).val(JSON.stringify(values_amount));
            $('#'+hc_note).val(JSON.stringify(qte_amount));
            $('#'+addnote+''+onlyvalue).remove();
            
            var newtotal=0;
            for(j=0; j<values_amount.length;j++)
            {
                if(values_amount[j]!=null)
                {
                    newtotal += values_amount[j]*qte_amount[j]
                }
            }

            let amount=0;
            tcm_note=='total_cent'
                ? amount=newtotal/100
                : amount=newtotal

            tcm_note=='total_note'
            ? total_note=amount
            : tcm_note=='total_coin'
                ? total_coin=amount
                : total_cent=amount

            tcm_note=='total_cent'
                ? $('#'+tcm_note).text(amount.toFixed(2)+' €')
                : $('#'+tcm_note).text(amount+' €')
                
            $('#'+total).text(parseInt(total_note)+parseInt(total_coin)+parseFloat(total_cent.toFixed(2))+' €');
            $('#'+total_operation).val(parseInt(total_note)+parseInt(total_coin)+parseFloat(total_cent.toFixed(2)));

            Swal.fire(
            'Supprimé!',
            'Le billet a été supprmé avec succes.',
            'success'
            )

            return newtotal
        }
        })        
    }

    $(document).on("click","#add_note",function()
    {
        total_note= add_money($('#nominal_note :selected').text(),$('#quantity_note').val(),values_note,qte_note,'hv_note','hc_note','total_note','total','total_operation','bloc_note',i_note,total_note,'b-cancel')
        i_note++;
    });

    $(document).on('click', '.b-cancel', function()
    {
        let id =$(this).attr('id');
        let onlyvalue = id.substr(2);
        total_note = delete_money(id,onlyvalue,values_note,qte_note,'hv_note','hc_note','addnote','total_note','total','total_operation')
    });

    $(document).on("click","#add_coin",function()
    {
        total_coin= add_money($('#nominal_coin :selected').text(),$('#quantity_coin').val(),values_coin,qte_coin,'hv_coin','hc_coin','total_coin','total','total_operation','bloc_coin',i_coin,total_coin,'c-cancel')
        i_coin++;
    });

    $(document).on('click', '.c-cancel', function()
    {
        let id = $(this).attr('id');
        let onlyvalue = id.substr(2);
        total_coin = delete_money(id,onlyvalue,values_coin,qte_coin,'hv_coin','hc_coin','addcoin','total_coin','total','total_operation')
    });

    $(document).on("click","#add_cent",function()
    {
        total_cent= add_money($('#nominal_cent :selected').text(),$('#quantity_cent').val(),values_cent,qte_cent,'hv_cent','hc_cent','total_cent','total','total_operation','bloc_cent',i_cent,total_cent,'m-cancel')
        i_cent++;
    });

    $(document).on('click', '.m-cancel', function()
    {
        let id =$(this).attr('id');
        let onlyvalue = id.substr(2);

        total_cent = delete_money(id,onlyvalue,values_cent,qte_cent,'hv_cent','hc_cent','addcent','total_cent','total','total_operation')
        console.log(total_cent)
    });

    $('#opeartionCaisse').submit(function(e) 
    {
        let total = $("#total_operation").val();
        if(total==0)
        {
            Swal.fire({
              title: "Vous devez ajouter au moins un montant à cette opération",
              icon: "warning",
              button: "Ok",
            });
            return false;
        }
        var urlCaisse =null;
        modeOperation=='add'
            ? urlCaisse= "{{ route('operation.add') }}"
            : urlCaisse= "{{ route('operation.update') }}"

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: urlCaisse,
            data: formData,
            type: 'post',
            async: false,
            processData: false,
            contentType: false,
            success:function(data)
            {
                let caisse= data.caisse

                values_note=[];
                qte_note=[];
                values_coin=[];
                qte_coin=[];
                values_cent=[];
                qte_cent=[];
                i_note=0;
                i_coin=0;
                i_cent=0;

                $("#opeartionCaisse")[0].reset();
                $("#total").text("0 €");
                $("#total_note").text("0 €");
                $("#total_coin").text("0 €");
                $("#total_cent").text("0 €");
                $("#bloc_note").empty();
                $("#bloc_coin").empty();
                $("#bloc_cent").empty();
                $('#hv_note').val('');
                $('#hc_note').val('');
                $('#hv_coin').val('');
                $('#hc_coin').val('');
                $('#hv_cent').val('');
                $('#hc_cent').val('');

                $("#caisse").val(caisse);

                Swal.fire({
                    title: data.message,
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {

                    if (result.value) {
                        window.location.href ="{{ route('dashboard') }}"
                    }
                })                

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

</script>

@endsection
