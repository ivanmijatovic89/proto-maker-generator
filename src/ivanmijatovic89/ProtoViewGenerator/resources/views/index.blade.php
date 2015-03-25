@extends('protomaker::master')

@section('content')
    <h1>Proto Maker</h1>

    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            0%
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12 well" style="display:none">

        </div>
        <div class="col-lg-12 ">
            <div class="alert alert-success " role="alert" style="display:none">

            </div>
        </div>
        <div class="col-lg-12 ">
            <div class="alert alert-danger " role="alert" style="display:none">

            </div>
        </div>

        <div class="col-lg-6">
            <div class="input-group">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Name of Modul</button>
                  </span>
                <input type="text" class="form-control" placeholder="How do you wanna call your Model/Modul (singular lowercase)" id="modul_name">
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3" style="text-align:center">
            <button onclick="makeJson()" class="btn btn-info">Make Json</button>
        </div>
        <div class="col-lg-3" style="text-align:center">
            <button onclick="makeCrud()" class="btn btn-info">Make CRUD</button>
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
                        <span class="input-group-addon span_translation" style="display:none" >
                            <input type="checkbox" aria-label="..." class="field_translation" value="1">

                        </span>
                    </div>
                </div>

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
                        <input type="text" class="form-control relation_model_namespace" placeholder="\App\Models\User" name="relation_class">
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



    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-default" onclick="toggleDiv('myContent')"> Additional options</button>
            <div id="myContent" style=" padding: 20px;display:none;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button" style="width:300px">-t template folder</button>
                      </span>
                            <select class="form-control" id="template" onchange="makeTranslation()" >
                                <option value="standard"> Standard</option>
                                <option value="modul">    Module</option>
                                <option value="translate">Translate</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <br>
                        <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button"  style="width:300px">-o output folder</button>
                      </span>

                            <input type="text" class="form-control" placeholder="Example for Module to use 'App/Modules/Vendor'" id="output" >
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <br>
                        <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button"  style="width:300px">Namespace</button>
                      </span>

                            <input type="text" class="form-control" placeholder="Example: 'App\Modules\Mouse\'" id="namespace" >
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <br>
                        <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button"  style="width:300px">-r Replace files withouth asking</button>
                      </span>
                            <select class="form-control" id="replace">
                                <option value="no"> No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <h4>Database Helper</h4>

                        <select class="form-control">

                            @foreach($tables as  $table_name =>$table)
                                <optgroup label="{{$table_name}}">
                                    @foreach($table as $field)
                                        <option>{{$field}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach

                        </select>


                    </div>

                    <div class="lg-12">
                        <pre>
                            <div class="well well-lg">

                            </div>
                        </pre>
                    </div>
                </div>
            </div>
        </div>
        @stop

        @section('footer')
            <script>
                // toggle div addvance options
                function toggleDiv(divId) {
                    $("#"+divId).toggle();
                }


                function makeTranslation()
                {
                    if($('#template').val() == 'translate'){
                        $(".span_translation").show();
                    }else{
                        $(".span_translation").hide();
                    }
                }

                $( document ).ready(function() {
                    makeTranslation();
                });

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

                    // test
                    //   '{"name":{"type":"text"},"description":{"type":"text"}}'
                    $.obj = {};
//        $.obj.name = $('#modul_name').val();

                    $( "div.fieldset" ).each(function( i,div ) {

                        var name             = $(div).find('.field_name').val();
                        var type             = $(div).find('.field_type').val();
                        var validation       = $(div).find('.field_validation').val();
                        var translation      = $(div).find('.field_translation').is(':checked');

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
                        console.log(translation)
                        if(translation){
                            array.translation   = true;
                        }


                        var obj={};
                        $.obj[name] = array;


                        delete(relation)



                    });
                    $.obj_string = "'" + JSON.stringify($.obj) + "'"; //.replace("[", "'").replace("]", "'");
                    $.module_name = $('#modul_name').val();


                    // Template --template
                    if($('#template').val() == 'modul') {
                        $.template = ' --template="modul" ';
                    }else if($('#template').val() == 'translate'){
                        $.template = ' --template="translate" ';
                    }else{
                        $.template = ' ';
                    }

                    // Replace  -r
                    if($('#replace').val() == 'yes'){
                        $.replace = ' -r ';
                    }else{
                        $.replace = ' ';
                    }

                    // Output --output
                    if($('#output').val()){
                        $.output = '--output="' + $('#output').val()+ '"';
                    }else{
                        $.output = ' ';
                    }


                    $.final = 'php artisan proto '+ $.module_name +" --fields=" + $.obj_string + $.template + $.output +$.replace;

                    console.log($.final);
                    $('.progress-bar').text('50%');
                    $('.progress-bar').css('width','50%')

                    $('.well').show();
                    $('.well').html($.final);


                }

                function makeCrud()
                {
                    $('.alert-success').fadeOut( "slow" )
                    $('.alert-danger' ).fadeOut( "slow" )
                    makeJson();
                    {{--{{URL::route('protoMakeCrud')}}--}}
                    $.post( "protoMakeCrud" ,{
                                "_token"    : "{{{ csrf_token() }}}" ,
                                "fields"    : $.obj,
                                "model"     : $.module_name,
                                "namespace" : $('#namespace').val() ,
                                "output"    : $('#output').val() ,
                                "template"  : $('#template').val()
                            },
                            function( data ) {
                                if(data.status == 200){
                                    $( ".alert-danger").hide();
                                    $( ".alert-success").fadeIn('slow').html( data.msg );


                                }else if(data.status == 400){
                                    $( ".alert-success").hide();
                                    $( ".alert-danger").fadeIn('slow').html( data.msg );


                                }

                            }
                    );

                    $('.progress-bar').text('100%');
                    $('.progress-bar').css('width','100%')
                }


            </script>

@stop