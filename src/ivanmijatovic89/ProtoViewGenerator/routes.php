<?php


// Route::get('protomaker', function(){
// 	echo "PROTO MAKER";
// });

 // Route::get('protomaker', '\ivanmijatovic89\ProtoViewGenerator\ProtoMakerController@index');

Route::group(['namespace' => '\ivanmijatovic89\ProtoViewGenerator'], function(){
 	 Route::get('protomaker', 'ProtoMakerController@index');
});

