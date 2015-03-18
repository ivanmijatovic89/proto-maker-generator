@extends('protomaker::master')

@section('content')
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            0%
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12 well" style="display:none">

        </div>

        <div class="col-lg-6">
            <div class="input-group">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Name of Modul</button>
                  </span>
                <input type="text" class="form-control" placeholder="How do you wanna call your Modul" id="modul_name">
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6" style="text-align:center">
            <button onclick="makeJson()" class="btn btn-info">Make Json</button>
        </div>

    </div><!-- /.row -->

    <div style="display:none">
        <div class="row clone" style="padding:15px;border-top: 2px dashed #ccc;margin-top:15px;">
            <div class="row">
            <button class="btn btn-danger" style=" position: absolute;right: 0;margin-top:-17px" onclick="$(this).parent().parent().remove();">X</button>
            <br>
            <div class="col-lg-3">
                <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Field</button>
                      </span>
                    <input type="text" class="form-control field_name" placeholder="Field name" name="name" >
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->

            <div class="col-lg-3">
                <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Type</button>
                      </span>
                    <select class="form-control field_type" name="type" onchange="makeRelation($(this))">
                        <option value="text">Text</option>
                        <option value="relation">Relation</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Validation</button>
                      </span>
                    <select class="form-control field_validation" name="validation" onchange="validation($(this)) ">
                        <option value="yes">Yes</option>
                        <option value="no"> No</option>
                    </select>
                </div>



            </div>

            <div class="col-lg-3 validation_rules">
                <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Rules</button>
                      </span>
                    <input type="text" class="form-control field_validation_rules" placeholder="" value="required" name="validation_rules">
                </div><!-- /input-group -->
            </div>
        </div><!-- /.row -->

            <div class="row row_relation" style="display:none">
                <br>
                <div class="col-lg-3">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Relation:</button>
                      </span>
                        <select class="form-control relation_type" name="relation_type" >
                            <option value="hasOne">hasOne (from other table)</option>
                            <option value="belongsToMany">belongsToMany (pivot)</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Model Namespace</button>
                      </span>
                        <input type="text" class="form-control relation_model_namespace" placeholder="\App\User" name="relation_class">
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->

                <div class="col-lg-3">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Relation Field </button>
                      </span>
                        <input type="text" class="form-control relation_field" placeholder="email" name="relation_field">
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->

                <div class="col-lg-3">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Relation Name</button>
                      </span>
                        <input type="text" class="form-control relation_name" placeholder="user" name="relation_name">
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->

            </div>



        </div>

    </div>

    <div class="master"> </div>


    <div class="row" style="text-align: center">
        <br>
        <button class="btn btn-success btn-lg" onclick="addNewField()">Add new Field</button>
    </div>
@stop

@section('footer')
<script>
    $.br=1;
function addNewField()
{
    $( ".clone" ).clone().appendTo( ".master" );
    $('.master div.clone').addClass('fieldset field_'+ $.br);
    $('.master div.clone').attr('id', $.br);
    $('.master div.clone').removeClass('clone');
    $.br++;
}
function makeRelation(ovo)
{
    console.log( ovo.val() )
    var val = ovo.val();
    var current_div = ovo.parent().parent().parent().parent();
    if(val =='relation'){
        current_div.children('div.row_relation').show();;
    }else{
        current_div.children('div.row_relation').hide();;
    }

}

    function validation(ovo)
    {
        var current_div_id = ovo.parent().parent().parent().parent().attr('id');
        var validation_div = $('div#'+current_div_id +' div.validation_rules');
        if(ovo.val() == 'yes'){
            validation_div.show();
        }else if(ovo.val() == 'no'){
            validation_div.hide();
        }

    }

    function makeJson()
    {
        //   '{"name":{"type":"text"},"description":{"type":"text"}}'
        $.obj = {};
//        $.obj.name = $('#modul_name').val();

        $( "div.fieldset" ).each(function( i,div ) {

            var name             = $(div).find('.field_name').val();
            var type             = $(div).find('.field_type').val();
            var validation       = $(div).find('.field_validation').val();

            if(validation=='yes')
            {
                validation = $(div).find('.field_validation_rules').val();
            }

            if(type=='relation')
            {
                var relation_type            =  $(div).find('.relation_type').val();
                var relation_model_namespace =  $(div).find('.relation_model_namespace').val();
                var relation_field           =  $(div).find('.relation_field').val();
                var relation_name            =  $(div).find('.relation_name').val();

                // ovo je zato sto u skripti stoji tako za sada !
                var type = 'integer';
                var relation = {}
                relation.class = relation_model_namespace;
                relation.field = relation_field;
                relation.name  = relation_name;
                relation.type  = relation_type;
            }

            var array = {};
            array.type       = type;
            array.validation = validation;
            array.relation   = relation;

            var obj={};
            $.obj[name] = array;

//            $.obj.push(obj) ;

            delete(relation)



        });
        $.obj_string = JSON.stringify($.obj).replace("[", "'").replace("]", "'");
        $.module_name = $('#modul_name').val();

        $.final = 'php artisan proto '+ $.module_name +" --fields=" + $.obj_string;

        console.log($.final);
        $('.progress-bar').text('100%');
        $('.progress-bar').css('width','100%')

        $('.well').show();
        $('.well').html($.final);


    }


</script>

@stop