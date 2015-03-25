<?php


// Route::get('protomaker', function(){
// 	echo "PROTO MAKER";
// });

 // Route::get('protomaker', '\ivanmijatovic89\ProtoViewGenerator\ProtoMakerController@index');

Route::group(['namespace' => '\ivanmijatovic89\ProtoViewGenerator\Controller'], function(){

         Route::get('protomaker', ['as'=>'protomaker.index','uses'=>'ProtoMakerController@index']);
         Route::get('protomaker-documentation', ['as'=>'protomaker.docs','uses'=>'ProtoMakerController@docs']);

         Route::post('protoMakeCrud', ['as'=>'protoMakeCrud','uses'=> 'ProtoMakerController@protoMakeCrud']);
    // ovo je test
});

